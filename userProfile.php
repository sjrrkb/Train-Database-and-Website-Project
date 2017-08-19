<?php 
    session_start();
    if(!isset($_SESSION['uname']))  
    {
        header('Location: index.php');
    }
        echo "<div>Welcome to ".$_SESSION['uname']."'s Profile page!!</div>";
    else
    {
        
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <form action="" method=POST>
            <a href="http://cs3380.rnet.missouri.edu/~sjrrkb/lab7/login.php/">Logout</a>
        </form>
        <?php
            session_destroy();
            session_unset();
        ?>
    </body>

</html>
