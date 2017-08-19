<!DOCTYPE html>
<html>
  <head>
    <title>functions</title>
    <meta charset="utf-8" />
    <style>
      table{
        margin-top: 5px;
        border: 3px solid black;
        font-family: Verdana;
        border-collapse: collapse;
      }
      td, th{
        border-right: 3px solid black;
        text-align: center;
        padding: 10px;
      }
      th{
        background-color: slategray;
        border-bottom: 3px solid black;
      }
      tr:nth-child(odd){
        background-color: lightgray;
      }
    </style>
  </head>
</html>

<?php
  function checkInput($x){
    $x = empty($x) ? NULL : $x;
    $x = htmlspecialchars($x);
    return $x;
  }

  function printCars($output, $train){
    echo "<table><tr>";
    while($info = mysqli_fetch_field($output)){
      echo "<th>".$info->name."</th>";
    }
    echo "<th>Select</th>";
    echo "</tr>";
    $data = $train->fetch_array(MYSQLI_NUM);
    while($row = $output->fetch_array(MYSQLI_NUM)){
      echo "<tr>";
      echo "<td>".$row[0]."</td>";
      echo "<td>".$row[1]."</td>";
      echo "<td>".$row[2]."</td>";
      echo "<td>$".$row[3]."</td>";
      echo "<td>
              <form action='buildDraft.php' method='POST'>
                <input type='hidden' name='carID' value='".$row[0]."' />
                <input type='hidden' name='carType' value='".$row[1]."' />
                <input type='hidden' name='carDep' value='".$row[2]."' />
                <input type='hidden' name='carPrice' value='".$row[3]."' />
                <input type='hidden' name='trainID' value='".$data[0]."' />
                <input type='hidden' name='trainDep' value='".$data[1]."' />
                <input type='hidden' name='trainDes' value='".$data[2]."' />
                <input type='hidden' name='trainDays' value='".$data[3]."' />
                <input type='submit' name='subCar' value='Select' />
              </form>
            </td>";
      echo "</tr>";
    }
    echo "</table>";
  }

  function printData($output){
    echo "<table><tr>";
    while($info = mysqli_fetch_field($output)){
      echo "<th>".$info->name."</th>";
    }
    echo "</tr>";
    while($row = $output->fetch_array(MYSQLI_NUM)){
      echo "<tr>";
      foreach($row as $data){
        echo "<td>".$data."</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
  }

  function getCars($dep, $des, $typ, $conn){
    $sql = "SELECT Car.car_id AS CarID,
            Car.car_type AS CargoType,
            Cars_Location.depot_location AS 'From',
            Car_Type.car_type_price AS Price
            FROM Car, Cars_Location, Car_Type
            WHERE Car.car_id=Cars_Location.car_id
            AND Cars_Location.depot_location='$dep'
            AND Car.car_type='$typ'
            AND Car_Type.car_type='$typ'
            AND Car.is_reserved=0";

    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
      exit();
    }
    // $stmt->bind_param("ss", $depart, $type);
    $stmt->execute();
    $result = mysqli_stmt_get_result($stmt);
    $stmt->close();
    return $result;
  }

  function getTrain($dep, $des, $conn){
    $sql = "SELECT train_ID AS TrainID,
            departure AS 'From',
            destination AS 'To',
            running_days AS Days
            FROM Train
            WHERE departure='$dep'
            AND destination='$des'";

    $stmt = $conn->stmt_init();
    if(!$stmt->prepare($sql)){
      echo "getTrain";
      exit();
    }
    $stmt->execute();
    $result = mysqli_stmt_get_result($stmt);
    $stmt->close();
    return $result;
  }

  function printCar($carID, $cargo, $dep, $price){
    echo "<table>
            <tr>
              <th>CarID</th><th>CargoType</th><th>From</th><th>Price</th>
            </tr>
            <tr>
              <td>".$carID."</td><td>".$cargo."</td><td>".$dep."</td><td>".$price."</td>
            </tr>
          </table>";
  }

  function printTrain($trainID, $trainDep, $trainDes, $trainDays){
    echo "<table>
            <tr>
              <th>TrainID</th><th>From</th><th>To</th><th>Days</th>
            </tr>
            <tr>
              <td>".$trainID."</td><td>".$trainDep."</td><td>".$trainDes."</td><td>".$trainDays."</td>
            </tr>
          </table>";
  }
?>
