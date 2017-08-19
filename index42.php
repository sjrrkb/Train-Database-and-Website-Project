
<!DOCTYPE>
<html>
    <head>
        <title>Login Form</title>
        <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
        <style>
            input 
            {
                margin: 03px;
            }
            
            h2
            {
                margin: 0px;
            }
            
            a 
            {
                margin-left: 55px;
            }

        </style>

    </head>
<body class="container">
<form action="" method="post">
    <div class="container">
    <h2>Please Login to Your Account:</h2>
    <label><b>Username:</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>
    <br>
    <label><b>Password:</b></label>
    <input type="password" placeholder="Enter Password" name="psw" >
    <br>
    <button type="submit" name="logSubmit">Login</button>
    <a href="http://cs3380.rnet.missouri.edu/~GROUP8/register.php/">Need to register?</a>
    </div>
</form>      
<?php
    include("database.php");
    include("functions.php");
    
    connectToDB();
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $conn = connectToDB();
        $usrnm = (isset($_POST['uname']) ? $_POST['uname'] : NULL);
        $usrnm = htmlspecialchars($usrnm);
        $psswd = (isset($_POST['psw']) ? $_POST['psw'] : NULL);
        $psswd = htmlspecialchars($psswd);

        $exist = checkUser($conn,$usrnm,$psswd);
        echo $exist;
        if($exist==1)
        {
            session_start();
            $_SESSION['uname']=$usrnm;
            header('Location: http://cs3380.rnet.missouri.edu/~GROUP8/customerProfile.php');
            exit();
        }
        if($exist==2)
        {
            session_start();
            $_SESSION['uname']=$usrnm;
            header('Location: http://cs3380.rnet.missouri.edu/~GROUP8/adminProfile.php');
            exit();
        }
        if($exist==3)
        {
            session_start();
            $_SESSION['uname']=$usrnm;
            header('Location: http://cs3380.rnet.missouri.edu/~GROUP8/engineerProfile.php');
            exit();
        }
        if($exist==4)
        {
            session_start();
            $_SESSION['uname']=$usrnm;
            header('Location: http://cs3380.rnet.missouri.edu/~GROUP8/conductorProfile.php');
            exit();
        }
        else
        {
            echo"<div>Incorrect Username or Password</div>";
        }
        $conn->close();
    }
?>

</body>
</html>


