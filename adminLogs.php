<?php
    session_start();
    if(isset($_SESSION['uname']))
    {
        echo $_SESSION['uname'] . ", you are still logged in. <br>";
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

.drpdwn {
	border: 0 !important;
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

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Missouri Rail</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="http://cs3380.rnet.missouri.edu/~GROUP8/adminProfile.php">Home</a></li>
      <li><a href="http://cs3380.rnet.missouri.edu/~GROUP8/insert.php">Add Employee or Equipment</a></li>
      <li class="active"><a href="#"><?php echo $_SESSION['uname']?>'s Logs </a></li>
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
    <hr>
    <form action="" method="POST" class="col-md-7 col-md-offset-3">
        Search Logs by:
        <select class="drpdwn"name="choice" required="required">
            <option value="1">UserName</option>
            <option value="2">Action</option>
            <option value="3">Time of Action</option>
            <option value="4">IP Address</option>
        </select>
        <input class="inpt" type="text" name="search">
        <input class="btn btn-primary" type="submit" name="submit" value="Search">
        
    </form>
<?php
include("database.php");
include("functions.php");
if(isset($_POST['search']))
{
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
	checkLink($mysqli);
    switch($_POST['choice'])
    {
        case 1:
            $sql="SELECT * FROM User_Logs WHERE user_id LIKE ? ORDER BY user_id" ;
        break;
            
        case 2:
            $sql="SELECT * FROM User_Logs WHERE action_taken LIKE ? ORDER BY action_taken";
        break;
            
        case 3:
            $sql="SELECT * FROM User_Logs WHERE action_taken_time LIKE ? ORDER BY action_taken_time;";
        break;
            
        case 4:
            $sql="SELECT * FROM User_Logs WHERE IP_address LIKE ? ORDER BY IP_address;";
        break;
    }
    $stmt = $mysqli->stmt_init();
    if( !$stmt->prepare($sql) )
    {
        echo "Exit";
        exit();
    }
    $param="{$_POST['search']}%";
    $stmt->bind_param("s", $param);
    $stmt->execute();
	$result = $stmt->get_result();
    echo "<table class='table table-hover'>";
    printLogTable($result);
    
    
    
}
?>
</div>
</body>
</html>
