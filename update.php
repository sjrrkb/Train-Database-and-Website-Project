<?php
include "database.php";
include "functions.php";
session_start();
//user
if($_SESSION['choice']==1 || $_SESSION['choice']==2)
{
    if(
        !isset($_POST['updateUserID']) && 
        !isset($_POST['updateFirstName']) &&
        !isset($_POST['updateLastName'])
      )

    {
        $_POST['updateUserID'] = "";
        $_POST['updateFirstName'] = "";
        $_POST['updateLastName'] = "";
    }
}

//role
if($_SESSION['choice']==3)
{
    if(
        !isset($_POST['updateUserID']) &&
        !isset($_POST['updateRole']) &&
        !isset($_POST['updatePassword'])       
      )
    {
        $_POST['updateUserID'] = "";
        $_POST['updatePassword'] = "";
        $_POST['updateRole'] = "";
    }

}

//onsite personnel
if($_SESSION['choice']==4)
{
    if(
        !isset($_POST['updateUserID']) &&
        !isset($_POST['updateStatus'])       
      )
        {
            $_POST['updateUserID'] = "";
            $_POST['updateStatus'] = "";
        }
}

//engineer
if($_SESSION['choice']==5)
{
    if(
        !isset($_POST['updateUserID']) &&
        !isset($_POST['updateTotalHoursTraveled'])&&
        !isset($_POST['updateRank'])
      )
        {
            $_POST['updateUserID'] = "";
            $_POST['updateTotalHoursTraveled'] = "";
            $_POST['updateRank']="";
        }
}

//conductor
if($_SESSION['choice']==6)
{
    if(
        !isset($_POST['updateUserID']) &&
        !isset($_POST['updateRank'])
      )
        {
            $_POST['updateUserID'] = "";
            $_POST['updateRank'] = "";
        }
    }

//customer
if($_SESSION['choice']==7)
{
    if(
        !isset($_POST['updateUserID']) &&
        !isset($_POST['updateCompanyID'])
      )
        {
            $_POST['updateUserID'] = "";
            $_POST['updateCompanyID']="";
        }
}

//employee
if($_SESSION['choice']==8)
{
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
}

//train
if($_SESSION['choice']==9)
{
    if(
        !isset($_POST['updateTrainID']) &&
        !isset($_POST['updateFROM']) &&
        !isset($_POST['updateTO']) &&
        !isset($_POST['updateRunningDays']) &&
        !isset($_POST['updateTravelTime']) 
      )
        {
            $_POST['updateTrainID'] = "";
            $_POST['updateFROM']="";
            $_POST['updateTO']="";
            $_POST['updateRunningDays']="";
            $_POST['updateTravelTime']="";
        }
}

//car
if($_SESSION['choice']==12)
{
    if(
        !isset($_POST['updateCarNumber']) &&
        !isset($_POST['updateCarType']) &&
        !isset($_POST['updateIsReserved'])
      )
        {
            $_POST['updateCarNumber'] = "";
            $_POST['updateCarType']="";
            $_POST['updateIsReserved']="";
        }
}

//car type
if($_SESSION['choice']==13)
{
    if(
        !isset($_POST['updateCarType']) &&
        !isset($_POST['updateCarPrice'])
      )
        {
            $_POST['updateCarPrice'] = "";
            $_POST['updateCarType']="";
        }
}

//reservation
if($_SESSION['choice']==14)
{
    if(
        !isset($_POST['updateCarID']) &&
        !isset($_POST['updateCompanyID']) &&
        !isset($_POST['updateReservationDate']) &&
        !isset($_POST['updateFinalPrice']) &&
        !isset($_POST['updateDeparture']) &&
        !isset($_POST['updateDestination'])
      )
    {
        $_POST['updateCarID'] = "";
        $_POST['updateCompanyID']="";
        $_POST['updateReservationDate'] = "";
        $_POST['updateFinalPrice']="";
        $_POST['updateDeparture'] = "";
        $_POST['updateDestination']="";
    }
}

//assigned engineers
if($_SESSION['choice']==15)
{
    if(
        !isset($_POST['updateAssignedUserID']) &&
        !isset($_POST['updateTrainID'])
      )
    {
        $_POST['updateAssignedUserID'] = "";
        $_POST['updateTrainID']="";
    }
}

