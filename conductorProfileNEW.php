<?php
    include("database.php");
    include("functions.php");
    session_start();
    if(isset($_SESSION['uname']))
    {
       // echo $_SESSION['uname'] . ", you have successfully been logged in. <br>";
    }
    else
    {
        echo "Session not created yet<br>";
        header("Location: http://cs3380.rnet.missouri.edu/~GROUP8/index.php");
    }
    if(isset(($_POST['logout'])))
    {
        session_unset();
        session_destroy();
        header("Location: http://cs3380.rnet.missouri.edu/~GROUP8/index.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
 <title>Conductor Profile</title>
 <meta charset="utf-8">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>

</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Group 8</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#"><?php echo $_SESSION['uname']."'s Profile";?></a></li>
      <li><a href="http://cs3380.rnet.missouri.edu/~GROUP8/conductorLogs.php"><?php echo $_SESSION['uname']?>'s Logs </a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li>
                <form class="navbar-form navbar-right"action="" method="POST">
                        <input class="btn btn-danger" type="submit" name="logout" value="Log out">
                </form>

        </li>
    </ul>
  </div>
</nav>

<div class="container">
<br>
	<h3>Hello <?php echo $_SESSION['uname'];?>, what would you like to do today?</h3>
	<br>
	<form action="" method="POST">
		<input class="btn btn-primary" type="submit" name="chg_info" value="View/Update My Info" />
	</form><br>
	<form action="" method="POST">
		<input class="btn btn-primary" type="submit" name="trainsAssigned" value="View Trains Assigned" />
	</form><br>
	
	<hr>
	
	
	
</div>   
    
	<!-- PHP down here -->
<?php 
	//begin div to hold buttons
	echo "<div class='col-md-6 col-md-offset-3' style='text-align: center;'>";	
	
	//Execute this if user has submitted updates to info
	if(isset($_POST['update']) && validatePassword($mysqli=connectToDB(), $_SESSION['uname'], $_POST['current_psswd'])){
		updateUserTable($mysqli, $_SESSION['uname'], $_POST['fname'], $_POST['lname']);
		if(!empty($_POST['new_psswd'])){
			//echo "NEW PASSWORD";
			updateAuthenticationTable($mysqli, $_SESSION['uname'], $_POST['new_psswd'], 'Customer');
		}
		$success = 1;
		//echo "<h4>User information updated</h4>";	
	}
	else{
		$success = 0;
	}
	echo "</div>";		//////
	
	//Display if user chose to change their information
	if(isset($_POST['chg_info']) || isset($_POST['update'])){

		$mysqli=connectToDB();				//connect to database
		checkLink($mysqli);					
	
		echo "<div class='col-md-6 col-md-offset-3' style='text-align: center;'>";	
		echo "<h4>Change Your Info</h4>";
		
		//get current user info
		//$sql = "SELECT first_name, last_name FROM User WHERE user_id=?;";	
		$sql = "SELECT user_id, first_name, last_name, role, status 
				FROM join_Con_Eng_Admin
				WHERE user_id=?;";
		$stmt = $mysqli->stmt_init();
		if(!$stmt->prepare($sql)){
			echo "Error in preparing statement line 108";
			exit();
		}
		$stmt->bind_param("s",$_SESSION['uname']);
		$stmt->execute();							//execute query
		$result = $stmt->get_result();				//get results
		$row = $result->fetch_array(MYSQLI_ASSOC) or die ($mysqli->error);//get row 
?>
		<form action="" method="POST" >
			User ID:
			
			
			First Name: 
			<input class="inpt" type='text' name="fname" required="required" value= <?= $row["first_name"] ?> /><br>
			Last Name: 
			<input class="inpt" type='text' name="lname" required="required" value= <?= $row["last_name"] ?> /><br>
			New Password: 
			<input class="inpt" type='text' name="new_psswd"  /><br>
			Enter Current Password to Update Information: 
			<input class="inpt" type='text' name="current_psswd" required="required" /><br><br>
			<input class="btn btn-primary" type="submit" name="update" value="Update" />
		</form>
<?php
		if($success == 1){
			echo "Your information was successfully updated.";	//print update success
		}
		
		$stmt->close();			//close prepared statement and database
		$mysqli->close();
		echo "</div>";
	}//end change user info
	
?>







<?php
if(isset($_POST['trainsAssigned']))
{
   // $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
	//checkLink($mysqli);
    //$mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
	$mysqli = connectToDB();
	checkLink($mysqli);
    $sql = "SELECT * FROM `Assigned_Conductor` WHERE `user_id`=?;";
    $stmt =$mysqli->stmt_init();
    if( !$stmt->prepare($sql) )
    {
        echo "Exit";
        exit();
    }
    $stmt->bind_param("s", $_SESSION['uname']);
    $stmt->execute();
	$result = $stmt->get_result();
    echo "<table class='table table-hover'>";
    printAssignedConductorTable($result);
    
}


?>
</div>
</body>
</html>
