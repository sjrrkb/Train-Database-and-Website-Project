<!DOCTYPE html>
<html>
<head>
 <title>Profile</title>
 <meta charset="utf-8">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
  color: rgba(140,140,140,1);
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

.drpdwn {
	border: 0 ;
	background: rgba(40,40,40,0.4);
	width: 100px; 
	text-indent: 0.01px; 
	text-overflow: ""; 

	color: #FFF;
	border-radius: 15px;
	padding: 5px;
	box-shadow: inset 0 0 5px rgba(000,000,000, 0.5);
}
	</style>
    </head>

</head>


<body>
<?php
	session_start();
	if(isset($_SESSION['uname']))
    {
        echo $_SESSION['uname'] . ", you have successfully been logged in. <br>";
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
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Missouri Rail</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="http://cs3380.rnet.missouri.edu/~GROUP8/insert.php">Add Employee or Equipment</a></li>
      <li><a href="http://cs3380.rnet.missouri.edu/~GROUP8/adminLogs.php"><?php echo $_SESSION['uname']?>'s Logs </a></li>
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
    
<hr>
    <form action="" method="POST" class="col-md-6 col-md-offset-3">
	Search: 
	<input class="inpt" type="text" name="search">
	<br><br>
    <select class="drpdwn" name="radios" required="required">
        <option value="1">UserName</option>
        <option value="2">FirstName</option>
        <option value="3">LastName</option>
        <option value="4">Administrator</option>
        <option value="5">Engineer</option>
        <option value="6">Conductor</option>  
        <option value="7">Customer/CompanyID </option>
        <option value="8">Employee</option> 
        <option value="9">Train</option>
        <option value="10">Depot</option>
        <option value="11">Locomotive</option>
        <option value="12">Car</option>  
        <option value="13">Car Type</option>
        <option value="14">Reservations</option>
        <option value="15">Assigned Engineers</option>
        <option value="16">Assigned Conductors</option>
        <option value="17">Assigned Locomotive</option>
        <option value="18">Assigned Cars</option>
    </select>
	<input class="btn btn-primary" type="submit" name="submit" value="Execute">
    
    </form>
<?php
include("database.php");
include("functions.php");
if(isset($_POST['delete']))
{
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
	checkLink($mysqli);
    $sql1=$_SESSION['sql'];
    switch($_SESSION['choice'])
    {
        case 1:
            $choice=1;
            $sql = "DELETE FROM User where `user_id` = ?;";
        break;
            
        case 2:
            $choice=2;
            $sql = "DELETE FROM User where `user_id` = ?;";
           
        break;
            
        case 3:
            $choice=3;
            $sql = "DELETE FROM User where `user_id` = ?;";
        break;
        
        case 4:
            $choice=4;
            $sql = "DELETE FROM User where `user_id` = ?;";
        break;
            
        case 5:
            $choice=5;
            $sql = "DELETE FROM User where `user_id` = ?;"; 
        break;
            
        case 6:
            $choice=6;
            $sql = "DELETE FROM User where `user_id` = ?;";  
        break;
            
        case 7:
            $choice=7;
            $sql = "DELETE FROM User where `user_id` = ?;"; 
        break;
            
        case 8:
            $choice=8;
            $sql = "DELETE FROM User where `user_id` = ?;"; 
        break;
        
        case 9:
            $choice=9;
            $sql = "DELETE FROM Train where `train_id` = ?;"; 
        break;
            
        case 10:
            $choice=10;
            $sql = "DELETE FROM Depot where `depot_location` = ?;"; 
        break;
            
        case 11:
            $choice=11;
            $sql = "DELETE FROM Locomotive where `locomotive_ID` = ?;"; 
        break;
            
        case 12:
            $choice=12;
            $sql = "DELETE FROM Car where `car_id` = ?;"; 
        break;
            
        case 13:
            $choice=13;
            $sql = "DELETE FROM Car_Type where `car_type` = ?;"; 
        break;
            
        case 14:
            $choice=14;
            $sql = "DELETE FROM Reservations where `car_id` = ?;"; 
        break;   
            
        case 15:
            $choice=15;
            $sql = "DELETE FROM Assigned_Engineer where `user_id` = ?;"; 
        break;   
            
        case 16:
            $choice=16;
            $sql = "DELETE FROM Assigned_Conductor where `user_id` = ?;"; 
        break;   
            
        case 17:
            $choice=17;
            $sql = "DELETE FROM Assigned_Locomotive where `locomotive_ID` = ?;"; 
        break;  
            
        case 18:
            $choice=18;
            $sql = "DELETE FROM Assigned_Car where `car_id`= ?;"; 
        break;   
    }
    $stmt =$mysqli->stmt_init();
    if( !$stmt->prepare($sql) )
    {
        echo "Exit";
        echo "<br>";
        echo $sql." failed please try again";
      
        exit();
    }
    switch($choice)
    {
        case 1:
            $stmt->bind_param("s", $_POST['deleteUserID']);
            $stmt->execute();
            echo "You have deleted all information associated with the user_id= ";
            echo $_POST['deleteUserID'];
            updateUserLogTable($_SESSION['uname'], $sql);
        break;
            
        case 2:
            $stmt->bind_param("s", $_POST['deleteUserID']);
            $stmt->execute();
            echo "You have deleted all information associated with the user_id= ";
            echo $_POST['deleteUserID'];
            echo " and first_name= ";
            echo $_POST['deleteFirstName'];
            updateUserLogTable($_SESSION['uname'], $sql);
        break;
            
        case 3:
            $stmt->bind_param("s", $_POST['deleteUserID']);
            $stmt->execute();
            echo "You have deleted all information associated with user_id= ";
            echo $_POST['deleteUserID'];
            updateUserLogTable($_SESSION['uname'], $sql);
            
        break;
            
        case 4:
            $stmt->bind_param("s", $_POST['deleteUserID']);
            $stmt->execute();
            echo "You have deleted all information associated with the user_id= ";
            echo $_POST['deleteUserID'];
            echo " and rank of ";
            echo $_POST['deleteRank'];
            updateUserLogTable($_SESSION['uname'], $sql);
        break;
            
        case 5:
            $stmt->bind_param("s", $_POST['deleteUserID']);
            $stmt->execute();
            echo "You have deleted all information associated with the Engineer user_id= ";
            echo $_POST['deleteUserID'];
            updateUserLogTable($_SESSION['uname'], $sql);
        break;
            
        case 6:
            $stmt->bind_param("s", $_POST['deleteUserID']);
            $stmt->execute();
            echo "You have deleted all information associated with the Conductor user_id= ";
            echo $_POST['deleteUserID'];
            updateUserLogTable($_SESSION['uname'], $sql);
        break;
            
        case 7:
            $stmt->bind_param("s", $_POST['deleteUserID']);
            $stmt->execute();
            echo "You have deleted all information associated with the Customer user_id= ";
            echo $_POST['deleteUserID'];
            updateUserLogTable($_SESSION['uname'], $sql);
        break;
            
        case 8:
            $stmt->bind_param("s", $_POST['deleteUserID']);
            $stmt->execute();
            echo "You have deleted all information associated with user_id= ";
            echo $_POST['deleteUserID'];
            updateUserLogTable($_SESSION['uname'], $sql);
        break;
            
        case 9:
            $stmt->bind_param("s", $_POST['deleteTrainNumber']);
            $stmt->execute();
            echo "You have deleted all information associated with the Train with  train_number ";
            echo $_POST['deleteTrainNumber'];
            echo " , running on days ";
            echo $_POST['deleteRunningDays'];
            echo " , and has a destination of ";
            echo $_POST['deleteDestination'];
            updateUserLogTable($_SESSION['uname'], $sql);
        break;
            
        case 10:
            $stmt->bind_param("s", $_POST['deleteDepotLocation']);
            $stmt->execute();
            echo "You have deleted all information associated with depot location ";
            echo $_POST['deleteDepotLocation'];
            updateUserLogTable($_SESSION['uname'], $sql);
        break;
            
        case 11:
            $stmt->bind_param("s", $_POST['deleteLocoNumber']);
            $stmt->execute();
            echo "You have deleted all information associated with locomitive number of ";
            echo $_POST['deleteLocoNumber'];
            echo " , and locomotive type ";
            echo $_POST['deleteLocoType'];
            echo " , and at the depot location of ";
            echo $_POST['deleteDepotLocation'];
            updateUserLogTable($_SESSION['uname'], $sql);
        break;
            
        case 12:
            $stmt->bind_param("s", $_POST['deleteCarNumber']);
            $stmt->execute();
            echo "You have deleted all information associated with locomitive number of ";
            echo $_POST['deleteCarNumber'];
            echo " , and locomotive type ";
            echo $_POST['deleteCarType'];
            echo " , and at the depot location of ";
            echo $_POST['deleteCarLocation'];
            updateUserLogTable($_SESSION['uname'], $sql);
        break;
            
        case 13:
            $stmt->bind_param("s", $_POST['deleteCarType']);
            $stmt->execute();
            echo "You have deleted all information associated with car_type of ";
            echo $_POST['deleteCarType'];
            updateUserLogTable($_SESSION['uname'], $sql);
        break;
            
        case 15:
            $stmt->bind_param("s", $_POST['user_id']);
            $stmt->execute();
            echo "You have deleted all information associated with user_id of ";
            echo $_POST['deleteAssignedUserID'];
            updateUserLogTable($_SESSION['uname'], $sql);
        break;
            
        case 16:
            $stmt->bind_param("s", $_POST['user_id']);
            $stmt->execute();
            echo "You have deleted all information associated with user_id of ";
            echo $_POST['deleteAssignedUserID'];
            updateUserLogTable($_SESSION['uname'], $sql);
        break;
        
//        case 17:
//            $stmt->bind_param("s", $_POST['deleteLocoNumber']);
//            $stmt->execute();
//            echo "You have deleted all information associated with locomotiveID of ";
//            echo $_POST['deleteLocoNumber'];
//            updateUserLogTable($_SESSION['uname'], $sql);
//        break;
//            
//        case 18
//            $stmt->bind_param("s", $_POST['deleteLocoNumber']);
//            $stmt->execute();
//            echo "You have deleted all information associated with locomotiveID of ";
//            echo $_POST['deleteLocoNumber'];
//            updateUserLogTable($_SESSION['uname'], $sql);
//        break;
    }
    $stmt =$mysqli->stmt_init();
    if( !$stmt->prepare($sql1) )
    {
        echo "Exit";
        exit();
    }
    $param=$_SESSION['param'];
    $stmt->bind_param("s", $param);
    $stmt->execute();
	$result = $stmt->get_result();
    echo "<table class='table table-hover'>";
    switch($choice)
    {
        case 1:
            printUserTable($result);    
        break;
            
        case 2:
            printUserTable($result);
        break;
            
        case 3:
            printUserTable($result);
        break;
            
        case 4:
            printAdminTable($result);
        break;
            
        case 5:
            printEngineerTable($result);
        break;
            
        case 6:
            printConductorTable($result);
        break;
            
        case 7:
            printCustomerTable($result);
        break;
            
        case 8:
            printEmployeeTable($result);
        break;
            
        case 9:
            printTrainTable($result); 
        break;
            
        case 10:
            printDepotTable($result);
        break;
            
        case 11:
            printLocomotiveTable($result);
        break;
            
        case 12:
            printCarTable($result);
        break;
            
        case 13:
            printCarTypeTable($result);
        break;
            
        case 14:
            printReservationsTable($result);
        break;
            
        case 15:
            printAssignedEngineerTable($result);
        break;
            
        case 16:
            printAssignedConductorTable($result);
        break;
            
        case 17:
            printAssignedLocomotiveTable($result);
        break;
            
        case 18:
            printAssingedCarTable($result);
        break;
    }
    $mysqli->close();
    
}
if(isset($_POST['submit']))
{
	
	$mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
	checkLink($mysqli);
    
    switch($_POST['radios'])
    {
        case 1:
            $choice=1;
            $sql = "SELECT * FROM User where `user_id` 
            LIKE ? ORDER BY `user_id`;";
        break;
            
        case 2:
            $choice=2;
            $sql = "SELECT * FROM User where `first_name` LIKE ? ORDER BY `first_name`;"; 
           
        break;
            
        case 3:
            $choice=3;
            $sql = "SELECT * FROM User where `last_name` LIKE ? ORDER BY `last_name`;"; 
        break;
        
        case 4:
            $choice=4;
            $sql = "SELECT * FROM Administrator where `user_id` LIKE ? ORDER BY `user_id`;"; 
        break;
            
        case 5:
            $choice=5;
            $sql = "SELECT * FROM Engineer where `user_id` LIKE? ORDER BY `user_id`;"; 
        break;
            
        case 6:
            $choice=6;
            $sql = "SELECT * FROM Conductor where `user_id` LIKE ? ORDER BY `user_id`;"; 
        break;
            
        case 7:
            $choice=7;
            $sql = "SELECT * FROM Customer where `user_id` LIKE ? ORDER BY `user_id`;"; 
        break;
            
        case 8:
            $choice=8;
            $sql = "SELECT * FROM `join_Con_Eng_Admin` where `user_id` LIKE ? ORDER BY `user_id`;"; 
        break;
        
        case 9:
            $choice=9;
            $sql = "SELECT * FROM Train where `train_ID` LIKE ? ORDER BY `train_ID`;"; 
        break;
            
        case 10:
            $choice=10;
            $sql = "SELECT * FROM Depot where `depot_location` LIKE ? ORDER BY `depot_location`;"; 
        break;
            
        case 11:
            $choice=11;
            $sql = "SELECT * FROM Locomotive where `locomotive_ID` LIKE ? ORDER BY `locomotive_ID`;"; 
        break;
            
        case 12:
            $choice=12;
            $sql = "SELECT * FROM Car where `car_id` LIKE ? ORDER BY `car_id`;"; 
        break;
            
        case 13:
            $choice=13;
            $sql = "SELECT * FROM Car_Type where `car_type` LIKE ? ORDER BY `car_type`;"; 
        break;
            
        case 14:
            $choice=14;
            $sql = "SELECT * FROM `Reservations` where `car_id` LIKE ? ORDER BY `car_id`;";
        break;
            
        case 15:
            $sql = "SELECT * FROM `Assigned_Engineer` WHERE `user_id` LIKE ? ORDER BY `user_id`;";
            $choice=15;
        break;
            
        case 16:
            $sql = "SELECT * FROM `Assigned_Conductor`
            WHERE `user_id` LIKE ? ORDER BY `user_id`;";
            $choice=16;
        break;
            
        case 17:
            $sql = "SELECT * FROM `Assigned_Locomotive`
            WHERE `locomotive_id` LIKE ? ORDER BY `locomotive_id`;";
            $choice=16;
        break;
            
        case 18:
            $sql = "SELECT * FROM `Assigned_Car` WHERE `car_id` LIKE ? ORDER BY `car_id`;";
            $choice=17;
        break;
    }
    $_SESSION['sql']=$sql;
    $_SESSION['choice']=$choice;
    $stmt =$mysqli->stmt_init();
    if( !$stmt->prepare($sql) )
    {
        echo "Exit";
        exit();
    }
    $param="{$_POST['search']}%";
    $_SESSION['param']=$param;
    $stmt->bind_param("s", $param);
    $stmt->execute();
	$result = $stmt->get_result();
    echo "<table class='table table-hover'>";
    switch($choice)
    {
        case 1:
            printUserTable($result);    
        break;
            
        case 2:
            printUserTable($result);
        break;
            
        case 3:
            printUserTable($result);
        break;
            
        case 4:
            printAdminTable($result);
        break;
            
        case 5:
            printEngineerTable($result);
        break;
            
        case 6:
            printConductorTable($result);
        break;
            
        case 7:
            printCustomerTable($result);
        break;
            
        case 8:
            printEmployeeTable($result);
        break;
            
        case 9:
            printTrainTable($result); 
        break;
            
        case 10:
            printDepotTable($result);
        break;
            
        case 11:
            printLocomotiveTable($result);
        break;
            
        case 12:
            printCarTable($result);
        break;
            
        case 13:
            printCarTypeTable($result);
        break;
            
        case 14:
            printReservationsTable($result);
        break;
            
        case 15:
            printAssignedEngineerTable($result);
        break;
            
        case 16:
            printAssignedConductorTable($result);
        break;
            
        case 17:
            printAssignedLocomotiveTable($result);
        break;
            
        case 18:
            printAssingedCarTable($result);
        break;
    }
    $mysqli->close(); 
}
?>
    <br>
    </form>
</div>
</body> 

</html>