//assigned conductors
if($_SESSION['choice']==16)
{
    if(
        !isset($_POST['updateAssignedUserID']) &&
        !isset($_POST['updateTrainID'])
      )
    {
        $_POST['updateAssignedUserID'] = "";
        $_POST['updateTrainID']="";
    }
}

//assigned Locomotive
if($_SESSION['choice']==17)
{
    if(
        !isset($_POST['updateAssignedLocoID']) &&
        !isset($_POST['updateTrainID'])
      )
    {
        $_POST['updateAssignedLocoID'] = "";
        $_POST['updateTrainID']="";
    }
}

//assigned Car
if($_SESSION['choice']==18)
{
    if(
        !isset($_POST['updateAssignedCarID']) &&
        !isset($_POST['updateTrainID'])
      )
    {
        $_POST['updateAssignedCarID'] = "";
        $_POST['updateTrainID']="";
    }
}

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

<!DOCTYPE html>
<html>
<head>
 <title>Update Page</title>
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
      <a class="navbar-brand" href="#">Missouri Rail</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="http://cs3380.rnet.missouri.edu/~GROUP8/adminProfile.php">Home</a></li>
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
<?php
    //user
if($_SESSION['choice']==1 || $_SESSION['choice']==2)
{
    $passedUserID = $_POST['updateUserID'];
    $passedFirstName = $_POST['updateFirstName'];
    $passedLastName = $_POST['updateLastName'];
}
    //role
if($_SESSION['choice']==3)
{
    $passedUserID = $_POST['updateUserID'];
    $passedRole = $_POST['updateRole'];
    $passedPassword = $_POST['updatePassword'];
}
    //status
if($_SESSION['choice']==4)
{
    $passedUserID = $_POST['updateUserID'];
    $passedStatus = $_POST['updateStatus'];
}
        
    //engineer
if($_SESSION['choice']==5)
{
    $passedUserID = $_POST['updateUserID'];
    $passedTotalHoursTraveled = $_POST['updateTotalHoursTraveled'];
    $passedRank = $_POST['updateRank'];
}

  //conductor        
if($_SESSION['choice']==6)
{
    $passedUserID = $_POST['updateUserID'];
    $passedRank = $_POST['updateRank'];
}
 
//customer
if($_SESSION['choice']==7)
{
    $passedUserID = $_POST['updateUserID'];
    $passedCompanyID = $_POST['updateCompanyID'];
}
        
//Employee
if($_SESSION['choice']==8)
{
    $passedUserID = $_POST['updateUserID'];
    $passedFirstName = $_POST['updateFirstName'];
    $passedLastName = $_POST['updateLastName'];
    $passedPassword = $_POST['updatePassword'];
    $passedRole = $_POST['updateRole'];
    $passedStatus = $_POST['updateStatus'];
    $passedRank = $_POST['updateRank'];
    $passedTotalHoursTraveled =$_POST['updateTotalHoursTraveling'];
}
        
//train
if($_SESSION['choice']==9)
{
    $passedTrainID = $_POST['updateTrainID'];
    $passedFROM = $_POST['updateFROM'];
    $passedTO = $_POST['updateTO'];
    $passedRunningDays = $_POST['updateRunningDays'];
    $passedTravelTime = $_POST['updateTravelTime'];
}
        
//car
if($_SESSION['choice']==12)
{
    $passedCarID = $_POST['updateCarNumber'];
    $passedCarType = $_POST['updateCarType'];
    $passedIsReserved = $_POST['updateIsReserved'];
}

//car type
if($_SESSION['choice']==13)
{
    $passedCarType = $_POST['updateCarType'];
    $passedCarPrice= $_POST['updateCarPrice'];
}

//reservations
if($_SESSION['choice']==14)
 {
    $passedCarID = $_POST['updateCarType'];
    $passedCompanyID = $_POST['updateCompanyID'];
    $passedReservationDate = $_POST['updateReservationDate'];
    $passedFinalPrice = $_POST['updateFinalPrice'];
    $passedDeparture = $_POST['updateDeparture'];
    $passedDestination = $_POST['updateDestination'];
 }

//assinged engineers
if($_SESSION['choice']==15)
{
    $passedAssignedUserID = $_POST['updateAssignedUserID'];
    $passedTrainID = $_POST['updateTrainID'];
}
 
//assinged conductors          
if($_SESSION['choice']==16)
{
     $passedAssignedUserID = $_POST['updateAssignedUserID'];
    $passedTrainID = $_POST['updateTrainID'];
}

