<?php
  include("../functions.php");
  include("../database.php");
  include 'distanceFunctions.php';
  $conn = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
  checkLink($conn);
  getCoord($conn);
  $conn->close();
  function getCoord($conn){
    $sql = "SELECT departure, destination
            FROM Train
            WHERE hours_traveling=0";
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
      echo $depart." | ".$destin." | ".$hours."<br />";
      echo "  ".$depart." (".$startX.", ".$startY.")<br />";
      echo "  ".$destin." (".$endX.", ".$endY.")<br /><br />";
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
