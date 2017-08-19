<!DOCTYPE html>
<head>
  <title>Register</title>
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
/*    h2 
    {
        margin: 0px;
    }

    a 
    {
        margin-left: 55px;
    }*/
    .container{
       margin-top: 5%;
       margin-left: 20px;
    }
    
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

<body>

  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      
      <div class="navbar-header">
        <a class="navbar-brand" href="http://cs3380.rnet.missouri.edu/~GROUP8/">Missouri Rail</a>
      </div>

      <ul class="nav navbar-nav">
        <li class="active"><a href="">Register</a></li>
      </ul>


    </div>
  </nav> <!-- End of navbar-inverse -->




<form action="" method=POST>
    <div class="container">
    <h2>Register for an Account:</h2>
    <label><b>Username:</b></label>
    <input class="inpt" type=text name="uname" required="required"> 
    <br>
        
    <label><b>Password:</b></label>
    <input class="inpt" type=password name="pass" required="required">
    <br>
        
    <label><b>First Name:</b></label>
    <input class="inpt" type=text name="fname" required="required">
    <br>    
        
    <label><b>Last Name:</b></label>
    <input class="inpt" type=text name="lname" required="required"> 
    <br>    
        
    <input class="btn btn-primary" type="submit" name="submit" value="Register">
    <a href="http://cs3380.rnet.missouri.edu/~GROUP8/">Already have an account?</a>
</form>

<?php
include("database.php");
include("functions.php");
    
$customer = "customer";
if(isset($_POST['submit']))
{
    $mysqli= connectToDB();
    if($mysqli->connect_errno)
    {
        echo "Connection failed";
        exit();
    }
    $query = "SELECT * FROM Authentication WHERE user_id=?";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        echo "USER EXISTS <br></br>";
        exit();
    }
    $stmt->bind_param("s", $_POST['uname']);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows;
    echo "Found: " . $exists;
    if($exists == 0)
    {
        $query = "INSERT INTO `User` VALUES(?,?,?)";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query))
        {
            exit();
        }
        $stmt->bind_param("sss", $_POST['uname'], $_POST['fname'],$_POST['lname']);
        $stmt->execute();
        
        $query = "INSERT INTO `Authentication` VALUES(?,?,?)";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query))
        {
            exit();
        }
        $hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $_POST['uname'], $hash, $customer);
        $stmt->execute();
        
        $query = "INSERT INTO `Customer` (user_id) VALUES (?)";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query))
        {
            exit();
        }
        $stmt->bind_param("s", $_POST['uname']);
        $stmt->execute();
        echo "<hr>User created<br>";
        
    } 
    else 
    {
        echo "<hr>User name taken";
    }
    $stmt->close();
    $mysqli->close();
}
?>
</body>
</html>