//assigned loco
if($_SESSION['choice']==17)
{
     $passedAssignedLocoID = $_POST['updateAssignedLocoID'];
    $passedTrainID = $_POST['updateTrainID'];
}

//assigned car          
if($_SESSION['choice']==18)
{
    $passedAssignedCarID = $_POST['updateAssignedCarID'];
    $passedTrainID = $_POST['updateTrainID'];
}
?>
<?php
//user
if($_SESSION['choice']==1 || $_SESSION['choice']==2)
{
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
    <h2>These values will be updated.</h2>
    <br>
    <input class='btn btn-primary' type = 'submit' name = 'submitButton' value = 'Update'>
</form>";
}

if( (isset($_POST['submitButton']) && ($_SESSION['choice']==1 ||  $_SESSION['choice']==2)) ) 
{
    $passedUserID = $_POST['displayUserName'];
    $passedFirstName = $_POST['displayFirstName'];
    $passedLastName = $_POST['displayLastName'];

    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    checkLink($mysqli);
    updateUserTable($mysqli, $passedUserID, $passedFirstName, $passedLastName);
    $mysqli->close();
}

//role
if($_SESSION['choice']==3)
{
    echo "
<form action='' method='POST'>
    User Name:<br>
    <input type = 'text' name ='displayUserName' value ='$passedUserID' required='required' readonly> 
    <br>
    Password: <br>
    <input type = 'text' name ='displayPassword' value ='$passedPassword' >
    <br>
    Role: <br>
    <input type = 'text' name ='displayRole' value ='$passedRole' required='required' readonly >
    <br>
    <h2>These values will be updated.</h2>
    <br>
    <input type = 'submit' name = 'submitButton' value = 'Update'>
</form>";
}

if( isset($_POST['submitButton']) &&  $_SESSION['choice']==3)
{
    $passedUserID = $_POST['displayUserName'];
    $passedPassword = $_POST['displayPassword'];
    $passedRole = $_POST['displayRole'];

    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    checkLink($mysqli);
    updateAuthenticationTable($mysqli, $passedUserID, $passedPassword, $passedRole);
    $mysqli->close();
}
    
//status
if($_SESSION['choice']==4)
{
    echo "
<form action='' method='POST'>
    User Name:<br>
    <input type = 'text' name ='displayUserName' value ='$passedUserID' required='required' readonly> 
    <br>
    Status: <br>
    <input type = 'text' name ='displayStatus' value ='$passedStatus' readonly >
    <br>
    <select name='status' required='required'>
        <option value='1'>Active </option>
        <option value='2'>Inactive</option>
    </select>
    <h2>These values will be updated.</h2>
    <br>
    <input type = 'submit' name = 'submitButton' value = 'Update'>
</form>";
}

if( isset($_POST['submitButton']) &&  $_SESSION['choice']==4)
{
    switch($_POST['status'])
    {
        case 1:
            $active="Active";
        break;
            
        case 2:
            $active="Inactive";
        break;
    }
    $passedUserID = $_POST['displayUserName'];
    $passedStatus = $active;
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    checkLink($mysqli);
    updateOnSiteTable($mysqli, $passedUserID, $passedStatus);
    $mysqli->close();
}

//engineer
if($_SESSION['choice']==5)
{
    echo "
<form action='' method='POST'>
    User Name:<br>
    <input type = 'text' name ='displayUserName' value ='$passedUserID' required='required' readonly> 
    <br>
    Total Hours Traveled: <br>
    <input type = 'text' name ='displayTotalHoursTraveled' value ='$passedTotalHoursTraveled' >
    <br>
     Rank: <br>
    <input type = 'text' name ='displayRank' value ='$passedRank' >
    
    <select name='rank' required='required'>
        <option value='1'>Senior</option>
        <option value='2'>Junior</option>
    </select>
    <h2>These values will be updated.</h2>
    <br>
    <input type = 'submit' name = 'submitButton' value = 'Update'>
</form>";
}

if( isset($_POST['submitButton']) &&  $_SESSION['choice']==5)
{
    switch($_POST['rank'])
    {
        case 1:
            $rank="Senior";
        break;
            
        case 2:
            $rank="Junior";
        break;
    }
    $passedUserID = $_POST['displayUserName'];
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    checkLink($mysqli);
    updateEngineerTable($mysqli, $passedUserID, $rank);
    $mysqli->close();
}

