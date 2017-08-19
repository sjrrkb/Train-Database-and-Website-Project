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

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        
        <script>
        $(function() 
        {
            $("[name=radios]").click(function(){
                    $('.toHide').hide();
                    $("#blk-"+$(this).val()).show('slow');
            });
        });
        function choose() 
        {
            if (document.getElementById('userType').value == '1') 
            {
                document.getElementById('employeeType').style.display = 'inline';
            } 
            else 
            {
                document.getElementById('employeeType').style.display = 'none';
                document.getElementById('status').style.display = 'none';
                document.getElementById('rank').style.display = 'none';
            }
        }
        function choose1() 
        {
            if (document.getElementById('employeeType').value == '1') 
            {
                document.getElementById('status').style.display = 'inline';
                document.getElementById('rank').style.display = 'inline';
            }
            if (document.getElementById('employeeType').value == '2') 
            {
                document.getElementById('status').style.display = 'inline';
                document.getElementById('rank').style.display = 'inline';
            }
            
        }
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
      <a class="navbar-brand" href="#">Missouri Rail</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="http://cs3380.rnet.missouri.edu/~GROUP8/adminProfile.php">Home</a></li>
      <li class="active"><a href="#">Add Employee or Equipment</a></li>
      <li><a href="http://cs3380.rnet.missouri.edu/~GROUP8/adminLogs.php"><?php echo $_SESSION['uname']?>'s Logs </a></li>
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
<br>

<hr>
	<div class="btn-group" data-toggle="buttons">
		<label class="btn btn-info">
			<input onclick="radioclick()" type="radio" name="radios" value="1" id="rdb1" autocomplete="off"> Create Employee
		</label>
		<label class="btn btn-info">
			<input onclick="radioclick()" type="radio" name="radios" value="2" id="rdb1" autocomplete="off"> Create Customer
		</label>
		<label class="btn btn-info">
			<input onclick="radioclick()" type="radio" name="radios" value="3" id="rdb2" autocomplete="off"> Add New Train
		</label>
		<label class="btn btn-info">
			<input onclick="radioclick()" type="radio" name="radios" value="4" id="rdb3" autocomplete="off"> Add Existing Car 
		</label>
		<label class="btn btn-info">
			<input onclick="radioclick()" type="radio" name="radios" value="5" id="rdb4" autocomplete="off"> Add New Car Type
		</label>

<script>
	$(".btn-group > .btn").click(function(){
    $(this).addClass("active").siblings().removeClass("active");
});
</script>
		<br>
	</div>
<hr>
<div id="blk-1" class="toHide container" style="display:none"> 
<form action="" method=POST>
  User Name:<br>
  <input class="inpt" type=text name="user_id" required="required"> <br>
  First Name:<br>
  <input class="inpt"type="text" name="firstName" required="required"><br>
  Last Name:<br>
  <input class="inpt" type="text" name="lastName" required="required"><br>
  Password:<br>
  <input class="inpt" type="text" name="password" required="required"><br>
  Employee Type:<br>
  <select class="drpdwn" name="employeeType" id="employeeType" required="required" onclick='choose1()'>
        <option value="1">Conductor</option>
        <option value="2">Engineer</option>  
    </select>
    <select class="drpdwn" name="rank" id="rank" required="required" style="display: none">
        <option value="1">Junior</option>
        <option value="2">Senior</option>  
    </select>
    <select class="drpdwn" name="status" id="status" required="required" style="display: none">
        <option value="1">Active</option>
        <option value="2">Inactive</option>  
    </select>
    <br>
  <input type="submit" name="submitUser" class="btn btn-primary">
     </form>
    </div>
