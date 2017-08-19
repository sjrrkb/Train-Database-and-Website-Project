<?php
    include("database.php");
    include("functions.php");
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
if(
    !isset($_POST['updateUserID']) &&
    !isset($_POST['updateFirstName']) &&
    !isset($_POST['updateLastName']) &&
    !isset($_POST['updatePassword']) &&
    !isset($_POST['updateRole']) &&
    !isset($_POST['updateStatus']) &&
    !isset($_POST['updateRank']) &&
    !isset($_POST['updateTotalHoursTraveling'])
  )
    {
        $_POST['updateUserID'] = "";
        $_POST['updateFirstName'] = "";
        $_POST['updateLastName'] = "";
        $_POST['updatePassword']="";
        $_POST['updateRole']="";
        $_POST['updateStatus']="";
        $_POST['updateRank']="";
        $_POST['updateTotalHoursTraveling']="";

    }

?>
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
	</style>
    </head>

</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Group 8</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="http://cs3380.rnet.missouri.edu/~GROUP8/conductorProfile.php">Home</a></li>
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

<?php
$passedUserID = $_POST['updateUserID'];
$passedFirstName = $_POST['updateFirstName'];
$passedLastName = $_POST['updateLastName'];
$passedPassword = $_POST['updatePassword'];
$passedRole = $_POST['updateRole'];
$passedStatus = $_POST['updateStatus'];
$passedRank = $_POST['updateRank'];
$passedTotalHoursTraveled =$_POST['updateTotalHoursTraveling'];

echo "
<form action='' method='POST'>
    User Name:<br>
    <input class='inpt' type = 'text' name ='displayUserName' value ='$passedUserID' required='required' readonly> 
    <br>
    First Name: <br>
    <input class='inpt' type = 'text' name ='displayFirstName' value ='$passedFirstName' >
    <br>
    Last Name: <br>
    <input class='inpt' type = 'text' name ='displayLastName' value ='$passedLastName' required='required' >
    <br>
    Password: <br>
    <input class='inpt' type = 'text' name ='displayPassword' value ='$passedPassword' required='required' >
    <br>
    Role: <br>
    <input class='inpt' type = 'text' name ='displayRole' value ='$passedRole' required='required' >
    <br>
    Status: <br>
    <input class='inpt' type = 'text' name ='displayStatus' value ='$passedStatus' required='required' >
    <br>
    Rank: <br>
    <input class='inpt' type = 'text' name ='displayRank' value ='$passedRank'>
    <br>
    Total Hours Traveled: <br>
    <input class='inpt' type = 'text' name ='displayTotalHoursTraveled' value ='$passedTotalHoursTraveled' >
    <br>
    <h2>These values will be updated.</h2>
    <br>
    <input class='btn btn-primary' type = 'submit' name = 'submitButton' value = 'Update'>
</form>";


if( isset($_POST['submitButton']) )
{
    $passedUserID = $_POST['displayUserName'];
    $passedFirstName = $_POST['displayFirstName'];
    $passedLastName = $_POST['displayLastName'];
    $passedPassword = $_POST['displayPassword'];
    $passedRole = $_POST['displayRole'];
    $passedStatus = $_POST['displayStatus'];
    $passedRank = $_POST['displayRank'];
    $passedTotalHoursTraveled = $_POST['displayTotalHoursTraveled'];

    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    checkLink($mysqli);
    updateEmployeeTable($mysqli, $passedUserID, $passedFirstName, $passedLastName, $passedPassword, $passedRole, $passedStatus, $passedRank,  $passedTotalHoursTraveled);
    $mysqli->close();
}    
?>
</div>
</body>
</html>
