<?php
    include("database.php");
    include("functions.php");
    session_start();
    if(isset($_SESSION['uname']))
    {
        if( ($_SESSION['role'] == "Admin") || ($_SESSION['role'] == "Customer") || ($_SESSION['role'] == "Engineer")){
        	header("Location: http://cs3380.rnet.missouri.edu/~GROUP8/index.php");
      	}
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>    <!-- jQuery library -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> <!-- Latest compiled JavaScript -->
	<link rel="stylesheet" type="text/css" href="CSS/navBar.css">

<script>
      $(document).ready(function(){
          $(".dropdown").hover(            
              function() {
                  $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
                  $(this).toggleClass('open');        
              },
              function() {
                  $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
                  $(this).toggleClass('open');       
              }
          );
      });
</script>

<style>
	.inpt {
  	display: inline-block;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	width: 150px;
	height: 42px;
	cursor: pointer;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	padding: 0 20px;
	overflow: hidden;
	border: none;
	-webkit-border-radius: 21px;
	border-radius: 21px;
	font: normal 20px/normal "Antic", Helvetica, sans-serif;
	color: rgba(1,1,1,1);
	text-decoration: normal;
	-o-text-overflow: ellipsis;
	text-overflow: ellipsis;
	background: rgba(40,40,40,0.4);
	-webkit-box-shadow: 1px 1px 2px 0 rgba(0,0,0,0.5) inset;
	box-shadow: 1px 1px 2px 0 rgba(0,0,0,0.5) inset;
	-webkit-transition: all 502ms cubic-bezier(0.68, -0.75, 0.265, 1.75);
	-moz-transition: all 502ms cubic-bezier(0.68, -0.75, 0.265, 1.75);
	-o-transition: all 502ms cubic-bezier(0.68, -0.75, 0.265, 1.75);
	transition: all 502ms cubic-bezier(0.68, -0.75, 0.265, 1.75);
	}
	.inpt:hover {
	color: rgba(181,181,181,1);
	background: rgba(0,0,0,0.4);
	-webkit-transition: all 500ms cubic-bezier(0.68, -0.75, 0.265, 1.75);
	-moz-transition: all 500ms cubic-bezier(0.68, -0.75, 0.265, 1.75);
	-o-transition: all 500ms cubic-bezier(0.68, -0.75, 0.265, 1.75);
	transition: all 500ms cubic-bezier(0.68, -0.75, 0.265, 1.75);
	}
	.inpt:focus {
	width: 213px;
	cursor: default;
	padding: -13px 20px 0;
	color: rgba(255,255,255,1);
	-webkit-transition: all 601ms cubic-bezier(0.68, -0.75, 0.265, 1.75);
	-moz-transition: all 601ms cubic-bezier(0.68, -0.75, 0.265, 1.75);
	-o-transition: all 601ms cubic-bezier(0.68, -0.75, 0.265, 1.75);
	transition: all 601ms cubic-bezier(0.68, -0.75, 0.265, 1.75);
	}
	.res_table{
		font-size: 18px;
		padding: 15px;
		color: black;
		float: center;
		
	}

	.container{
		margin-top: 50px;
	}
	</style>
	
	
</head>


<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container-fluid">
	    
	    <div class="navbar-header">
	      <a class="navbar-brand" href="http://cs3380.rnet.missouri.edu/~GROUP8/">Missouri Rail</a>
	    </div>

	    <ul class="nav navbar-nav">
	      <li class="active"><a href="">Profile</a></li>
	      <li><a href="http://cs3380.rnet.missouri.edu/~GROUP8/conductorLogs.php">Logs</a></li>
	    </ul>

	    <ul class="nav navbar-nav navbar-right">
	            <li class="dropdown">
	                <a href="" class="dropdown-toggle" data-toggle="dropdown">
	                    <span class="glyphicon glyphicon-user"></span> 
	                    <strong><font color='white'> <?php echo $_SESSION['uname']?> </font></strong> 
	                    <span class="glyphicon glyphicon-chevron-down"></span>
	                </a>
	                <ul style="background-color:white; opacity:0.9;" class="dropdown-menu">
	                    <li>
	                        <div class="navbar-login">
	                            <div class="row">
	                                <div class="col-lg-4">
	                                    <p class="text-center">
	                                        <span class="glyphicon glyphicon-user icon-size"></span> 
	                                    </p>
	                                </div>
	                                <div class="col-lg-8">
	                                    <p class="text-center"><strong><?php echo $_SESSION['uname'];?></strong></p>
	                                    <p class="text-center small"><?php echo $_SESSION['role'];?></p>
	                                    <p class="text-center">
	                                        <a href="http://cs3380.rnet.missouri.edu/~GROUP8/conductorProfile.php" class="btn btn-primary btn-block btn-sm">View Profile</a>
	                                    </p>
	                                </div>
	                            </div>
	                        </div>
	                    </li>
	                    <li class="divider"></li>
	                    <li>
	                        <div class="navbar-login navbar-login-session">
	                            <div class="row">
	                                <div class="col-lg-12">
	                                    <p>
	                                      <form action="" method="POST">
	                                        <input class="btn btn-danger btn-block" type="submit" name="logout" value="Log out">
	                                      </form>
	                                        
	                                    </p>
	                                </div>
	                            </div>
	                        </div>
	                    </li>
	                </ul>
	            </li>
	    </ul>
	  </div>
	</nav> <!-- End of navbar-inverse -->




<div class="container">
<br>
	<h3>Hello <?php echo $_SESSION['uname'];?>, what would you like to do today?</h3>
	<br>
	<form action="" method="POST" style="display:inline;">
		<input class="btn btn-primary" type="submit" name="chg_info" value="View/Update My Info" />
	</form>
	<form action="" method="POST" style="display:inline;">
		<input class="btn btn-primary" type="submit" name="trainsAssigned" value="View Train History" />
	</form>
	<form action="http://cs3380.rnet.missouri.edu/~GROUP8/conductorLogs.php" method="POST" style="display:inline;">
		<input class="btn btn-primary" type="submit" name="conductorLogs" value="View Online Logs" />
	</form>
	<hr>
</div>   
    
	<!-- PHP down here -->
<?php 
	//begin div to hold buttons
	echo "<div class='col-md-6 col-md-offset-3' style='text-align: center;'>";	
	
	//Execute this if user has submitted updates to info
	if(isset($_POST['update']) && validatePassword($mysqli=connectToDB(), $_SESSION['uname'], $_POST['current_psswd'])){
		if(!empty($_POST['new_psswd'])){	//user is changing password
			
			updateEmployeeTable($mysqli, $_SESSION['uname'], $_POST['fname'], $_POST['lname'], $_POST['new_psswd'], $_POST['role'], $_POST['status'], null, null);
		}
		else{		//user not changing password
			updateEmployeeTable($mysqli, $_SESSION['uname'], $_POST['fname'], $_POST['lname'], $_POST['current_psswd'], $_POST['role'], $_POST['status'], null, null);
		}
		$success = 1;
	}
	else{
		$success = 0;
	}
	echo "</div>";		//////
	
	//Display if user chose to change their information
	if(isset($_POST['chg_info']) || isset($_POST['update'])){

		$mysqli=connectToDB();				//connect to database
		checkLink($mysqli);					
	
		echo "<div style='text-align: center; font-size: 18px; '>";	
		echo "<h3>Change Your Info</h3>";
		
		//get current user info
		$sql = "SELECT user_id, first_name, last_name, role, rank, status 
				FROM join_Con_Eng_Admin
				WHERE user_id=?;";
		$stmt = $mysqli->stmt_init();
		if(!$stmt->prepare($sql)){
			echo "Error in preparing statement line 173";
			exit();
		}
		$stmt->bind_param("s",$_SESSION['uname']);
		$stmt->execute();							//execute query
		$result = $stmt->get_result();				//get results
		$row = $result->fetch_array(MYSQLI_ASSOC) or die ($mysqli->error);//get row 
?>
		<form action="" method="POST">
			<?//Hidden inputs to hold onto user data?>
			<input type='text' name="userid"  value= <?= $row["user_id"] ?> style="display:none;" /> 
			<input type='text' name="role"  value= <?= $row["role"] ?> style="display:none;" />
			<input type='text' name="rank"  value= <?= $row["rank"] ?> style="display:none;" />
			<input type='text' name="status"  value= <?= $row["status"] ?> style="display:none;" />
			

			User ID: <?= $row["user_id"] ?> <br>
			Role: <?= $row["role"] ?><br>
			Rank: <?= $row["rank"] ?><br>
			Status: <?php if($row["status"] == 1){echo "Active";}else{echo "Inactive";} ?><br>
			First Name: 
			<input class="inpt" type='text' name="fname" required="required" value= <?= $row["first_name"] ?> /><br>
			Last Name: 
			<input class="inpt" type='text' name="lname" required="required" value= <?= $row["last_name"] ?> /><br>
			New Password: 
			<input class="inpt" type='password' name="new_psswd"  /><br>
			Enter Current Password to Update: 
			<input class="inpt" type='password' name="current_psswd" required="required" /><br><br>
			<input class="btn btn-primary" type="submit" name="update" value="Update" />
		</form>
<?php
		if($success == 1){
			echo "Your information was successfully updated.";	//print update success
		}
		elseif(isset($_POST['update']) && ($success==0)){
			echo "<p style='color:red;'>Incorrect password, information not updated</p>";
		}
		
		$stmt->close();			//close prepared statement and database
		$mysqli->close();
		echo "</div>";
	}//end change user info
	
?>




<?php
if(isset($_POST['trainsAssigned']))
{

	$mysqli = connectToDB();
	checkLink($mysqli);
    $sql = "SELECT 	Train.train_ID AS 'Train ID #', 
					departure AS  'Departure',
					destination AS 'Destination',
					running_days AS 'Running Days',
					hours_traveling AS 'Traveled Hours'
			FROM Train JOIN Assigned_Conductor ON (Assigned_Conductor.train_ID=Train.train_ID)
			WHERE (Assigned_Conductor.user_id=?);";
    $stmt =$mysqli->stmt_init();
    if( !$stmt->prepare($sql) )
    {
        echo "Exit";
        exit();
    }
    $stmt->bind_param("s", $_SESSION['uname']);
    $stmt->execute();
	$result = $stmt->get_result();
	
	echo "<div style='clear: both; width: 50%; font-size:18px; margin: auto; border=3px'>";
		displayTableResults($result);
    echo "</div>";
    
}


?>
</div>
	<hr>
</body>
</html>