<?php
include "database.php";
include "functions.php";
if(isset($_POST['submitUser']))
{
    switch($_POST['employeeType'])
        {
            case 1:
                $employeeType="Conductor";
            break;

            case 2:
                $employeeType="Engineer";
            break;
        }
    $actionTaken="Inserted".$_POST['user_id']." to user table";
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    checkLink($mysqli);
    $query = "SELECT user_id FROM User WHERE user_id=?";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        echo "user query failed";
        exit();
    }
    $stmt->bind_param("s", $_POST['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows;
    if($exists == 0)
    {
        $query = "INSERT INTO User (user_id, first_name, last_name) VALUES(?,?,?);";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query))
        {
            echo "user insert failed";
            exit();
        }
        $stmt->bind_param("sss", $_POST['user_id'], $_POST['firstName'], $_POST['lastName']);
        $stmt->execute();
        echo "<hr>Congratulations you have created an Employee profile with user_id ".$_POST['user_id']." ,firstname ".$_POST['firstName']." and lastname ".$_POST['lastName'];    
        updateUserLogTable($_SESSION['uname'], $query);
        
    
        $query = "INSERT INTO `Authentication` (user_id, password_hash, role) VALUES(?,?,?);";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query))
        {
            echo "authentication insert failed";
            exit();
        }
        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $_POST['user_id'], $hash, $employeeType);
        $stmt->execute();
        updateUserLogTable($_SESSION['uname'], $query);
        
        $query = "INSERT INTO `Employee` (user_id) VALUES(?)";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query))
        {
            echo "employee insert failed";
            exit();
        }
        $stmt->bind_param("s", $_POST['user_id']);
        $stmt->execute(); 
        updateUserLogTable($_SESSION['uname'], $query);
    
        $query2 = "INSERT INTO `On_Site_Personnel` (user_id, status) VALUES(?,?);";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query2))
        {
            echo "<br>on_site_personnel insert failed";
            exit();
        }
        $stmt->bind_param("ss", $_POST['user_id'], $_POST['status']);
        $stmt->execute();
        updateUserLogTable($_SESSION['uname'], $query2);
        

        switch($_POST['employeeType'])
        {
            case 1:
                $employeeType="Conductor";
            break;

            case 2:
                $employeeType="Engineer";
            break;
        }
        switch($_POST['rank'])
        {
            case 1:
                $rank="Junior";
            break;

            case 2:
                $rank="Senior";
            break;    
        }
        if($employeeType == "Engineer")
        {   
            
            $null="5";
            $query= "INSERT INTO `Engineer` (user_id, total_hours_traveling,rank) VALUES(?,?,?);";
            $stmt = $mysqli->stmt_init();
            if(!$stmt->prepare($query))
            {
                echo "engineer insert failed";
                echo "<br>";
                echo $query;
                exit();
            }
            $stmt->bind_param("sis", $_POST['user_id'], $null , $rank);
            $stmt->execute(); 
            updateUserLogTable($_SESSION['uname'], $query);
        }
        if($employeeType == "Conductor")
        {
            $query= "INSERT INTO `Conductor` (user_id, rank) VALUES(?,?);";
            $stmt = $mysqli->stmt_init();
            if(!$stmt->prepare($query))
            {
                echo "conductor insert failed";
                exit();
            }
            $stmt->bind_param("ss", $_POST['user_id'], $rank);
            $stmt->execute(); 
            updateUserLogTable($_SESSION['uname'], $query);
        }
        
        //joint eng/cond table

        $query3 = "INSERT INTO `join_Con_Eng_Admin` 
        (user_id, first_name, last_name, password_hash, role, status, rank, total_hours_traveling)
        VALUES 
        (?, 
            (SELECT first_name from `User` WHERE user_id=?),
            (SELECT last_name from `User` WHERE user_id=?),
            (SELECT password_hash from `Authentication` WHERE user_id=?),
            (SELECT role from `Authentication` WHERE user_id=?),
            (SELECT status from `On_Site_Personnel` WHERE user_id=?),
            (SELECT rank from `Engineer` WHERE user_id=?),
            (SELECT total_hours_traveling from `Engineer` WHERE user_id=?)
        );";
        
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query3))
        {
            echo "joint eng/cond table insert failed";
            exit();
        }
        $stmt->bind_param("ssssssss", $_POST['user_id'], $_POST['user_id'], $_POST['user_id'], $_POST['user_id'], $_POST['user_id'], $_POST['user_id'], $_POST['user_id'], $_POST['user_id']);
        $stmt->execute();
        updateUserLogTable($_SESSION['uname'], $query3);
        
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query2))
        {
            echo "<br>on_site_personnel insert failed";
            exit();
        }
        $stmt->bind_param("ss", $_POST['user_id'], $_POST['status']);
        $stmt->execute();
        updateUserLogTable($_SESSION['uname'], $query2);
    }
    else
    {
        echo"<hr>User_id ".$_POST['user_id']." is taken please choose a unique user_id.";
    }
    $stmt->close();
    $mysqli->close();
}
?>    

