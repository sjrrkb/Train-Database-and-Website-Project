<!DOCTYPE html>
<html>
  <head>
    <title>Build Train</title>
    <meta charset="utf-8" />
  </head>
  <body>
    <form action="buildDraft.php" method="POST">
      <label for="depart">Departure:</label><br />
      <select name="departure" id="depart">
        <option>Seattle</option>
        <option>Portland</option>
        <option>San Francisco</option>
        <option>San Jose</option>
        <option>Las Vegas</option>
        <option>Denver</option>
        <option>Los Angeles</option>
        <option>San Diego</option>
        <option>Phoenix</option>
        <option>El Paso</option>
        <option>Oklahoma City</option>
        <option>Fort Worth</option>
        <option>Dallas</option>
        <option>Austin</option>
        <option>San Antonio</option>
        <option>Memphis</option>
        <option>Nashville</option>
        <option>Houston</option>
        <option>Charlotte</option>
        <option>Jacksonville</option>
        <option>Milwaukee</option>
        <option>Chicago</option>
        <option>Columbus</option>
        <option>Boston</option>
        <option>New York City</option>
        <option>Philadelphia</option>
        <option>Washington DC</option>
        <option>Baltimore</option>
        <option>Detroit</option>
        <option>Indianapolis</option>
      </select>
      <br /><label for="destin">Destination:</label><br />
      <select name="destination" id="destin">
        <option>Seattle</option>
        <option>Portland</option>
        <option>San Francisco</option>
        <option>San Jose</option>
        <option>Las Vegas</option>
        <option>Denver</option>
        <option>Los Angeles</option>
        <option>San Diego</option>
        <option>Phoenix</option>
        <option>El Paso</option>
        <option>Oklahoma City</option>
        <option>Fort Worth</option>
        <option>Dallas</option>
        <option>Austin</option>
        <option>San Antonio</option>
        <option>Memphis</option>
        <option>Nashville</option>
        <option>Houston</option>
        <option>Charlotte</option>
        <option>Jacksonville</option>
        <option>Milwaukee</option>
        <option>Chicago</option>
        <option>Columbus</option>
        <option>Boston</option>
        <option>New York City</option>
        <option>Philadelphia</option>
        <option>Washington DC</option>
        <option>Baltimore</option>
        <option>Detroit</option>
        <option>Indianapolis</option>
      </select>
      <br /><label for="cargo">Cargo Type:</label><br />
      <select name="cargo" id="cargo">
        <option>Grain Hopper</option>
        <option>Coal Car</option>
        <option>Flat Bed</option>
        <option>Standard</option>
      </select>
      <input type="submit" name="submit" value="Get Price" />
    </form>
    <?php
      include 'searchFunc.php';
      include("../functions.php");
      include("../database.php");
      if(isset($_POST['submit'])){
        $dep = checkInput($_POST['departure']);
        $des = checkInput($_POST['destination']);
        $typ = checkInput($_POST['cargo']);

        $conn = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
        checkLink($conn);

        $avCars = getCars($dep, $des, $typ, $conn);
        $avTrain = getTrain($dep, $des, $conn);
        printCars($avCars, $avTrain);

        $conn->close();
      }
      if(isset($_POST['subCar'])){
        $carID = checkInput($_POST['carID']);
        $carType = checkInput($_POST['carType']);
        $carDep = checkInput($_POST['carDep']);
        $carPrice = checkInput($_POST['carPrice']);

        $trainID = checkInput($_POST['trainID']);
        $trainDep = checkInput($_POST['trainDep']);
        $trainDes = checkInput($_POST['trainDes']);
        $trainDays = checkInput($_POST['trainDays']);

        $conn = connectToDB();

        printCar($carID, $carType, $carDep, $carPrice);
        printTrain($trainID, $trainDep, $trainDes, $trainDays);

        //this is where the information will be sent to begin
        //building the train
        echo "<form action method='POST'>
                <input type='hidden' name='carID' value='$carID' />
                <input type='hidden' name='trainID' value='$trainID' />
                <input type='submit' name='confirmCar' value='Reserve' />
              </form";

        $conn->close();
      }
    ?>
  </body>
</html>
