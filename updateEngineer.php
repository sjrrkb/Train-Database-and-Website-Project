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
    </head>

</head>
<body class="container">
   <br>
<a href="http://cs3380.rnet.missouri.edu/~GROUP8/engineerLogs.php"><?php echo $_SESSION['uname']?>'s Logs </a>
    <br>
<a href="http://cs3380.rnet.missouri.edu/~GROUP8/engineerProfile.php"><?php echo $_SESSION['uname']?>'s Homepage </a>    
<form action="" method="POST">
    <input type="submit" name="logout" value="Log out" class="btn btn-primary">
</form>
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
    <input type = 'text' name ='displayRole' value ='$passedRole' required='required' >
    <br>
    Status: <br>
    <input type = 'text' name ='displayStatus' value ='$passedStatus' required='required' >
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

</body>
</html>