<!-- Customer-->    
<div id="blk-2" class="toHide container" style="display:none"> 
<form action="" method=POST>
  User Name:<br>
  <input class="inpt" ype=text name="user_id" required="required"> <br>
  First Name:<br>
  <input class="inpt" type="text" name="firstName" required="required"><br>
  Last Name:<br>
  <input class="inpt" type="text" name="lastName" required="required"><br>
  Password:<br>
  <input class="inpt" type="text" name="password" required="required"><br>
  <input type="submit" name="submitCustomer" class="btn btn-primary">
     </form>
    </div>
<?php
if(isset($_POST['submitCustomer']))
{
    $customer="Customer";
    $number=rand(1,1000);
    $actionTaken="Inserted".$_POST['user_id']." to user table";
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    checkLink($mysqli);
    $query = "SELECT user_id FROM User WHERE user_id=?";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        echo "user query failed";
        exit();
    }
    $stmt->bind_param("s", $_POST['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows;
    if($exists == 0)
    {
        $query = "INSERT INTO User (user_id, first_name, last_name) VALUES(?,?,?);";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query))
        {
            echo "user insert failed";
            exit();
        }
        $stmt->bind_param("sss", $_POST['user_id'], $_POST['firstName'], $_POST['lastName']);
        $stmt->execute();
        echo "<hr>Congratulations you have created an Customer profile with user_id ".$_POST['user_id']." ,firstname ".$_POST['firstName']." and lastname ".$_POST['lastName'];    
        updateUserLogTable($_SESSION['uname'], $query);
        
    
        $query = "INSERT INTO `Authentication` (user_id, password_hash, role) VALUES(?,?,?);";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query))
        {
            echo "authentication insert failed";
            exit();
        }
        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $_POST['user_id'], $hash, $customer);
        $stmt->execute();
        echo "<br> auth table insert worked<br>";
        updateUserLogTable($_SESSION['uname'], $query);
        
        $query= "INSERT INTO `Customer` (user_id, company_id) VALUES(?,?);";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query))
        {
            echo "customer insert failed";
            exit();
        }
        $stmt->bind_param("si", $_POST['user_id'], $number);
        $stmt->execute(); 
        echo "<br> customer table insert worked<br>";
        updateUserLogTable($_SESSION['uname'], $query);
    }
    else
    {
        echo"<hr>User_id ".$_POST['user_id']." is taken please choose a unique user_id.";
    }
    $stmt->close();
    $mysqli->close();
}
?>        
    
<div id="blk-3" class="toHide container" style="display:none"> 
<form action="" method=POST>
  Train Number:<br>
  <input class="inpt" type=text name="train_ID" required="required"> <br>
  From:<br>
  <input class="inpt" type="text" name="departure" required="required"><br>
  To:<br>
  <input class="inpt" type="text" name="destination" required="required"><br>  
  Travel Time:<br>
  <input class="inpt" type="text" name="hoursTraveled" required="required"><br>  
  Running Days:<br>
  <select class="drpdwn" name="runningDays" required="required">
        <option value="1">MTWThF</option>
        <option value="2">MWF</option>
        <option value="3">MW</option>
        <option value="4">WF</option>
        <option value="5">TTh</option>
  </select>
        <br>
    <br>
  <input type="submit" name="submitTrain" class="btn btn-primary">
</form>
</div>
<?php
if(isset($_POST['submitTrain']))
{
    $length=0;
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    checkLink($mysqli);
    $query = "SELECT train_ID FROM Train WHERE train_ID=?;";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        echo "train query failed";
        exit();
    }
    $stmt->bind_param("s", $_POST['train_ID']);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows;
    if($exists == 0)
    {
        switch($_POST['runningDays'])
        {
            case 1:
                $runningDays="MTWThF";
            break;
                
            case 2:
                $runningDays="MWF";
            break;
                
            case 3:
                $runningDays="MW";
            break;
                
            case 4:
                $runningDays="WF";
            break;
                
            case 5:
                $runningDays="TTh";
            break;
        }
        $query = "INSERT INTO Train (train_ID, departure, destination, running_days, hours_traveling, length) VALUES(?,?,?,?,?,?);";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query))
        {
            echo"<br> insert train statment failed!";
            echo"<br> train id= ".$_POST['train_ID'];
            echo"<br> from= ".$_POST['departure'];
            echo "<br> to= ".$_POST['destination'];
            echo "<br> runningDays= ".$runningDays;
            echo"<br> hours traveled= ".$_POST['hoursTraveled'];
            echo"<br>";
            exit();
        }
        $stmt->bind_param("sssss", $_POST['train_ID'],$_POST['departure'], $_POST['destination'], $runningDays, $_POST['hoursTraveled'], $length);
        $stmt->execute();
        updateUserLogTable($_SESSION['uname'], $query);
        
        echo "<hr>Congratulations you have created a train with train_number ".$_POST['train_ID']." ,destination ".$_POST['destination']." and running days of ".$runningDays." and length of ".$length;
    }
    else
    {
        echo"<hr>Train_number ".$_POST['train_ID']." is taken please choose a unique train_ID.";
    }
    $stmt->close();
    $mysqli->close();
}
?>    

