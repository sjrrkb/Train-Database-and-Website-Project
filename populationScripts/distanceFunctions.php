<?php
function getX($city){
  switch($city){
    case "Seattle":
      return -26;
    case "Portland":
      return -26;
    case "San Francisco":
      return -26;
    case "San Jose":
      return -25;
    case "Las Vegas":
      return -18.5;
    case "Denver":
      return -10;
    case "Los Angeles":
      return -24;
    case "San Diego":
      return -22;
    case "Phoenix":
      return -13;
    case "El Paso":
      return -10;
    case "Oklahoma City":
      return -4;
    case "Fort Worth":
      return -2;
    case "Dallas":
      return -1.75;
    case "Austin":
      return -2.5;
    case "San Antonio":
      return -2;
    case "Memphis":
      return 1;
    case "Nashville":
      return 3.75;
    case "Houston":
      return 1;
    case "Charlotte":
      return 11.5;
    case "Jacksonville":
      return 12.5;
    case "Milwaukee":
      return 0.5;
    case "Chicago":
      return 0;
    case "Columbus":
      return 6;
    case "Boston":
      return 17;
    case "New York City":
      return 15.5;
    case "Philadelphia":
      return 14;
    case "Washington DC":
      return 12.5;
    case "Baltimore":
      return 14.25;
    case "Detroit":
      return 5.5;
    case "Indianapolis":
      return 2;
    default:
      exit();
  }
}

function getY($city){
  switch($city){
    case "Seattle":
      return 15.5;
    case "Portland":
      return 12;
    case "San Francisco":
      return 1.5;
    case "San Jose":
      return 0.25;
    case "Las Vegas":
      return 1;
    case "Denver":
      return 5;
    case "Los Angeles":
      return -2.25;
    case "San Diego":
      return -4.5;
    case "Phoenix":
      return -4.5;
    case "El Paso":
      return -7;
    case "Oklahoma City":
      return -1;
    case "Fort Worth":
      return -6;
    case "Dallas":
      return -6;
    case "Austin":
      return -8.25;
    case "San Antonio":
      return -10.5;
    case "Memphis":
      return -1.75;
    case "Nashville":
      return -0.5;
    case "Houston":
      return -7;
    case "Charlotte":
      return -1.75;
    case "Jacksonville":
      return -6;
    case "Milwaukee":
      return 14.5;
    case "Chicago":
      return 10.5;
    case "Columbus":
      return 8;
    case "Boston":
      return 10;
    case "New York City":
      return 6.75;
    case "Philadelphia":
      return 4.5;
    case "Washington DC":
      return 1.75;
    case "Baltimore":
      return 3;
    case "Detroit":
      return 12.5;
    case "Indianapolis":
      return 7;
    default:
      exit();
  }
}

function getDelta($start, $end){
  if($start == $end){
    return 0;
  }
  else if($start > $end){
    return $start - $end;
  }
  else{
    return $end - $start;
  }
}

function getMiles($deltaX, $deltaY){
  $deltaX *= $deltaX;
  $deltaY *= $deltaY;
  $deltaX += $deltaY;
  $miles = sqrt($deltaX);
  $miles *= 50;
  return $miles;
}

function getTax($cost){
  $tax = $cost * 0.05;
  $cost += $tax;
  return $cost;
}
?>
