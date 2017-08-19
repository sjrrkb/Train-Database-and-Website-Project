<?php
  include("../functions.php");
  include("../database.php");

  $alpha = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m",
                 "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");

  $vowel = array("a", "e", "i", "o", "u", "y");

  $cons = array("b", "c", "d", "f", "g", "h", "j", "k", "l", "m", "n", "p", "q",
                "r", "s", "t", "v", "w", "x", "z");

  $rank = array("senior", "junior");

  $conn = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
  checkLink($conn);

  $z = 0;
  for($i = 0; $i < 50; $i++){
    $len = mt_rand(5, 7);
    $fName = "";
    for($j = 0; $j < $len; $j++){
      if($j % 2 == 0){
        $fName .= $cons[mt_rand(0, 19)];
      }else{
        $fName .= $vowel[mt_rand(0, 5)];
      }
    }
    $len = mt_rand(5, 7);
    $lName = "";
    for($j = 0; $j < $len; $j++){
      if($j % 2 == 0){
        $lName .= $cons[mt_rand(0, 19)];
      }else{
        $lName .= $vowel[mt_rand(0, 5)];
      }
    }
    $f = $fName[0];
    $l = $lName[0];
    $id = $f.$alpha[mt_rand(0, 25)].$alpha[mt_rand(0, 25)].$alpha[mt_rand(0, 25)].$alpha[mt_rand(0, 25)].$l;
    $fName = ucfirst($fName);
    $lName = ucfirst($lName);
    if($z == 2){
      $i = 51;
    }
    if($i != 51){
      popUser($id, $fName, $lName, $conn);
      // popEmployee($id, $conn);
      // popOnSite($id, $conn);
      if($z == 1){
        popAuth($id, "abc", "Conductor", $conn);
        popCond($id, $conn);
        // echo $i." COND | FIRST: ".$fName."<br />LAST: ".$lName."<br />ID: ".$id."<br /><br />";
      }else{
        popAuth($id, "abc", "Engineer", $conn);
        popEngin($id, $conn, $rank[mt_rand(0, 1)]);
        // echo $i." ENG | FIRST: ".$fName."<br />LAST: ".$lName."<br />ID: ".$id."<br /><br />";
      }
    }
    if($i == 49){
      $i = -1;
      $z += 1;
    }
  }

  $conn->close();
  header('Location: fixTrain.php');

  function popUser($id, $fName, $lName, $conn){
    $sql = "INSERT INTO User(user_id, first_name, last_name)
            VALUES('$id', '$fName', '$lName')";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
      exit();
    }
    $stmt->execute();
    $stmt->close();
    popEmployee($id, $conn);
  }

  function popAuth($id, $pass, $role, $conn){
    $phash = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO Authentication(user_id, password_hash, role)
            VALUES('$id', '$phash', '$role')";

    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
      exit();
    }
    $stmt->execute();
    $stmt->close();
    popEmployee($id, $conn);
  }

  function popEmployee($id, $conn){
    $sql = "INSERT INTO Employee(user_id)
            VALUES('$id')";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
      exit();
    }
    $stmt->execute();
    $stmt->close();
    popOnSite($id, $conn);
  }

  function popOnSite($id, $conn){
    $sql = "INSERT INTO On_Site_Personnel(user_id, status)
            VALUES('$id', 'inactive')";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
      exit();
    }
    $stmt->execute();
    $stmt->close();
  }

  function popEngin($id, $conn, $rank){
    $sql = "INSERT INTO Engineer(user_id, total_hours_traveling, rank)
            VALUES('$id', 0, '$rank')";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
      exit();
    }
    $stmt->execute();
    $stmt->close();
  }

  function popCond($id, $conn){
    $sql = "INSERT INTO Conductor(user_id)
            VALUES('$id')";
    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
      exit();
    }
    $stmt->execute();
    $stmt->close();
  }

?>