<div id="blk-4" class="toHide container" style="display:none"> 
<form action="" method=POST>
  Car Number:<br>
  <input class="inpt" type=text name="car_id" required="required"> <br>
  Car Type:<br>
  <select class="drpdwn" name="car_type" required="required">
        <option value="1">grain car </option>
        <option value="2">coal car </option>
        <option value="3">hopper</option>
        <option value="4">flatbed</option>
  </select>
    <br>
    <br>
  <input type="submit" name="submitCar" class="btn btn-primary">
</form>
</div>
<?php
if(isset($_POST['submitCar']))
{
    $isReserved="0";
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    checkLink($mysqli);
    $query = "SELECT car_id FROM Car WHERE car_id=?";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        echo"<br>";
        echo "car query failed";
        exit();
    }
    $stmt->bind_param("s", $_POST['car_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows;
    if($exists == 0)
    {
        switch($_POST['car_type'])
        {
            case 1:
                $carType="grain car";
            break;
                
            case 2:
                $carType="coal car";
            break;
                
            case 3:
                $carType="hopper";
            break;
                
            case 4:
                $carType="flatbed";
            break;
                
        }
        $query = "INSERT INTO Car (car_id, car_type, is_reserved) VALUES(?,?,?);";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query))
        {
            echo "<br> car insert failed<br>";
            exit();
        }
        $stmt->bind_param("ssi",$_POST['car_id'], $carType, $isReserved);
        $stmt->execute();
        updateUserLogTable($_SESSION['uname'], $query);
        
        
        echo "<hr>Congratulations you have created a car with car_id ".$_POST['car_id']." with car type of ".$carType;
    }
    else
    {
        echo"<hr>Car_number ".$_POST['car_number']." is taken please choose a unique car_number.";
    }
    $stmt->close();
    $mysqli->close();
}
?>
    

    
<div id="blk-5" class="toHide container" style="display:none"> 
<form action="" method=POST>
  Car Type:<br>
  <input class="inpt" type=text name="car_type" required="required"> <br>
  Car Price:<br>
  <input class="inpt" type=text name="car_price" required="required">
    <br>
  Car Capacity:<br>
  <input class="inpt" type=text name="capacity" required="required">
    <br>
    <br>
  <input type="submit" name="submitCarType" class="btn btn-primary">
</form>
</div>
<?php
if(isset($_POST['submitCarType']))
{
    
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    checkLink($mysqli);
    $query = "SELECT car_type FROM `Car_Type` WHERE car_type=?;";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        echo "car type query failed";
        exit();
    }
    $stmt->bind_param("s", $_POST['car_type']);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows;
    if($exists == 0)
    {
        $query = "INSERT INTO Car_Type (car_type, car_type_price, capacity) VALUES(?,?,?);";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query))
        {
            exit();
        }
        $stmt->bind_param("sss", $_POST['car_type'], $_POST['car_price'], $_POST['capacity']);
        $stmt->execute();
        updateUserLogTable($_SESSION['uname'], $query);
        
        echo "<hr>Congratulations you have created a car_type of ".$_POST['car_type']." with price of ".$_POST['car_price']." and capacity".$_POST['capacity'];
    }
    else
    {
        echo"<hr>Car_type ".$_POST['car_type']." is taken please choose a unique car_type.";
    }
    $stmt->close();
    $mysqli->close();
}
?>        
    
    </div>
</div>
</body>
</html>
