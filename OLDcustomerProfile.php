<!DOCTYPE html>
<head>
 <title>Profile</title>
</head>

<?php
	include "functions.php"; 
    session_start();
    if(isset($_SESSION['uname']))
    {
        echo $_SESSION['uname'] . ", you have successfully been logged in. <br><br>";
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

<body>
	
	<form action="" method=POST>
		<input type="submit" name="logout" value="Log out" />
	</form><br><br>
	
	What would you like to do today?<br>
	<form action="" method=POST>
		<input type="submit" name="chg_info" value="Change My Info" />
	</form><br><br>
	<form action="" method=POST>
		<input type="submit" name="see_res" value="See My Reservations" />
	</form><br><br>
	<form action="" method=POST>
		<input type="submit" name="search" value="Search for a Car" />
	</form><br><br>

	<hr>
	
	<!-- Do PHP down here -->
<?php 
	include("database.php");
    //include("functions.php");
	
	//If user chose to change their information
	if(isset($_POST['chg_info'])){
		$mysqli=connectToDB();				//connect to database
		
	echo "Change Your Info";
		
		$query = "SELECT first_name, last_name FROM User WHERE user_id=?";
		$stmt = $mysqli->stmt_init();
		if(!$stmt->prepare($query)){
			echo "Error in preparing statement line 58";
			exit();
		}
		$stmt->bind_param("s",$SESSION['uname']);
		$stmt->execute();							//execute query
		$result = $stmt->get_result();				//get results
		$row = $result->fetch_array(MYSQLI_ASSOC) or die ($mysqli->error);//get row 
?>
		<form action="handleUpdate.php" method="POST">
			First Name:<input type='text' name="fname" required="required" value= <?= $row["first_name"] ?> /><br>
			Last Name:<input type='text' name="lname" required="required" value= <?= $row["last_name"] ?> /><br>
		</form>
<?php
	}
	
	//if user chose to see their reservations
	if(isset($_POST['see_res'])){
		
	}
	
	//if user chose to search cars
	if(isset($_POST['carsearch']) || isset($_POST['search'])){
		
	}
?>
   
   
</body>

</html>