//conductor
if($_SESSION['choice']==6)
{
    echo "
<form action='' method='POST'>
    User Name:<br>
    <input type = 'text' name ='displayUserName' value ='$passedUserID' required='required' readonly>
    <br>
    Rank:<br>
    <input type = 'text' name ='displayRank' value ='$passedRank' required='required' readonly> 
    New Rank: 
    <select name='rank' required='required'>
        <option value='1'>Junior</option>
        <option value='2'>Senior</option>  
    </select>
    <br>
    <h2>These values will be updated.</h2>
    <br>
    <input type = 'submit' name = 'submitButton' value = 'Update'>
</form>";
}

if( isset($_POST['submitButton']) &&  $_SESSION['choice']==6)
{
    switch($_POST['rank'])
    {
        case 1:
            echo $_POST['rank'];
            $rank="Junior";
        break;
            
        case 2:
            echo $_POST['rank'];
            $rank="Senior";
        break;
    }
    echo "<br>";
    echo $rank;
    echo "<br>";
    $passedUserID = $_POST['displayUserName'];
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    checkLink($mysqli);
    updateConductorTable($mysqli, $passedUserID, $rank);
    $mysqli->close();
}
    
//customer
if($_SESSION['choice']==7)
{
    echo "
<form action='' method='POST'>
    User Name:<br>
    <input type = 'text' name ='displayUserName' value ='$passedUserID' required='required' readonly> 
    <br>
    CompanyID:<br>
    <input type = 'text' name ='displayCompanyID' value ='$passedCompanyID' required='required'> 
    <br>
    <h2>These values will be updated.</h2>
    <br>
    <input type = 'submit' name = 'submitButton' value = 'Update'>
</form>";
}

if( isset($_POST['submitButton']) &&  $_SESSION['choice']==7)
{
    $passedUserID = $_POST['displayUserName'];
    $passedCompanyID = $_POST['displayCompanyID'];
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    checkLink($mysqli);
    $exists=checkCompanyID($mysqli, $passedCompanyID);
    if($exists==0)
    {
        updateCustomerTable($mysqli, $passedUserID, $passedCompanyID);
    }
    else
    {
        echo "<br> CompanyID taken please choose a unique companyID.<br>";
    }
    
    $mysqli->close();
}

//employee table
if($_SESSION['choice']==8)
{
echo "
<form action='' method='POST'>
    User Name:<br>
    <input type = 'text' name ='displayUserName' value ='$passedUserID' required='required' readonly> 
    <br>
    First Name: <br>
    <input type = 'text' name ='displayFirstName' value ='$passedFirstName' >
    <br>
    Last Name: <br>
    <input type = 'text' name ='displayLastName' value ='$passedLastName' required='required' >
    <br>
    Password: <br>
    <input type = 'text' name ='displayPassword' value ='$passedPassword' required='required' >
    <br>
    Role: <br>
    <input type = 'text' name ='displayRole' value ='$passedRole' >
    <br>
    Status: <br>
    <input type = 'text' name ='displayStatus' value ='$passedStatus'>
    <br>
    Rank: <br>
    <input type = 'text' name ='displayRank' value ='$passedRank'>
    <br>
    Total Hours Traveled: <br>
    <input type = 'text' name ='displayTotalHoursTraveled' value ='$passedTotalHoursTraveled' >
    <br>
    <h2>These values will be updated.</h2>
    <br>
    <input type = 'submit' name = 'submitButton' value = 'Update'>
</form>";
}

if( (isset($_POST['submitButton']) && $_SESSION['choice']==8) ) 
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
    
//train
if($_SESSION['choice']==9)
{
    echo "
<form action='' method='POST'>
    TrainID:<br>
    <input type = 'text' name ='displayTrainID' value ='$passedTrainID' required='required' readonly> 
    <br>
    FROM:<br>
    <input type = 'text' name ='displayFROM' value ='$passedFROM' required='required'> 
    <br>
    TO:<br>
    <input type = 'text' name ='displayTO' value ='$passedTO' required='required'> 
    <br>
    Running Days:<br>
    <input type = 'text' name ='displayRunningDays' value ='$passedRunningDays' required='required' readonly>
    <select name='runningDays' required='required'>
        <option value='1'>MTWThF</option>
        <option value='2'>MWF</option>
        <option value='3'>MW</option>
        <option value='4'>WF</option>
        <option value='5'>TTh</option>
    </select>
    <br>
    Travel Time:<br>
    <input type = 'text' name ='displayTravelTime' value ='$passedTravelTime' required='required'> 
    <br>
    <h2>These values will be updated.</h2>
    <br>
    <input type = 'submit' name = 'submitButton' value = 'Update'>
</form>";
}

