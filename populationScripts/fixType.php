<?php
  include("../functions.php");
  include("../database.php");
  $conn = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
  checkLink($conn);

  popType("Box Car", 2, $conn);
  popType("Caboose", 3, $conn);
  popType("Coal Car", 4, $conn);
  popType("Flat Bed", 5, $conn);
  popType("Grain Hopper", 6, $conn);

  $conn->close();

  function popType($type, $cap, $conn){
    $sql = "UPDATE Car_Type SET capacity='$cap'
            WHERE car_type='$type'";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
      exit();
    }
    $stmt->execute();
    $stmt->close();
  }
?>
