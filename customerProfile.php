<?php
    include("database.php");
    include("functions.php");
    session_start();
    if(isset($_SESSION['uname']))
    {
      if( ($_SESSION['role'] == "Admin") || ($_SESSION['role'] == "Engineer") || ($_SESSION['role'] == "Conductor")){
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
    <title>Customer Profile</title>
    <meta charset="utf-8">
	    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="http://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>    <!-- jQuery library -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> <!-- Latest compiled JavaScript -->
    
    <link rel="stylesheet" type="text/css" href="CSS/navBar.css">

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
    color: rgba(140,140,140,1);
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
  	.res_table{
  		font-size: 18px;
  		padding: 15px;
  		color: black;
  		float: center;
  	}
    .table-striped>tbody>tr:nth-child(odd)>td,
    .table-striped>tbody>tr:nth-child(odd)>th {
      background-color: rgba(91, 145, 191, 0.1);
    }
    th, td{
      text-align: center;
    }
    .inputHolder{
      margin-right: 5px;
      float: left;
    }
  </style>

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

</head>






<body>

    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        
        <div class="navbar-header">
          <a class="navbar-brand" href="http://cs3380.rnet.missouri.edu/~GROUP8/">Missouri Rail</a>
        </div>

        <ul class="nav navbar-nav">
          
          <li class="active"><a href=""><?php echo $_SESSION['uname']."'s Profile";?></a></li>
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
                                            <a href="http://cs3380.rnet.missouri.edu/~GROUP8/customerProfile.php" class="btn btn-primary btn-block btn-sm">View Profile</a>
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
<br>
	<h3>Hello <?php echo $_SESSION['uname'];?>, what would you like to do today?</h3>
	<br>
  <div class="inputHolder">
    <form class="inputHolder" action="" method="POST">
  		<input class="btn btn-primary" type="submit" name="chg_info" value="View/Update My Info" />
  	</form>
    <form class="inputHolder" action="" method="POST">
      <input class="btn btn-primary" type="submit" name="see_res" value="See My Reservations" />
  	</form>
  	<form class="inputHolder" action="customerRentCar.php" method="POST">
  		<input class="btn btn-primary" type="submit" name="search" value="Search a Car" />
  	</form>
  </div>
  <br />
	<hr>



	<!-- Do PHP down here -->
<?php
	echo "<div class='col-md-6 col-md-offset-3' style='text-align: center;'>";

	//Execute this if user has submitted updates to info
	if(isset($_POST['update']) && validatePassword($mysqli=connectToDB(), $_SESSION['uname'], $_POST['current_psswd'])){
		updateUserTable($mysqli, $_SESSION['uname'], $_POST['fname'], $_POST['lname']);
		if(!empty($_POST['new_psswd'])){
			updateAuthenticationTable($mysqli, $_SESSION['uname'], $_POST['new_psswd'], 'Customer');
		}
		$success = 1;

	}
	else{
		$success = 0;
	}
	echo "</div>";		//////

	//Display if user chose to change their information
	if(isset($_POST['chg_info']) || isset($_POST['update'])){

		$mysqli=connectToDB();				//connect to database
		checkLink($mysqli);

		echo "<div class='col-md-6 col-md-offset-3' style='text-align: center; font-size: 18px; '>";
		echo "<h3>Change Your Info</h3>";

		//get current user info
		$sql = "SELECT user_id, first_name, last_name FROM User WHERE user_id=?;";
		$stmt = $mysqli->stmt_init();
		if(!$stmt->prepare($sql)){
			echo "Error in preparing statement line 85";
			exit();
		}
		$stmt->bind_param("s",$_SESSION['uname']);
		$stmt->execute();							//execute query
		$result = $stmt->get_result();				//get results
		$row = $result->fetch_array(MYSQLI_ASSOC) or die ($mysqli->error);//get row
?>
		<form action="" method="POST" >
			User ID: <?= $row["user_id"] ?><br>
			First Name:
			<input class="inpt" type='text' name="fname" required="required" value= <?= $row["first_name"] ?> /><br>
			Last Name:
			<input class="inpt" type='text' name="lname" required="required" value= <?= $row["last_name"] ?> /><br>
			New Password:
			<input class="inpt" type='password' name="new_psswd"  /><br>
			Enter Current Password to Update:
			<input class="inpt" type='password' name="current_psswd" required="required" /><br><br>
			<input class="btn btn-primary" type="submit" name="update" value="Update" />
		</form>
<?php
		if($success == 1){
			echo "Your information was successfully updated.";	//print update success
		}
		elseif(isset($_POST['update']) && ($success==0)){
			echo "<p style='color:red;'>Incorrect password, information not updated</p>";
		}

		$stmt->close();			//close prepared statement and database
		$mysqli->close();
		echo "</div>";
	}//end change user info

?>

<?php
	//if user chose to see their reservations
	if(isset($_POST['see_res'])){
		$mysqli=connectToDB();				//connect to database
		checkLink($mysqli);

		//get current user info
		$sql = "SELECT reservation_date AS 'Date', 
						reservation_time AS 'Time', 
						car_id AS 'Car #', 
						final_price AS 'Price',
						departure AS 'Departure', 
						destination AS 'Destination' 
					FROM Reservations 
						WHERE company_id=
						(SELECT company_id FROM Customer WHERE user_id=?) 
					ORDER BY reservation_date DESC, reservation_time DESC;";
		$stmt = $mysqli->stmt_init();
		if(!$stmt->prepare($sql)){
			echo "Error in preparing statement line 215";
			exit();
		}
		$stmt->bind_param("s",$_SESSION['uname']);
		$stmt->execute();							//execute query
		$result = $stmt->get_result();				//get results

    ?>
      <div class="row">
        <div class="panel panel-success">
          <div class="panel-heading">
            <div class="row">
              <div class="col-sm-12">
                <h class="panel-title"> <font size="5">Your Reservations</font> </h>
              </div>
            </div>
          </div>
          <?php
            printReserv($result);
          ?>
        </div>
      </div>
    <?php


		$stmt->close();			//close prepared statement and database
		$mysqli->close();

	}//end see reservations

  function printReserv($result){
    echo "<table class='table table-striped'>
          <tr>
            <th>Date</th><th>Time</th><th>CarID</th><th>Price</th><th>Departure</th><th>Destination</th>
          </tr>
          <tbody>";
    $numRow = mysqli_num_rows($result);
    if($numRow == 0){
      echo "<tr>
              <td colspan='6'>It Looks Like You Dont Have Any Reservations With Us Yet</td>
            </tr>";
      exit();
    }
    while($row = $result->fetch_array(MYSQLI_NUM)){
      echo "<tr>
              <td class='text-center'>$row[0]</td>
              <td class='text-center'>$row[1]</td>
              <td class='text-center'>$row[2]</td>
              <td class='text-center'>$row[3]</td>
              <td class='text-center'>$row[4]</td>
              <td class='text-center'>$row[5]</td>
            </tr>";
    }
    echo "</tbody></table>";
  }
	//if user chose to search cars, page will redirect to customerRentCar.php


	//echo "</div>";		//close php printing div
?>

</div>
	<hr>
</body>

</html>