if( isset($_POST['submitButton']) &&  $_SESSION['choice']==9)
{
    $passedTrainID = $_POST['displayTrainID'];
    $passedFROM = $_POST['displayFROM'];
    $passedTO = $_POST['displayTO'];
    switch($_POST['runningDays'])
    {
        case 1:
            $passedRunningDays="MTWThF";
        break;
            
        case 2:
            $passedRunningDays="MWF";
        break;
            
        case 3;
            $passedRunningDays="MW";
        break;
            
        case 4:
            $passedRunningDays="WF";
        break;
            
        case 5:
            $passedRunningDays="TTh";
        break;
    }
    $passedTravelTime = $_POST['displayTravelTime'];
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    checkLink($mysqli);
    updateTrainTable($mysqli, $passedTrainID, $passedFROM, $passedTO, $passedRunningDays, $passedTravelTime);
    $mysqli->close();
}
    
//car
if($_SESSION['choice']==12)
{
    echo "
<form action='' method='POST'>
    Car ID:<br>
    <input type = 'text' name ='displayCarID' value ='$passedCarID' required='required' readonly> 
    <br>
    Car Type:<br>
    <input type = 'text' name ='displayCarType' value ='$passedCarType' required='required' readonly> 
    <br>
    Is Reserved:<br>
    <input type = 'text' name ='displayIsReserved' value ='$passedIsReserved' required='required'> 
    <br>
    <select name='isReserved' required='required'>
        <option value='1'>Yes : 1</option>
        <option value='2'>No : 0</option>
    </select>
    <h2>These values will be updated.</h2>
    <br>
    <input type = 'submit' name = 'submitButton' value = 'Update'>
</form>";
}

if( isset($_POST['submitButton']) &&  $_SESSION['choice']==12)
{
    $passedCarID = $_POST['displayCarID'];
    $passedCarType = $_POST['displayCarType'];
    switch($_POST['isReserved'])
    {
        case 1:
            $passedIsReserved="1";
        break;
            
        case 2;
            $passedIsReserved="2";
        break;
    }
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    checkLink($mysqli);
    updateCarTable($mysqli, $passedCarID, $passedCarType, $passedIsReserved);
    $mysqli->close();
}
    
//car type
if($_SESSION['choice']==13)
{
    echo "
<form action='' method='POST'>
    Car Type:<br>
    <input type = 'text' name ='displayCarType' value ='$passedCarType' required='required' readonly> 
    <br>
    Car Price:<br>
    <input type = 'text' name ='displayCarPrice' value ='$passedCarPrice' required='required'> 
    <br>
    <h2>These values will be updated.</h2>
    <br>
    <input type = 'submit' name = 'submitButton' value = 'Update'>
</form>";
}

if( isset($_POST['submitButton']) &&  $_SESSION['choice']==13)
{
    $passedCarType = $_POST['displayCarType'];
    $passedCarPrice = $_POST['displayCarPrice'];
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    checkLink($mysqli);
    updateCarTypeTable($mysqli,$passedCarType, $passedCarPrice);
    $mysqli->close();
}
    
//reservations
if($_SESSION['choice']==14)
{
    echo "
<form action='' method='POST'>
    Car ID:<br>
    <input type = 'text' name ='displayCarID' value ='$passedCarID' required='required' readonly> 
    <br>
    Company ID:<br>
    <input type = 'text' name ='displayCompanyID' value ='$passedCompanyID' required='required'> 
    <br>
    Reservation Date:<br>
    <input type = 'text' name ='displayReservationDate' value ='$passedReservationDAte' required='required' readonly> 
    <br>
    Final Price:<br>
    <input type = 'text' name ='displayFinalPrice' value ='$passedFinalPrice' required='required'> 
    <br>
    Departure:<br>
    <input type = 'text' name ='displayDeparture' value ='$passedDeparture' required='required' readonly> 
    <br>
    Car Price:<br>
    <input type = 'text' name ='displayDestination' value ='$passedDestination' required='required'> 
    <br>
    <h2>These values will be updated.</h2>
    <br>
    <input type = 'submit' name = 'submitButton' value = 'Update'>
</form>";
}

