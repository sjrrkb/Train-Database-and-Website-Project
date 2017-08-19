<?php
  include("database.php");
  include("functions.php");
  session_start();
  
  if(isset($_SESSION['uname'])){
     // echo $_SESSION['uname'] . ", you have successfully been logged in. <br>";
    if( ($_SESSION['role'] == "Conductor") || ($_SESSION['role'] == "Engineer")){
          header("Location: http://cs3380.rnet.missouri.edu/~GROUP8/index.php");
        }
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
    <title>Search a Car</title>
    <meta charset="utf-8">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    
    <link rel="stylesheet" href="http://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>    <!-- jQuery library -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> <!-- Latest compiled JavaScript -->
    <script src="ddtf.js"></script>

    <link rel="stylesheet" type="text/css" href="CSS/navBar.css">

<script>
      $(function(){
        $("#searchTable").ddTableFilter();
      });

      $(document).ready( function() {
          $('#myCarousel').carousel({
              interval:   3000
          });
          
          var clickEvent = false;
          $('#myCarousel').on('click', '.nav a', function() {
                  clickEvent = true;
                  $('.nav li').removeClass('active');
                  $(this).parent().addClass('active');        
          }).on('slid.bs.carousel', function(e) {
              if(!clickEvent) {
                  var count = $('.nav').children().length -1;
                  var current = $('.nav li.active');
                  current.removeClass('active').next().addClass('active');
                  var id = parseInt(current.data('slide-to'));
                  if(count == id) {
                      $('.nav li').first().addClass('active');    
                  }
              }
              clickEvent = false;
          });
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
      /*Used for carousel before*/
      html,
      body {
          height: 100%;
          width: 100%;
      }
      .container{
          width: 80%;
      }
      th{text-align: center;}

      .panel > .panel-heading {
        background-image: none;
        background: rgb(9,63,109);
        color: white;
      }
      .table-striped>tbody>tr:nth-child(odd)>td,
      .table-striped>tbody>tr:nth-child(even)>th {
        background-color: rgba(91, 145, 191, 0.1);
      }

      #myCarousel .nav a small
      {
          display: block;
      }
      #myCarousel .nav
      {
          background: #eee;
      }
      .nav-justified > li > a
      {
          border-radius: 0px;
      }
      .carousel-control.left , .carousel-control.right
      {
        background-image: none !important;
      }
      .nav-pills>li[data-slide-to="0"].active a { background-color: #16a085; }
      .nav-pills>li[data-slide-to="1"].active a { background-color: #e67e22; }
      .nav-pills>li[data-slide-to="2"].active a { background-color: #2980b9; }
      .nav-pills>li[data-slide-to="3"].active a { background-color: #8e44ad; }
      .nav-pills>li[data-slide-to="4"].active a { background-color: #e29681; }

      .fill {
      width: 100%;
      height: 100%;
      background-position: center;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      background-size: cover;
      -o-background-size: cover;
      }

      /*Carousel*/
      .carousel,
      .item,
      .active {
          height: 100%;
      }
      #myCarousel{
          /*margin-bottom: 2em;*/
          width: 80%;
          height: 60%;
          margin: 40px auto;
          margin-bottom: 60px;
          margin-top: 0px;
      }
      .carousel-inner {
          height: 100%;
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
          <li class="active"><a href="">Search a Car</a></li>
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


<!-- <div class="container">
  <div class="row">
   <h2 style="text-align:left;">Reserve a Car</h2>
      <hr>
  </div>
</div> -->


    <header id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner"> <!-- Wrapper for slides -->
            <div class="item active">
                <div class="fill" style="background-image:url('http://seaboardcoast.com/yahoo_site_admin/assets/images/BNSF_712982_50_XP_Plug-Door_Box_Car_NS_Norris_Yard_05-29-11.156120913_std.jpg');"></div>
                <div class="carousel-caption"><h3>Box Car</h3></div>
            </div><!-- End Item -->
            <div class="item">
               <div class="fill" style="background-image:url('http://s3.amazonaws.com/ClubExpressClubFiles/541047/graphics/caboose.jpg');"></div>
                <div class="carousel-caption"><h3>Caboose</h3></div>
            </div><!-- End Item -->
            <div class="item">
                <div class="fill" style="background-image:url('http://www.atlaso.com/images/55tonhopper/0414/3006802-1_TQ.jpg');"></div>
                <div class="carousel-caption"><h3>Coal Car</h3> </div>
            </div><!-- End Item -->
            <div class="item">
                <div class="fill" style="background-image:url('http://thundertrain.org/022512Rail-d-ts7009flat-59R.jpg');"></div>
                <div class="carousel-caption"><h3>Flat Bed</h3></div>
            </div><!-- End Item -->
            <div class="item">
                <div class="fill" style="background-image:url('http://2.bp.blogspot.com/-A3kHC73ozP4/UgUnG5959rI/AAAAAAAGVas/9dNap9LimNI/s1600/BN+468585+Covered+Hopper+Rib+Side+Railway+Lewis+Grain+Co.+Rail+Car+Burlington+Northern+Railroad+on+CSX+Cordele+Georgia+Freight+Train.JPG');"></div>
                <div class="carousel-caption"><h3>Grain Hopper</h3></div>
            </div><!-- End Item -->
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div><!-- End Carousel Inner -->
        <ul class="nav nav-pills nav-justified">
            <li data-target="#myCarousel" data-slide-to="0" class="active"><a href="#">Box Car</a></li>
            <li data-target="#myCarousel" data-slide-to="1"><a href="#">Caboose<small></small></a></li>
            <li data-target="#myCarousel" data-slide-to="2"><a href="#">Coal Car<small></small></a></li>
            <li data-target="#myCarousel" data-slide-to="3"><a href="#">Flat Bed<small></small></a></li>
            <li data-target="#myCarousel" data-slide-to="4"><a href="#">Grain Hopper<small></small></a></li>
        </ul>
    </header> <!-- ####################################### End Carousel ####################################### -->



    <div class="container">
      <div class="row">
   
        <div class="panel panel-success"> <!-- filterable -->
          
          <div class="panel-heading">
            <div class="row">
              <div class="col-sm-11">
                <h class="panel-title"> <font size="5">Search for a Car</font> </h>
              </div>
              <!-- <div class="col-sm-1">
                <button class="btn btn-info btn-sm btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
              </div> -->
            </div>
          </div>

          <?php ################################################################
          
        		$mysqli = connectToDB();
        		$sql = "SELECT Car.car_id, Car.car_type,
                    Cars_Location.depot_location,
                    Car_Type.capacity, Car_Type.car_type_price
                    FROM Car
                    NATURAL JOIN Car_Type
                    NATURAL JOIN Cars_Location
                    WHERE is_reserved=0
                    ORDER BY car_id ASC";

        		$stmt = $mysqli->stmt_init();
        		if(!$stmt->prepare($sql)){
        			echo "Error in preparing statement line 201";
        			exit();
        		}
        		$stmt->execute();							//execute query
        		$result = $stmt->get_result();				//get results
            $stmt->close();
            $mysqli->close();
      ####################################################################?>
          <div class="panel-body">

            <div class='well' style='background:white;'>
              <table class="table table-striped" id="searchTable">
                  <th class="skip-filter">CarID</th>
                  <th>Cargo Type</th>
                  <th>Departure</th>
                  <th class="skip-filter">Capacity</th>
                  <th>$Price</th>
                  <th ><font size='4'><em class="glyphicon glyphicon-check" id></font></em>Reserve</th>
                <tbody>
                  <?php
                  // <a class='btn btn-success btn-sm'>
                  //   <span class='glyphicon glyphicon-check'></span> Reserve
                  // </a>
                    $i=1;
                    while($row = $result->fetch_array(MYSQLI_NUM)) {
                      echo "<tr>
                              <td class='text-center'>$row[0]</td>
                              <td class='text-center'>$row[1]</td>
                              <td class='text-center'>$row[2]</td>
                              <td class='text-center'>$row[3]</td>
                              <td class='text-center'>$$row[4]</td>
                              <td class='text-center'>
                                <form action='reserveConfirm.php' method='POST' id='ReserveConfirm$i'>
                                  <input type='hidden' name='carID' value='$row[0]'>
                                  <input type='hidden' name='carType' value='$row[1]'>
                                  <input type='hidden' name='carLoc' value='$row[2]'>
                                  <input type='hidden' name='carPrice' value='$row[4]'>
                                  <button class='btn btn-success btn-sm' type='submit' form='ReserveConfirm$i' name='Reserve'>
                                    <span class='glyphicon glyphicon-check'></span> Reserve
                                  </button>
                                </form>
                              </td>
                            </tr>";
                      $i++; // post-increment for the next loop
                    } #######--end of the while loop table--########
                  ?>
                </tbody>
              </table>
            </div> <!-- well -->
          </div> <!-- panel-body -->
        </div> 
      </div>
    </div>
 </div>

</body>
</html>
