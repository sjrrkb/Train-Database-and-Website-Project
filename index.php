<!DOCTYPE html>
<html>
  <head>
    <title>Missouri Rail</title>
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

    body { 
    height: 100%;
    width: 100%;
    }
  .container{
    width: 100%;
    height: 800px;
    margin-top: 0px;
    /*margin-top: auto;*/
    background-color: blue;
    background: url("https://media.giphy.com/media/RQijvpE3UG5HO/giphy.gif") no-repeat center center fixed; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;*/
  }
  .panel-default, .panel-danger {
  opacity: 0.95;
  margin-top:50px;
  }
  .form-group.last { margin-bottom:0px; }
     


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
    outline: none;
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


<?php
    session_start(); 

    include("database.php");
    include("functions.php");

    $checkUserPass = $checkUserPass;

   connectToDB();
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $exists=0;
        $conn = connectToDB();
        $usrnm = (isset($_POST['uname']) ? $_POST['uname'] : NULL);
        $usrnm = htmlspecialchars($usrnm);
        $psswd = (isset($_POST['psw']) ? $_POST['psw'] : NULL);
        $psswd = htmlspecialchars($psswd);

       $exist = checkUser($conn,$usrnm,$psswd);
        // echo $exist;
        if($exist==1)
        {
            // session_start();
            $_SESSION['uname']=$usrnm;
            $_SESSION['role'] = "Customer";
            $checkUserPass = "Correct";
            // header('Location: http://cs3380.rnet.missouri.edu/~GROUP8/customerProfile.php');
            // exit();
        }
        if($exist==2)
        {
            // session_start();
            $_SESSION['uname']=$usrnm;
            $_SESSION['role'] = "Admin";
            $checkUserPass = "Correct";
            // header('Location: http://cs3380.rnet.missouri.edu/~GROUP8/adminProfile.php');
            // exit();
        }
        if($exist==3)
        {
            // session_start();
            $_SESSION['uname']=$usrnm;
            $_SESSION['role'] = "Engineer";
            $checkUserPass = "Correct";
            // header('Location: http://cs3380.rnet.missouri.edu/~GROUP8/engineerProfile.php');
            // exit();
        }
        if($exist==4)
        {
            // session_start();
            $_SESSION['uname']=$usrnm;
            $_SESSION['role'] = "Conductor";
            $checkUserPass = "Correct";
            // header('Location: http://cs3380.rnet.missouri.edu/~GROUP8/conductorProfile.php');
            // exit();
        }
        else
        {
            // echo"<div>Incorrect Username or Password</div>";
          $checkUserPass = "Incorrect";
        }
        $conn->close();
    }






    if(isset(($_POST['logout'])))
    {
        session_unset();
        session_destroy();
        header("Location: http://cs3380.rnet.missouri.edu/~GROUP8/index.php");
    }

    if(isset($_SESSION['uname']))
    {
?>

        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container-fluid">
            
            <div class="navbar-header">
              <a class="navbar-brand" href="">Missouri Rail</a>
            </div>

            <!-- <ul class="nav navbar-nav">
              <li class="active"><a href="">Profile</a></li>
              <li><a href="http://cs3380.rnet.missouri.edu/~GROUP8/conductorLogs.php">Logs</a></li>
            </ul> -->

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

                                            <?php

                                              if($_SESSION['role'] == "Admin"){
                                                echo '<a href="http://cs3380.rnet.missouri.edu/~GROUP8/adminProfile.php" class="btn btn-primary btn-block btn-sm">View Profile</a>';
                                              } 
                                              elseif($_SESSION['role'] == "Engineer"){
                                                echo '<a href="http://cs3380.rnet.missouri.edu/~GROUP8/engineerProfile.php" class="btn btn-primary btn-block btn-sm">View Profile</a>';
                                              } 
                                              elseif($_SESSION['role'] == "Conductor"){
                                                echo '<a href="http://cs3380.rnet.missouri.edu/~GROUP8/conductorProfile.php" class="btn btn-primary btn-block btn-sm">View Profile</a>';
                                              } 
                                              elseif($_SESSION['role'] == "Customer"){
                                               echo  '<a href="http://cs3380.rnet.missouri.edu/~GROUP8/customerProfile.php" class="btn btn-primary btn-block btn-sm">View Profile</a>';
                                              }   
                                            ?>      
                                                                            
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

</div>



<?php

    } //----end of if(isset($_SESSION['uname']))----// 
    else{
?>

        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container-fluid">
            
            <div class="navbar-header">
              <a class="navbar-brand" href="">Missouri Rail</a>
            </div>

            <!-- <ul class="nav navbar-nav">
              <li class="active"><a href="">Profile</a></li>
              <li><a href="http://cs3380.rnet.missouri.edu/~GROUP8/conductorLogs.php">Logs</a></li>
            </ul> -->
        </div>
      </nav> <!-- End of navbar-inverse -->



      <div class="container">
          <div class="row">
              <div class="col-md-4 col-md-offset-7">
                  

                  <!-- <div class="panel panel-default">  --><!-- start panel -->
                     <?php 
                          if($checkUserPass == "Incorrect"){
                              echo ' <div class="panel panel-danger">';
                          }
                          else{
                              echo ' <div class="panel panel-default">';
                          }
                        ?> 

                      <div class="panel-heading">
                        <?php 
                          if($checkUserPass == "Incorrect"){
                              echo '<span class="glyphicon glyphicon-warning-sign"></span></strong> Incorrect: Username or Password</strong>';
                          }
                          else{
                              echo '<span class="glyphicon glyphicon-lock"></span> Please Login';
                          }
                        ?>
                      </div>

                      <div class="panel-body"> 
                          <form class="form-horizontal" role="form" method="post">
                              <div class="form-group">
                                  <label for="inputUserName3" class="col-sm-3 control-label">
                                      Username:</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control" id="inputUserName3" placeholder="Username" name="uname" required>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="inputPassword3" class="col-sm-3 control-label">
                                      Password:</label>
                                  <div class="col-sm-9">
                                      <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="psw" required>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-sm-offset-3 col-sm-9">
                                      <div class="checkbox">
                                          <label>
                                              <input type="checkbox"/>
                                              Remember me
                                          </label>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group last">
                                  <div class="col-sm-offset-3 col-sm-9">
                                      <button type="submit" class="btn btn-success btn-sm" name="logSubmit">
                                          Sign in</button>
                                           <button type="reset" class="btn btn-default btn-sm">
                                          Reset</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                      <div class="panel-footer">
                          Not Registred? <a href="http://cs3380.rnet.missouri.edu/~GROUP8/register.php/">Register here</a></div>
                  </div><!-- end of panel -->

              </div> 
          </div>
      </div>


<?php
      } //---end of else---//
?>


</body>
</html>
