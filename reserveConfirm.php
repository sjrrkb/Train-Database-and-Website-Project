<?php
  include("database.php");
  include("functions.php");
  session_start();
  if(isset($_SESSION['uname'])){
     if( ($_SESSION['role'] == "Admin")){
	   header("Location: http://cs3380.rnet.missouri.edu/~GROUP8/adminProfile.php");
	}
	// echo $_SESSION['uname'] . ", you have successfully been logged in. <br>";
  }else{
    echo "Session not created yet<br>";
    header("Location: http://cs3380.rnet.missouri.edu/~GROUP8/index.php");
  }
  if(isset(($_POST['logout']))){
    session_unset();
    session_destroy();
    header("Location: http://cs3380.rnet.missouri.edu/~GROUP8/index.php");
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Confirm Reservation</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
    <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="ddtf.js"></script>
    <link rel="stylesheet" type="text/css" href="CSS/navBar.css">

    <script>
      $(function(){
        $("#trainTable").ddTableFilter();
      });

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
      h2{
        text-align: center;
      }
      .dropDown{
        border: 1px solid gray;
        padding: 5px;
        border-radius: 8px;
        box-shadow: 0 0 3px gray;
        background: rgba(40,40,40,0.4);
      }
      .dropDown:focus{
        outline: none;
      }
      th, td{
        text-align: center;
      }
      .panel > .panel-heading {
        background-image: none;
        background-color: rgb(9, 63, 109);
        color: white;
      }
      .table-striped>tbody>tr:nth-child(odd)>td,
      .table-striped>tbody>tr:nth-child(even)>th {
        background-color: rgba(91, 145, 191, 0.1);
      }
/*      .filterable {
        margin-top: 15px;
      }
      .filterable .panel-heading .pull-right {
        margin-top: -20px;
      }
      .filterable .filters input[disabled] {
        background-color: transparent;
        border: none;
        cursor: auto;
        box-shadow: none;
        padding: 0;
        height: auto;
      }
      .filterable .filters input[disabled]::-webkit-input-placeholder {
        color: #333;
      }
      .filterable .filters input[disabled]::-moz-placeholder {
        color: #333;
      }
      .filterable .filters input[disabled]:-ms-input-placeholder {
        color: #333;
      }*/
      .ui-widget-header {
        background: #cedc98;
        border: 1px solid #DDDDDD;
        color: #DDDDDD;
        font-weight: bold;
      }
      .progress-label {
        text-align: center;
        padding: 10px;
        left: 50%;
        top: 13px;
        font-weight: bold;
        text-shadow: 1px 1px 0 #fff;
      }
      #progressholder{
        text-align: center;
        padding-bottom: 5px;
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
          <li><a href="http://cs3380.rnet.missouri.edu/~GROUP8/customerProfile.php"><?php echo $_SESSION['uname']."'s Profile";?></a></li>
          <li><a href="http://cs3380.rnet.missouri.edu/~GROUP8/customerRentCar.php">Search a Car</a></li>
          <li class="active"><a href="">Reservation</a></li>
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
      <?php
        if(isset($_POST['Reserve'])){
          echo "<h2>Confirm Your Reservation</h2>";
        }
        if(isset($_POST['Select'])){
          echo "<h2>Thank You For Choosing Missouri Rail!</h2>";
        }
      ?>
      <hr>
      <div class="row">
        <div class="panel panel-success filterable">
          <div class="panel-heading">
            <div class="row">
              <?php
                if(isset($_POST['Reserve'])){
                  ?>
                    <div class="col-sm-11">
                      <h class="panel-title"> <font size="5">Your Selected Car</font> </h>
                    </div>
                    <div class="col-sm-1">
                      <button class="btn btn-danger btn-sm btn-filter" onclick="window.location='customerRentCar.php'">Cancel</button>
                    </div>
                  <?php
                }
                if(isset($_POST['Select'])){
                  ?>
                    <div class="col-sm-12">
                      <h class="panel-title"> <font size="5">We Are Preparing Your Order</font> </h>
                    </div>
                  <?php
                }
              ?>
            </div>
          </div>
          <?php
            if(isset($_POST['Reserve'])){
              $carID = checkCar($_POST['carID']);
              $cargo = checkCar($_POST['carType']);
              $carLo = checkCar($_POST['carLoc']);
              $carPr = checkCar($_POST['carPrice']);
              displayCar($carID, $cargo, $carLo, $carPr);
            }
            function displayCar($carID, $cargo, $carLo, $carPr){
              echo "<table class='table table-striped'>
                      <tr>
                        <th>CarID</th><th>Cargo</th><th>Departure</th><th>Price</th>
                      </tr>
                      <tr>
                        <td>$carID</td><td>$cargo</td><td>$carLo</td><td>$$carPr</td>
                      </tr>
                    </table>";
            }
            function checkCar($x){
              $x = empty($x) ? header('Location: customerRentCar.php') : $x;
              $x = htmlspecialchars($x);
              return $x;
            }
            if(isset($_POST['Select'])){
              $trainID = checkCar($_POST['trainID']);
              $destin = checkCar($_POST['dest']);
              $carID = checkCar($_POST['carID']);
              $carLo = checkCar($_POST['carLoc']);
              $carPr = checkCar($_POST['carPrice']);
              addReservation($carID, $destin, $carPr, $carLo, $trainID);
              assign_car($carID);
              echo "<div class='progress-label'>
                    </div>";
              ?>
              <div id="progressholder">
                <div id="progress-bar">
                </div>
                <button id="resBtn" class="btn btn-info btn-sm btn-filter" onclick="window.location='customerProfile.php'">You Can View Your Reservation Here</button>
              </div>
              <?php
              echo "<script>
                      $(function(){
                        $('#resBtn').hide();
                        var progressbar = $('#progress-bar');
                        progressLabel = $('.progress-label');
                        $('#progress-bar').progressbar({
                          value: false,
                          change: function(){
                            progressLabel.text(
                            progressbar.progressbar('value') + '%');
                          },
                          complete: function(){
                            progressLabel.text('Your Reservation Has Been Submitted');
                            progressbar.hide();
                            $('#resBtn').show();
                          }
                        });
                        function progress(){
                          var val = progressbar.progressbar('value') || 0;
                          progressbar.progressbar('value', val + 1);
                          if(val < 99){
                            setTimeout(progress, 30);
                          }
                        }
                        setTimeout(progress, 1);
                      });
                    </script>";
            }
            function addReservation($carID, $destin, $carPr, $carLo, $trainID){
              $conn = connectToDB();
              date_default_timezone_set("America/Chicago");
              $date = date("Ymd");
              $time = date("hisa");
              $userID = $_SESSION['uname'];
              $sql = "INSERT INTO Reservations(car_id, company_id, reservation_date,
                                  reservation_time, final_price, departure, destination)
                      VALUES('$carID', (SELECT Customer.company_id FROM Customer WHERE user_id='$userID'), '$date', '$time', '$carPr', '$carLo', '$destin')";

              $stmt = $conn->stmt_init();
              if(!$stmt->prepare($sql)){
                echo "Insert reservation";
                exit();
              }
              $stmt->execute();
              $stmt->close();
              //assign_car() already updates train.length and car.is_reserved
	      //updateCar($carID, $trainID, $conn);
            }
            function updateCar($carID, $trainID, $conn){
              $sql = "UPDATE Car
                      SET is_reserved=1
                      WHERE car_id='$carID'";

              $stmt = $conn->stmt_init();
              if(!$stmt->prepare($sql)){
                echo "Insert reservation";
                exit();
              }
              $stmt->execute();
              $stmt->close();
              updateTrain($trainID, $conn);
            }
            function updateTrain($trainID, $conn){
              $sql = "UPDATE Train
                      SET length=length+1
                      WHERE train_ID='$trainID'";

              $stmt = $conn->stmt_init();
              if(!$stmt->prepare($sql)){
                echo "Update Train";
                exit();
              }
              $stmt->execute();
              $stmt->close();
              $conn->close();
            }
          ?>
        </div>
        <?php
          if(isset($_POST['Reserve'])){
            ?>
            <div class="panel panel-success filterable">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-sm-12">
                    <h class="panel-title"> <font size="5">Available Train(s)</font> </h>
                  </div>
                </div>
              </div>
              <?php
                $carID = checkCar($_POST['carID']);
                $carPr = checkCar($_POST['carPrice']);
                $result = searchTrain($carLo);
                displayTrain($result, $carID, $carLo, $carPr);
              ?>
            </div>
            <?php
          }
          function displayTrain($result, $carID, $carLo, $carPr){
            $i = 1;
            echo "<table class='table table-striped' id='trainTable'>
                    <th class='skip-filter'>TrainID</th>
                    <th class='skip-filter'>Departure</th>
                    <th>Destination</th>
                    <th class='skip-filter'>RunningDays</th>
                    <th class='skip-filter'>TravelHours</th>
                    <th><font size='4'><em class='glyphicon glyphicon-check'></em></font> AddToTrain</th>
                    <tbody>";
            while($row = $result->fetch_array(MYSQLI_NUM)){
              echo "<tr>
                      <td class='text-center'>$row[0]</td>
                      <td class='text-center'>$row[1]</td>
                      <td class='text-center'>$row[2]</td>
                      <td class='text-center'>$row[3]</td>
                      <td class='text-center'>$row[4]</td>
                      <td class='text-center'>
                        <form action='reserveConfirm.php' method='POST' id='ReserveConfirm$i'>
                          <input type='hidden' name='trainID' value='$row[0]' />
                          <input type='hidden' name='dest' value='$row[2]'>
                          <input type='hidden' name='carID' value='$carID' />
                          <input type='hidden' name='carLoc' value='$carLo' />
                          <input type='hidden' name='carPrice' value='$carPr' />
                          <button class='btn btn-success btn-sm' type='submit' form='ReserveConfirm$i' name='Select'>
                            <span class='glyphicon glyphicon-check'></span> Select
                          </button>
                        </form>
                      </td>
                    </tr>";
              $i++;
            }
            echo "</tbody></table>";
          }
          function searchTrain($carLo){
            $conn = connectToDB();
            $sql = "SELECT train_ID, departure, destination, running_days,
                    hours_traveling
                    FROM Train
                    WHERE departure='$carLo' AND length<100
                    ORDER BY train_ID";
            $stmt = $conn->stmt_init();
            if(!$stmt->prepare($sql)){
              echo "Failed in train print prepare";
              exit();
            }
            $stmt->execute();
            $trains = $stmt->get_result();
            $stmt->close();
            $conn->close();
            return $trains;
          }
        ?>
      </div>
    </div>
  </body>
</html>
