<?php
    session_start();
    if(isset($_SESSION['uname']))
    {
       // echo $_SESSION['uname'] . ", you have successfully been logged in. <br>";
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

<body>

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      
      <div class="navbar-header">
        <a class="navbar-brand" href="http://cs3380.rnet.missouri.edu/~GROUP8/">Missouri Rail</a>
      </div>

      <ul class="nav navbar-nav">
        <li><a href="http://cs3380.rnet.missouri.edu/~GROUP8/conductorProfile.php">Profile</a></li>
        <li class="active"><a href="">Logs</a></li>
        
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
    <hr>
    <form action="" method="POST" class="col-md-6 col-md-offset-3">
<!-- conductor
    1. see trains assinged to
    2. edit individual info
    3. see logs
-->
 Search Logs by:
        <select class="drpdwn" name="choice" required="required">
            <option value="1">Action</option>
            <option value="2">Time of Action</option>
            <option value="3">IP Address</option>
        </select>
        <input class="inpt" type="text" name="search">
        <input class="btn btn-primary" type="submit" name="submit" value="Search">
        
    </form>
<?php
include("database.php");
include("functions.php");
if(isset($_POST['search'])){	//allow user to search logs 
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
	checkLink($mysqli);
    switch($_POST['choice'])
    {       
        case 1:
            $sql="SELECT * FROM User_Logs WHERE (user_id=? AND action_taken LIKE ?) ORDER BY action_taken";
        break;
            
        case 2:
            $sql="SELECT * FROM User_Logs WHERE (user_id=? AND action_taken_time LIKE ?) ORDER BY action_taken_time;";
        break;
            
        case 3:
            $sql="SELECT * FROM User_Logs WHERE (user_id=? AND IP_address LIKE ?) ORDER BY IP_address;";
        break;
    }
    $stmt = $mysqli->stmt_init();
    if( !$stmt->prepare($sql) )
    {
        echo "Exit";
        exit();
    }
    $param="{$_POST['search']}%";
    $stmt->bind_param("ss", $_SESSION['uname'], $param);
    $stmt->execute();
	$result = $stmt->get_result();
    echo "<table class='table table-hover'>";
    printLogTable($result);
}
else{		//display all logs on page entry 
	$mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
	checkLink($mysqli);
    $sql="SELECT user_id AS 'User',
				action_taken AS 'Action Description',
				action_taken_time AS 'Timestamp of Action',
				IP_address AS 'IP Address'
			FROM User_Logs WHERE (user_id=?) ORDER BY action_taken_time DESC;";
    $stmt = $mysqli->stmt_init();
    if( !$stmt->prepare($sql) )
    {
        echo "Exit";
        exit();
    }
    $stmt->bind_param("s", $_SESSION['uname']);
    $stmt->execute();
	$result = $stmt->get_result();
    echo "<table class='table table-hover'>";
    printLogTable($result);
}


?>
</div>
</body>
</html>
