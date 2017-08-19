<?php
  include("../functions.php");
  include("../database.php");
  include 'distanceFunctions.php';

  $cities = array("Seattle", "Portland", "San Francisco", "San Jose", "Las Vegas",
                  "Denver", "Los Angeles", "San Diego", "Phoenix", "El Paso",
                  "Oklahoma City", "Fort Worth", "Dallas", "Austin", "San Antonio",
                  "Memphis", "Nashville", "Houston", "Charlotte", "Jacksonville",
                  "Milwaukee", "Chicago", "Columbus", "Boston", "New York City",
                  "Philadelphia", "Washington DC", "Baltimore", "Detroit",
                  "Indianapolis");

  $type = array("Coal Car", "Grain Hopper", "Flat Bed", "Box Car", "Caboose");

  $days = array("M", "T", "W", "Th", "F", "MW", "MWF", "TTh", "MF", "TF", "WF");

  $conn = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
  checkLink($conn);

  //POPULATES Trains Table and Locomotive Table
  $j = 0;
  $id = 101;
  for($i = 0; $i < 30; $i++){
    if($i == 29){
      //popTrain($id, $cities[$j], $cities[$i], $days[mt_rand(0, 10)], $conn);
      create_train($cities[$j], $cities[$i]);
      $i = 0;
      ++$j;
      if($j == $i){
        ++$j;
      }
    }else{
      //popTrain($id, $cities[$j], $cities[$i], $days[mt_rand(0, 10)], $conn);
      create_train($cities[$j], $cities[$i]);
    }
    if($j > 29){
      $i = 31;
    }
    popLocomotive($id, $conn);
    ++$id;
  }

  //Deletes Seattle to Seattle Train
  deleteFirst($conn);
  //Sets first train_ID to 101
  updateFirst($conn);
  //Subtracts 1 from every train_ID afer 101
  updateTrains($conn);
  //Sets every Train's destination with same
  //departure and destination to Seattle
  deleteDuplicate($conn);
  getCoord($conn);

  //POPULATES Car_Type Table
  popType($type[0], 500.00, 2, $conn);
  popType($type[1], 400.00, 3, $conn);
  popType($type[2], 300.00, 4, $conn);
  popType($type[3], 200.00, 5, $conn);
  popType($type[4], 100.00, 6, $conn);

  //POPULATES Depot Table
  for($i = 0; $i < 30; $i++){
    popDepot($cities[$i], $conn);
  }

  //POPULATES Cars_Location and Car Table
  $id = 101;
  $index = 0;
  for($i = 0; $i < 15; $i++){
    if($i < 3){
      popCar($id, $type[0], 0, $conn);
      popLocation($id, $cities[$index], $conn);
    }
    else if($i > 2 && $i < 6){
      popCar($id, $type[1], 0, $conn);
      popLocation($id, $cities[$index], $conn);
    }
    else if($i > 5 && $i < 9){
      popCar($id, $type[2], 0, $conn);
      popLocation($id, $cities[$index], $conn);
    }
    else if($i > 8 && $i < 12){
      popCar($id, $type[3], 0, $conn);
      popLocation($id, $cities[$index], $conn);
    }
    else if($i > 11 && $i < 15){
      popCar($id, $type[4], 0, $conn);
      popLocation($id, $cities[$index], $conn);
    }
    ++$id;
    if($i == 14){
      $i = -1;
      ++$index;
    }
    if($index == 30){
      $i = 16;
    }
  }

  $conn->close();

  header('Location: populateEmployees.php');

  function popLocomotive($id, $conn){
    $sql = "INSERT INTO Locomotive(locomotive_ID)VALUES(?)";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
      exit();
    }
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->close();
  }

  function popTrain($id, $depart, $destin, $days, $conn){
    $sql = "INSERT INTO Train(train_ID, departure, destination, running_days, hours_traveling, length)VALUES(?, ?, ?, ?, ?, ?)";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
      exit();
    }
    $hours = 0;
    $length = 0;
    $stmt->bind_param("ssssii", $id, $depart, $destin, $days, $hours, $length);
    $stmt->execute();
    $stmt->close();
  }

  function popType($type, $price, $cap, $conn){
    $sql = "INSERT INTO Car_Type(car_type, car_type_price, capacity)VALUES(?, ?, ?)";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
      exit();
    }
    $stmt->bind_param("sii", $type, $price, $cap);
    $stmt->execute();
    $stmt->close();
  }

  function popDepot($city, $conn){
    $x = getX($city);
    $y = getY($city);
    $sql = "INSERT INTO Depot(depot_location, x, y)VALUES(?, ?, ?)";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
      exit();
    }
    $stmt->bind_param("sdd", $city, $x, $y);
    $stmt->execute();
    $stmt->close();
  }

  function popCar($id, $type, $num, $conn){
    $sql = "INSERT INTO Car(car_id, car_type, is_reserved)VALUES(?, ?, ?)";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
      exit();
    }
    $stmt->bind_param("ssi", $id, $type, $num);
    $stmt->execute();
    $stmt->close();
  }

  function popLocation($id, $local, $conn){
    $sql = "INSERT INTO Cars_Location(car_id, depot_location)VALUES(?, ?)";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
      exit();
    }
    $stmt->bind_param("ss", $id, $local);
    $stmt->execute();
    $stmt->close();
  }

  function deleteFirst($conn){
    $sql = "DELETE FROM Train WHERE train_ID=101";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
      exit();
    }
    $stmt->execute();
    $stmt->close();
  }

  function updateFirst($conn){
    $sql = "UPDATE Train SET train_ID=101 WHERE train_ID=102";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
      exit();
    }
    $stmt->execute();
    $stmt->close();
  }

  function updateTrains($conn){
    $sql = "UPDATE Train SET train_ID=(train_ID-1) WHERE train_ID>101";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
      exit();
    }
    $stmt->execute();
    $stmt->close();
  }

  function deleteDuplicate($conn){
    $sql = "UPDATE Train SET destination='Seattle' WHERE departure=destination";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
      exit();
    }
    $stmt->execute();
    $stmt->close();
  }

  function getCoord($conn){
    $sql = "SELECT departure, destination
            FROM Train";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
      exit();
    }
    $stmt->execute();
    $loc = $stmt->get_result();
    $stmt->close();
    while($row = $loc->fetch_array(MYSQLI_NUM)){
      $depart = $row[0];
      $destin = $row[1];
      $startX = getX($depart);
      $startY = getY($depart);
      $endX = getX($destin);
      $endY = getY($destin);
      $deltaX = getDelta($startX, $endX);
      $deltaY = getDelta($startY, $endY);
      $miles = getMiles($deltaX, $deltaY);
      $hours = $miles/40;
      insertHours($depart, $destin, $hours, $conn);
    }
  }

  function insertHours($depart, $destin, $hours, $conn){
    if($hours < 1){
      $hours = 1;
    }
    $sql = "UPDATE Train
            SET hours_traveling='$hours'
            WHERE departure='$depart'
            AND destination='$destin'";

    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
      echo "insertHours";
      exit();
    }
    $stmt->execute();
    $stmt->close();
  }
?>
