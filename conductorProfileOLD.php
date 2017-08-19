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
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Group 8</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
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


   <br>
    
    <hr>
 <form action="" method="POST" class="col-md-6 col-md-offset-3">
	<input class="btn btn-primary" type="submit" name="trainsAssigned" value="View Trains Assigned">
	<input class="btn btn-primary" type="submit" name="personalInfo" value="View Personal Information">
</form>
<?php
if(isset($_POST['trainsAssigned']))
{
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
	checkLink($mysqli);
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
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

if(isset($_POST['personalInfo']))
{
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
	checkLink($mysqli);
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
	checkLink($mysqli);
    $sql = "SELECT * FROM `join_Con_Eng_Admin` WHERE `user_id`=?;";
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
    printEmployeeConductorTable($result);
}
?>
</div>
</body>
</html>