if( isset($_POST['submitButton']) &&  $_SESSION['choice']==14)
{
    $passedCarID = $_POST['displayCarID'];
    $passedCompanyID = $_POST['displayCompanyID'];
    $passedReservationDate = $_POST['displayReservationDate'];
    $passedFinalPrice = $_POST['displayFinalPrice'];
    $passedDeparture = $_POST['displayDeparture'];
    $passedDestination = $_POST['displayDestination'];
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    checkLink($mysqli);
    echo "<br> update reservation table has not been written yet<br>";
    //updateReservationTable($mysqli, $passedCarID, $passedCompanyID, $passedReservationDate, $passedFinalPrice, $passedDeparture, $passedDestination);
    $mysqli->close();
} 

//assigned engineeers
if($_SESSION['choice']==15)
{
    echo "
    <form action='' method='POST'>
        User ID:<br>
        <input type = 'text' name ='displayCarID' value ='$passedAssignedUserID' required='required' readonly> 
        <br>
        Train ID:<br>
        <input type = 'text' name ='displayCompanyID' value ='$passedTrainID' required='required'> 
        <br>
        <h2>These values will be updated.</h2>
        <br>
        <input type = 'submit' name = 'submitButton' value = 'Update'>
    </form>";
}
if( isset($_POST['submitButton']) &&  $_SESSION['choice']==15)
{
    $passedAssignedUserID = $_POST['displayuserID'];
    $passedTrainID = $_POST['displayTrainID'];
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    checkLink($mysqli);
    updateAssignedEngineerTable($mysqli, $passedAssignedUserID, $passedTrainID);
}

//assigned conductors    
if($_SESSION['choice']==16)
{
    echo "
    <form action='' method='POST'>
        User ID:<br>
        <input type = 'text' name ='displayCarID' value ='$passedAssignedUserID' required='required' readonly> 
        <br>
        Train ID:<br>
        <input type = 'text' name ='displayCompanyID' value ='$passedTrainID' required='required'> 
        <br>
        <h2>These values will be updated.</h2>
        <br>
        <input type = 'submit' name = 'submitButton' value = 'Update'>
    </form>";
}
    
if( isset($_POST['submitButton']) &&  $_SESSION['choice']==16)
{
    $passedAssignedUserID = $_POST['displayuserID'];
    $passedTrainID = $_POST['displayTrainID'];
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    checkLink($mysqli);
    updateAssignedConductorTable($mysqli, $passedAssignedUserID, $passedTrainID);
}

//assigned locomotives
if($_SESSION['choice']==17)
{
     echo "
    <form action='' method='POST'>
        Loco ID:<br>
        <input type = 'text' name ='displayCarID' value ='$passedAssignedLocoID' required='required' readonly> 
        <br>
        Train ID:<br>
        <input type = 'text' name ='displayCompanyID' value ='$passedTrainID' required='required'> 
        <br>
        <h2>These values will be updated.</h2>
        <br>
        <input type = 'submit' name = 'submitButton' value = 'Update'>
    </form>";
}

if( isset($_POST['submitButton']) &&  $_SESSION['choice']==17)
{
    $passedCarID = $_POST['displayuserID'];
    $passedTrainID = $_POST['displayTrainID'];
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    checkLink($mysqli);
    updateAssignedLocomotiveTable($mysqli, $passedAssignedLocoID, $passedTrainID);
}

//assigned cars    
if($_SESSION['choice']==18)
{
    echo "
    <form action='' method='POST'>
        Loco ID:<br>
        <input type = 'text' name ='displayCarID' value ='$passedAssignedCarID' required='required' readonly> 
        <br>
        Train ID:<br>
        <input type = 'text' name ='displayCompanyID' value ='$passedTrainID' required='required'> 
        <br>
        <h2>These values will be updated.</h2>
        <br>
        <input type = 'submit' name = 'submitButton' value = 'Update'>
    </form>";
}
    
if( isset($_POST['submitButton']) &&  $_SESSION['choice']==18)
{
    $passedCarID = $_POST['displayCarID'];
    $passedTrainID = $_POST['displayTrainID'];
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    checkLink($mysqli);
    updateAssignedLocomotiveTable($mysqli, $passedAssignedCarID, $passedTrainID);
}
?>
</div>
</body>
</html>
