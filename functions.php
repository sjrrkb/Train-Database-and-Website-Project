<?php

function checkLink($link)
{
    if(!$link)
    {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit();
    }
}

function checkCompanyID($conn, $companyID)
{
    $sql= "SELECT * FROM Customer";
    $output = $conn->query($sql);
    while($row = $output->fetch_array(MYSQLI_NUM))
    {
        if($row[1] == $companyID )
        {
            return 1;
        }
    }
    return 0;
}

function checkUser($conn, $usrnm, $psswd)
{
    $sql = "SELECT * FROM Authentication";
    $output = $conn->query($sql);
    while($row = $output->fetch_array(MYSQLI_NUM))
    {
        if($row[0] == $usrnm && password_verify($psswd, $row[1]))
        {
            if($row[2] == "Customer" || $row[2] == "customer")
            {
                return 1;
            }
            if($row[2] == "Administrator" || $row[2] == "administrator" || $row[2] == "Admin" || $row[2] == "admin" )
            {
                return 2;
            }
            if($row[2] == "Engineer" || $row[2] == "engineer" )
            {
                return 3;
            }
            if($row[2] == "Conductor" || $row[2] == "conductor" )
            {
                return 4;
            }         
        }
    }
    return 0;  
}

function checkEmployeeType($conn, $usrnm)
{
    $sql = "SELECT * FROM Authentication";
    $output = $conn->query($sql);
    while($row = $output->fetch_array(MYSQLI_NUM))
    {
        if($row[0] == $usrnm)
        {
            if($row[2] == "Administrator" || $row[2] == "administrator" || $row[2] == "Admin" || $row[2] == "admin" )
            {
                return 2;
            }
            if($row[2] == "Engineer" || $row[2] == "engineer" )
            {
                return 3;
            }
            if($row[2] == "Conductor" || $row[2] == "conductor" )
            {
                return 4;
            }         
        }
    }
    return 0;      
}

function checkUserOnly($conn, $usrnm)
{
    $sql = "SELECT * FROM User";
    $output = $conn->query($sql);
    while($row = $output->fetch_array(MYSQLI_NUM))
    {
        if($row[0] == $usrnm)
        {
            return 1;
        }
    }
    return 0;
}

function clearQuery($result)
{
	mysqli_free_result($result);

}

function connectToDB()
{
    $conn= new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    if($conn->connect_error)
    {
        die("Connection Failed: " .$conn->connect_error);
    }
    return $conn;
}

function displayEditableResults($result)
{
    echo "<table border=1>";
    echo "<tr>";

    while( $fieldinfo = mysqli_fetch_field($result) )
    {
        echo"<th>".$fieldinfo->name."</th>";

    }
    echo"</tr>";

    while($row=mysqli_fetch_array($result,MYSQLI_NUM))
    {
        echo"<tr>";

        foreach($row as $value)
        {
            
            echo"<td><textarea>".$value."</textarea></td>\n";

        }
        echo"</tr>";
    }
    echo"</table>"; 
}

function displayDeleteUpdateResults($result)
{
    while($fieldInfo = mysqli_fetch_field($result))
    {
        echo "<th>". $fieldInfo->name. "</th>";
    } 
    echo "</thead>";
    while($row = $result->fetch_array(MYSQLI_NUM))
    { 
        echo "<tr>"; 
        foreach($row as $r)
        {
            echo "<td>" . $r . "</td>";
        }
        ?>
        <td>
        <form action="" method="POST">
          <input type="submit" name="delete" value="delete">
          <input type="hidden" name="course_id" value=" ">
          </form>
        </td>
        <td>
        <form action="" method="POST">
          <input type="submit" name="update" value="update">
          <input type="hidden" name="course_id" value=" ">
          </form>
        </td>
        <?php 
        echo "</tr>";
    }
    echo "</table>";    
}

function displayTableResults($result)
{
    echo "<table border=1>";
    echo "<tr>";
    while( $fieldinfo = mysqli_fetch_field($result) )
    {
        echo"<th>".$fieldinfo->name."</th>";

    }
    echo"</tr>";

    while($row=mysqli_fetch_array($result,MYSQLI_NUM))
    {
        echo"<tr>";
        foreach($row as $value)
        {
            echo"<td>".$value."</td>\n";
        }
        echo"</tr>";

    }
    echo"</table>";    
}

 function displayResults($result)
{
    echo "<table border=1>";
    echo "<tr>";
    while( $fieldinfo = mysqli_fetch_field($result) )
    {
        echo"<th>".$fieldinfo->name."</th>";

    }
    echo"</tr>";

    while($row=mysqli_fetch_array($result,MYSQLI_NUM))
    {
        echo"<tr>";
        foreach($row as $value)
        {
            echo"<td>".$value."</td>\n";
        }
        echo"</tr>";
    }
    echo"</table>";    
}

function logAction($actionstr)
{
        $action_taken_time = date('Y-m-d G:i:s');
        $IP_address = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
        $user_id = $_SESSION['uname'];
        echo "LOGGED: " . $action_taken_time . " " . $IP_address . " " . $user_id;


        $mysqli = connectToDB();
        $query = "INSERT INTO User_Logs VALUES(?,?,?,?)";
        $stmt = $mysqli->stmt_init();
        if (!$stmt->prepare($query))
        {
                printf("Error: %s.\n", $stmt->error);
                exit();
        }
        $stmt->bind_param("ssss", $action_taken_time, $actionstr, $IP_address, $user_id);
        $stmt->execute();
        $stmt->close();
        $mysqli->close();
}


function printTable($result)
{
	while($field = mysqli_fetch_field($result))
	{
		echo "<th>";
		echo $field->name;
		echo "</th>";
	}
    echo "</thead>";
	while($row = mysqli_fetch_row($result))
	{
		echo "<tr>";
		foreach($row as $value)
		{
			echo "<td>";
			echo $value;
			echo "</td>";
		}
		echo "<td>";
		echo '<form action = "update.php" method = "POST">';
		echo "<input type = 'hidden' name = 'updateClassName' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'updateDepartmentName' value = '$row[1]'>";
		echo "<input type = 'hidden' name = 'updateCourseID' value = '$row[2]'>";
		echo "<input type = 'hidden' name = 'updateStartTime' value = '$row[3]'>";
		echo "<input type = 'hidden' name = 'updateEndTime' value = '$row[4]'>";
		echo "<input type = 'hidden' name = 'updateDays' value = '$row[5]'>";
		echo '<input type= "submit" name="update" value="Update">';
		echo "</form>";
		echo "</td>";
	
		echo "<td>";
		echo '<form action = "delete.php" method = "POST">';
		echo "<input type = 'hidden' name = 'deleteClassName' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'deleteDepartmentName' value = '$row[1]'>";
		echo "<input type = 'hidden' name = 'deleteCourseID' value = '$row[2]'>";
		echo "<input type = 'hidden' name = 'deleteStartTime' value = '$row[3]'>";
		echo "<input type = 'hidden' name = 'deleteEndTime' value = '$row[4]'>";
		echo "<input type = 'hidden' name = 'deleteDays' value = '$row[5]'>";
		echo "<input type= 'submit' name='delete' value='Delete'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
	}


	echo "</table>";

}

function printAdminTable($result)
{
    //echo "<table border=1>";
    while($field = mysqli_fetch_field($result))
	{
		echo "<th>";
		echo $field->name;
		echo "</th>";
	}
    echo "</thead>";
	while($row = mysqli_fetch_row($result))
	{
        
		echo "<tr>";
		foreach($row as $value)
		{
			echo "<td>";
			echo $value;
			echo "</td>";
		}
		echo "<td>";
		echo '<form action = "update.php" method = "POST">';
		echo "<input type = 'hidden' name = 'updateUserID' value = '$row[0]'>";
		echo '<input type= "submit" name="update" value="Update">';
		echo "</form>";
		echo "</td>";
	
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'deleteUserID' value = '$row[0]'>";
		echo "<input type= 'submit' name='delete' value='Delete'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
        
	}


	echo "</table>";

}

function printAssignedCarTable($result)
{
    //echo "<table border=1>";
    while($field = mysqli_fetch_field($result))
	{
		echo "<th>";
		echo $field->name;
		echo "</th>";
	}
    echo "</thead>";
	while($row = mysqli_fetch_row($result))
	{
		echo "<tr>";
		foreach($row as $value)
		{
			echo "<td>";
			echo $value;
			echo "</td>";
		}
		echo "<td>";
		echo '<form action = "update.php" method = "POST">';
		echo "<input type = 'hidden' name = 'updateAssignedCarID' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'updateTrainID' value = '$row[1]'>";
        echo '<input type= "submit" name="update" value="Update">';
		echo "</form>";
		echo "</td>";
	
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'deleteAssignedCarID' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'deleteTrainID' value = '$row[1]'>";
        echo "<input type= 'submit' name='delete' value='Delete'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
        
	}


	echo "</table>";

}

function printAssignedConductorTable($result)
{
    //echo "<table border=1>";
    while($field = mysqli_fetch_field($result))
	{
		echo "<th>";
		echo $field->name;
		echo "</th>";
	}
    echo "</thead>";
	while($row = mysqli_fetch_row($result))
	{
		echo "<tr>";
		foreach($row as $value)
		{
			echo "<td>";
			echo $value;
			echo "</td>";
		}
		echo "<td>";
		echo '<form action = "update.php" method = "POST">';
		echo "<input type = 'hidden' name = 'updateAssignedUserID' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'updateTrainID' value = '$row[1]'>";
        echo '<input type= "submit" name="update" value="Update">';
		echo "</form>";
		echo "</td>";
	
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'deleteAssignedUserID' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'deleteTrainID' value = '$row[1]'>";
        echo "<input type= 'submit' name='delete' value='Delete'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
        
	}


	echo "</table>";

}

function printAssignedEngineerTable($result)
{
    //echo "<table border=1>";
    while($field = mysqli_fetch_field($result))
	{
		echo "<th>";
		echo $field->name;
		echo "</th>";
	}
    echo "</thead>";
	while($row = mysqli_fetch_row($result))
	{
		echo "<tr>";
		foreach($row as $value)
		{
			echo "<td>";
			echo $value;
			echo "</td>";
		}
		echo "<td>";
		echo '<form action = "update.php" method = "POST">';
		echo "<input type = 'hidden' name = 'updateAssignedUserID' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'updateTrainID' value = '$row[1]'>";
        echo '<input type= "submit" name="update" value="Update">';
		echo "</form>";
		echo "</td>";
	
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'deleteAssignedUserID' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'deleteTrainID' value = '$row[1]'>";
        echo "<input type= 'submit' name='delete' value='Delete'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
        
	}


	echo "</table>";

}

function printAssignedLocomotiveTable($result)
{
    //echo "<table border=1>";
    while($field = mysqli_fetch_field($result))
	{
		echo "<th>";
		echo $field->name;
		echo "</th>";
	}
    echo "</thead>";
	while($row = mysqli_fetch_row($result))
	{
		echo "<tr>";
		foreach($row as $value)
		{
			echo "<td>";
			echo $value;
			echo "</td>";
		}
		echo "<td>";
		echo '<form action = "update.php" method = "POST">';
		echo "<input type = 'hidden' name = 'updateAssignedLocoID' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'updateTrainID' value = '$row[1]'>";
        echo '<input type= "submit" name="update" value="Update">';
		echo "</form>";
		echo "</td>";
	
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'deleteAssignedLocoID' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'deleteTrainID' value = '$row[1]'>";
        echo "<input type= 'submit' name='delete' value='Delete'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
        
	}


	echo "</table>";

}


function printAuthTable($result)
{
    //echo "<table border=1>";
    while($field = mysqli_fetch_field($result))
	{
		echo "<th>";
		echo $field->name;
		echo "</th>";
	}
    echo "</thead>";
	while($row = mysqli_fetch_row($result))
	{
		echo "<tr>";
		foreach($row as $value)
		{
			echo "<td>";
			echo $value;
			echo "</td>";
		}
		echo "<td>";
		echo '<form action = "update.php" method = "POST">';
		echo "<input type = 'hidden' name = 'updateUserID' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'updatePassword' value = '$row[1]'>";
		echo "<input type = 'hidden' name = 'updateRole' value = '$row[2]'>";
		echo '<input type= "submit" name="update" value="Update">';
		echo "</form>";
		echo "</td>";
	
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'deleteUserID' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'deletePassword' value = '$row[1]'>";
		echo "<input type = 'hidden' name = 'deleteRole' value = '$row[2]'>";
		echo "<input type= 'submit' name='delete' value='Delete'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
        
	}


	echo "</table>";

}

function printCarTable($result)
{
    //echo "<table border=1>";
    while($field = mysqli_fetch_field($result))
	{
		echo "<th>";
		echo $field->name;
		echo "</th>";
	}
    echo "</thead>";
	while($row = mysqli_fetch_row($result))
	{
        
		echo "<tr>";
		foreach($row as $value)
		{
			echo "<td>";
			echo $value;
			echo "</td>";
		}
		echo "<td>";
		echo '<form action = "update.php" method = "POST">';
		echo "<input type = 'hidden' name = 'updateCarNumber' value = '$row[0]'>";
        echo "<input type = 'hidden' name = 'updateCarType' value = '$row[1]'>";
        echo "<input type = 'hidden' name = 'updateIsReserved' value = '$row[2]'>";
		echo '<input type= "submit" name="update" value="Update">';
		echo "</form>";
		echo "</td>";
	
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'deleteCarNumber' value = '$row[0]'>";
        echo "<input type = 'hidden' name = 'deleteCarType' value = '$row[1]'>";
        echo "<input type = 'hidden' name = 'deleteIsReserved' value = '$row[2]'>";
		echo "<input type= 'submit' name='delete' value='Delete'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
        
	}


	echo "</table>";

}

function printCarTypeTable($result)
{
    //echo "<table border=1>";
    while($field = mysqli_fetch_field($result))
	{
		echo "<th>";
		echo $field->name;
		echo "</th>";
	}
    echo "</thead>";
	while($row = mysqli_fetch_row($result))
	{
        
		echo "<tr>";
		foreach($row as $value)
		{
			echo "<td>";
			echo $value;
			echo "</td>";
		}
		echo "<td>";
		echo '<form action = "update.php" method = "POST">';
		echo "<input type = 'hidden' name = 'updateCarType' value = '$row[0]'>";
        echo "<input type = 'hidden' name = 'updateCarPrice' value = '$row[1]'>";
		echo '<input type= "submit" name="update" value="Update">';
		echo "</form>";
		echo "</td>";
	
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'deleteCarType' value = '$row[0]'>";
        echo "<input type = 'hidden' name = 'deleteCarPrice' value = '$row[1]'>";
		echo "<input type= 'submit' name='delete' value='Delete'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
        
	}


	echo "</table>";

}

function printCustomerTable($result)
{
    //echo "<table border=1>";
    while($field = mysqli_fetch_field($result))
	{
		echo "<th>";
		echo $field->name;
		echo "</th>";
	}
    echo "</thead>";
	while($row = mysqli_fetch_row($result))
	{
        
		echo "<tr>";
		foreach($row as $value)
		{
			echo "<td>";
			echo $value;
			echo "</td>";
		}
		echo "<td>";
		echo '<form action = "update.php" method = "POST">';
		echo "<input type = 'hidden' name = 'updateUserID' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'updateCompanyID' value = '$row[1]'>";
		echo '<input type= "submit" name="update" value="Update">';
		echo "</form>";
		echo "</td>";
	
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'deleteUserID' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'deleteCompanyID' value = '$row[1]'>";
		echo "<input type= 'submit' name='delete' value='Delete'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
        
	}


	echo "</table>";

}

function printConductorTable($result)
{
    //echo "<table border=1>";
    while($field = mysqli_fetch_field($result))
	{
		echo "<th>";
		echo $field->name;
		echo "</th>";
	}
    echo "</thead>";
	while($row = mysqli_fetch_row($result))
	{
        
		echo "<tr>";
		foreach($row as $value)
		{
			echo "<td>";
			echo $value;
			echo "</td>";
		}
		echo "<td>";
		echo '<form action = "update.php" method = "POST">';
		echo "<input type = 'hidden' name = 'updateUserID' value = '$row[0]'>";
        echo "<input type = 'hidden' name = 'updateRank' value = '$row[1]'>";
		echo '<input type= "submit" name="update" value="Update">';
		echo "</form>";
		echo "</td>";
	
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'deleteUserID' value = '$row[0]'>";
        echo "<input type = 'hidden' name = 'deleteRank' value = '$row[1]'>";
		echo "<input type= 'submit' name='delete' value='Delete'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
        
	}


	echo "</table>";

}

function printLogTable($result)
{
    //echo "<table border=1>";
    while($field = mysqli_fetch_field($result))
	{
		echo "<th>";
		echo $field->name;
		echo "</th>";
	}
    echo "</thead>";
	while($row = mysqli_fetch_row($result))
	{
        
		echo "<tr>";
		foreach($row as $value)
		{
			echo "<td>";
			echo $value;
			echo "</td>";
		}
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'updateUserID' value = '$row[0]'>";
        echo "<input type = 'hidden' name = 'updateActionTaken' value = '$row[1]'>";
        echo "<input type = 'hidden' name = 'updateActionTakenTime' value = '$row[2]'>";
        echo "<input type = 'hidden' name = 'updateIPAdress' value = '$row[3]'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
        
	}


	echo "</table>";

}

function printDepotTable($result)
{
    //echo "<table border=1>";
    while($field = mysqli_fetch_field($result))
	{
		echo "<th>";
		echo $field->name;
		echo "</th>";
	}
    echo "</thead>";
	while($row = mysqli_fetch_row($result))
	{
        
		echo "<tr>";
		foreach($row as $value)
		{
			echo "<td>";
			echo $value;
			echo "</td>";
		}
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'updateDepotLocation' value = '$row[0]'>";
		echo '<input type= "submit" name="update" value="Update">';
		echo "</form>";
		echo "</td>";
	
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'deleteDepotLocation' value = '$row[0]'>";
		echo "<input type= 'submit' name='delete' value='Delete'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
        
	}


	echo "</table>";

}

function printEngineerTable($result)
{
    //echo "<table border=1>";
    while($field = mysqli_fetch_field($result))
	{
		echo "<th>";
		echo $field->name;
		echo "</th>";
	}
    echo "</thead>";
	while($row = mysqli_fetch_row($result))
	{
        
		echo "<tr>";
		foreach($row as $value)
		{
			echo "<td>";
			echo $value;
			echo "</td>";
		}
		echo "<td>";
		echo '<form action = "update.php" method = "POST">';
		echo "<input type = 'hidden' name = 'updateUserID' value = '$row[0]'>";
        echo "<input type = 'hidden' name = 'updateTotalHoursTraveled' value = '$row[1]'>";
        echo "<input type = 'hidden' name = 'updateRank' value = '$row[2]'>";
		echo '<input type= "submit" name="update" value="Update">';
		echo "</form>";
		echo "</td>";
	
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'deleteUserID' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'deleteTotalHoursTraveled' value = '$row[1]'>";
        echo "<input type = 'hidden' name = 'deleteRank' value = '$row[2]'>";
		echo "<input type= 'submit' name='delete' value='Delete'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
        
	}


	echo "</table>";

}

function printEmployeeTable($result)
{
    //echo "<table border=1>";
    while($field = mysqli_fetch_field($result))
	{
		echo "<th>";
		echo $field->name;
		echo "</th>";
	}
    echo "</thead>";
	while($row = mysqli_fetch_row($result))
	{
        
		echo "<tr>";
		foreach($row as $value)
		{
			echo "<td>";
			echo $value;
			echo "</td>";
		}
		echo "<td>";
		echo '<form action = "update.php" method = "POST">';
		echo "<input type = 'hidden' name = 'updateUserID' value = '$row[0]'>";
        echo "<input type = 'hidden' name = 'updateFirstName' value = '$row[1]'>";
        echo "<input type = 'hidden' name = 'updateLastName' value = '$row[2]'>";
        echo "<input type = 'hidden' name = 'updatePassword' value = '$row[3]'>";
        echo "<input type = 'hidden' name = 'updateRole' value = '$row[4]'>";
        echo "<input type = 'hidden' name = 'updateStatus' value = '$row[5]'>";
        echo "<input type = 'hidden' name = 'updateRank' value = '$row[6]'>";
        echo "<input type = 'hidden' name = 'updateTotalHoursTraveling' value = '$row[7]'>";
		echo '<input type= "submit" name="update" value="Update">';
		echo "</form>";
		echo "</td>";
	
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'deleteUserID' value = '$row[0]'>";
        echo "<input type = 'hidden' name = 'deleteFirstName' value = '$row[1]'>";
        echo "<input type = 'hidden' name = 'deleteLastName' value = '$row[2]'>";
        echo "<input type = 'hidden' name = 'deletePassword' value = '$row[3]'>";
        echo "<input type = 'hidden' name = 'deleteRole' value = '$row[4]'>";
        echo "<input type = 'hidden' name = 'deleteStatus' value = '$row[5]'>";
        echo "<input type = 'hidden' name = 'deleteRank' value = '$row[6]'>";
        echo "<input type = 'hidden' name = 'deleteTotalHoursTraveling' value = '$row[7]'>";
		echo "<input type= 'submit' name='delete' value='Delete'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
        
	}


	echo "</table>";

}

function printEmployeeConductorTable($result)
{
    //echo "<table border=1>";
    while($field = mysqli_fetch_field($result))
	{
		echo "<th>";
		echo $field->name;
		echo "</th>";
	}
    echo "</thead>";
	while($row = mysqli_fetch_row($result))
	{
        
		echo "<tr>";
		foreach($row as $value)
		{
			echo "<td>";
			echo $value;
			echo "</td>";
		}
		echo "<td>";
		echo '<form action = "updateConductor.php" method = "POST">';
		echo "<input type = 'hidden' name = 'updateUserID' value = '$row[0]'>";
        echo "<input type = 'hidden' name = 'updateFirstName' value = '$row[1]'>";
        echo "<input type = 'hidden' name = 'updateLastName' value = '$row[2]'>";
        echo "<input type = 'hidden' name = 'updatePassword' value = '$row[3]'>";
        echo "<input type = 'hidden' name = 'updateRole' value = '$row[4]'>";
        echo "<input type = 'hidden' name = 'updateStatus' value = '$row[5]'>";
        echo "<input type = 'hidden' name = 'updateRank' value = '$row[6]'>";
        echo "<input type = 'hidden' name = 'updateTotalHoursTraveling' value = '$row[7]'>";
        echo '<input type= "submit" name="update" value="Update">';
		echo "</form>";
		echo "</td>";
	
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'deleteUserID' value = '$row[0]'>";
        echo "<input type = 'hidden' name = 'deleteFirstName' value = '$row[1]'>";
        echo "<input type = 'hidden' name = 'deleteLastName' value = '$row[2]'>";
        echo "<input type = 'hidden' name = 'deletePassword' value = '$row[3]'>";
        echo "<input type = 'hidden' name = 'deleteRole' value = '$row[4]'>";
        echo "<input type = 'hidden' name = 'deleteStatus' value = '$row[5]'>";
        echo "<input type = 'hidden' name = 'deleteRank' value = '$row[6]'>";
        echo "<input type = 'hidden' name = 'deleteTotalHoursTraveling' value = '$row[7]'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
        
	}


	echo "</table>";

}


function printLocomotiveTable($result)
{
    //echo "<table border=1>";
    while($field = mysqli_fetch_field($result))
	{
		echo "<th>";
		echo $field->name;
		echo "</th>";
	}
    echo "</thead>";
	while($row = mysqli_fetch_row($result))
	{
        
		echo "<tr>";
		foreach($row as $value)
		{
			echo "<td>";
			echo $value;
			echo "</td>";
		}
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'updateLocoNumber' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'updateLocoType' value = '$row[1]'>";
        echo "<input type = 'hidden' name = 'updateDepotLocation' value = '$row[2]'>";
		echo '<input type= "submit" name="update" value="Update">';
		echo "</form>";
		echo "</td>";
	
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'deleteLocoNumber' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'deleteLocoType' value = '$row[1]'>";
        echo "<input type = 'hidden' name = 'deleteDepotLocation' value = '$row[2]'>";
		echo "<input type= 'submit' name='delete' value='Delete'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
        
	}


	echo "</table>";

}

function printOnSiteTable($result)
{
    //echo "<table border=1>";
    while($field = mysqli_fetch_field($result))
	{
		echo "<th>";
		echo $field->name;
		echo "</th>";
	}
    echo "</thead>";
	while($row = mysqli_fetch_row($result))
	{
        
		echo "<tr>";
		foreach($row as $value)
		{
			echo "<td>";
			echo $value;
			echo "</td>";
		}
		echo "<td>";
		echo '<form action = "update.php" method = "POST">';
		echo "<input type = 'hidden' name = 'updateUserID' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'updateStatus' value = '$row[1]'>";
		echo '<input type= "submit" name="update" value="Update">';
		echo "</form>";
		echo "</td>";
	
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'deleteUserID' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'deleteStatus' value = '$row[1]'>";
		echo "<input type= 'submit' name='delete' value='Delete'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
        
	}


	echo "</table>";

}

function printReservationsTable($result)
{
    //echo "<table border=1>";
    while($field = mysqli_fetch_field($result))
	{
		echo "<th>";
		echo $field->name;
		echo "</th>";
	}
    echo "</thead>";
	while($row = mysqli_fetch_row($result))
	{
        
		echo "<tr>";
		foreach($row as $value)
		{
			echo "<td>";
			echo $value;
			echo "</td>";
		}
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'updateCarID' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'updateCompanyID' value = '$row[1]'>";
        echo "<input type = 'hidden' name = 'updateReservationDate' value = '$row[2]'>";
        echo "<input type = 'hidden' name = 'updateFinalPrice' value = '$row[3]'>";
        echo "<input type = 'hidden' name = 'updateDeparture' value = '$row[4]'>";
        echo "<input type = 'hidden' name = 'updateDestination' value = '$row[5]'>";
		echo "</form>";
		echo "</td>";
	
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'deleteCarID' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'deleteCompanyID' value = '$row[1]'>";
        echo "<input type = 'hidden' name = 'deleteReservationDate' value = '$row[2]'>";
        echo "<input type = 'hidden' name = 'deleteFinalPrice' value = '$row[3]'>";
        echo "<input type = 'hidden' name = 'deleteDeparture' value = '$row[4]'>";
        echo "<input type = 'hidden' name = 'deleteDestination' value = '$row[5]'>";
		echo "<input type= 'submit' name='delete' value='Delete'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
        
	}


	echo "</table>";

}


function printTrainTable($result)
{
    //echo "<table border=1>";
    while($field = mysqli_fetch_field($result))
	{
		echo "<th>";
		echo $field->name;
		echo "</th>";
	}
    echo "</thead>";
	while($row = mysqli_fetch_row($result))
	{
        
		echo "<tr>";
		foreach($row as $value)
		{
			echo "<td>";
			echo $value;
			echo "</td>";
		}
		echo "<td>";
		echo '<form action = "update.php" method = "POST">';
		echo "<input type = 'hidden' name = 'updateTrainID' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'updateFROM' value = '$row[1]'>";
        echo "<input type = 'hidden' name = 'updateTO' value = '$row[2]'>";
        echo "<input type = 'hidden' name = 'updateRunningDays' value = '$row[3]'>";
        echo "<input type = 'hidden' name = 'updateTravelTime' value = '$row[4]'>";
        echo "<input type = 'hidden' name = 'updateLength' value = '$row[5]'>";
		echo '<input type= "submit" name="update" value="Update">';
		echo "</form>";
		echo "</td>";
	
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'deleteTrainID' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'deleteFROM' value = '$row[1]'>";
        echo "<input type = 'hidden' name = 'deleteTO' value = '$row[2]'>";
        echo "<input type = 'hidden' name = 'deleteRunningDays' value = '$row[3]'>";
        echo "<input type = 'hidden' name = 'deleteTravelTime' value = '$row[4]'>";
        echo "<input type = 'hidden' name = 'deleteLength' value = '$row[5]'>";
		echo "<input type= 'submit' name='delete' value='Delete'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
        
	}


	echo "</table>";

}

function printUserTable($result)
{
    //echo "<table border=1>";
    while($field = mysqli_fetch_field($result))
	{
		echo "<th>";
		echo $field->name;
		echo "</th>";
	}
    echo "</thead>";
	while($row = mysqli_fetch_row($result))
	{
        
		echo "<tr>";
		foreach($row as $value)
		{
			echo "<td>";
			echo $value;
			echo "</td>";
		}
		echo "<td>";
		echo '<form action = "update.php" method = "POST">';
		echo "<input type = 'hidden' name = 'updateUserID' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'updateFirstName' value = '$row[1]'>";
		echo "<input type = 'hidden' name = 'updateLastName' value = '$row[2]'>";
		echo '<input type= "submit" name="update" value="Update">';
		echo "</form>";
		echo "</td>";
	
		echo "<td>";
		echo '<form action = "" method = "POST">';
		echo "<input type = 'hidden' name = 'deleteUserID' value = '$row[0]'>";
		echo "<input type = 'hidden' name = 'deleteFirstName' value = '$row[1]'>";
		echo "<input type = 'hidden' name = 'deleteLastName' value = '$row[2]'>";
		echo "<input type= 'submit' name='delete' value='Delete'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
        
	}


	echo "</table>";

}

function searchByCourseID($link)
{

	$sql = 'SELECT * FROM classes WHERE course_id LIKE concat(? , "%");';
	if ($stmt = mysqli_prepare($link, $sql))
	{
		mysqli_stmt_bind_param($stmt , "s" , $_POST['searchBar'] ) or die ("24");
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
	}

	printTable($result);

	clearQuery($result);

}

function searchByDepartment($link)
{


	$sql = 'SELECT * FROM classes WHERE department LIKE concat(? , "%");';
	if ($stmt = mysqli_prepare($link, $sql))
	{
		mysqli_stmt_bind_param($stmt , "s" , $_POST['searchBar'] ) or die ("24");
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
	}

	printTable($result);
	clearQuery($result);
}


function searchByName($link)
{

	$sql = 'SELECT * FROM classes WHERE name LIKE concat(? , "%");';
	if ($stmt = mysqli_prepare($link, $sql))
	{
		mysqli_stmt_bind_param($stmt , "s" , $_POST['searchBar'] ) or die ("24");
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
	}

	printTable($result);
	clearQuery($result);


}


function searchByAll($link)
{

	$sql = 'SELECT * FROM classes;';
	if ($stmt = mysqli_prepare($link, $sql))
	{
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
	}

	printTable($result);
	clearQuery($result);

}

function updateCustomerTable($mysqli, $passedUserID, $passedCompanyID) 
{

	$sql = "UPDATE `Customer` SET company_id = ? WHERE user_id= ?;";
       
    $stmt = $mysqli->stmt_init();
    if( !$stmt->prepare($sql) )
    {
        exit();
    }
    
    $stmt->bind_param("ss", $passedCompanyID ,$passedUserID);

    if( $stmt->bind_param("ss", $passedCompanyID ,$passedUserID) )
    {
        $stmt->execute();
        echo"<p>Customer Table successfully updated!</p>";
        echo "You have successfully changed companyID  to ";
        echo $passedCompanyID;
        echo " and userID has not changed because its a primary key.";
        echo "<br>";
    }
    else
    {
        echo "<p>statment failed to execute...life sucks!</p>";
    }
    updateUserLogTable($_SESSION['uname'], $sql);
    $stmt->close();
}


function updateTableValues($mysqli ,$departmentName ,$className ,$start ,$end ,$days  , $courseID) 
{

	$sql = "UPDATE `classes` SET name = ?, department = ?, start = ?, end = ?, days = ?  WHERE course_id = ?;";
       
    $stmt = $mysqli->stmt_init();
    if( !$stmt->prepare($sql) )
    {
        exit();
    }

    $stmt->bind_param("ssssss", $className, $departmentName, $start, $end, $days,$courseID);

    if( $stmt->bind_param("ssssss", $className, $departmentName, $start, $end, $days, $courseID) )
    {
        $stmt->execute();
        echo"<p>Table successfully updated!</p>";
        echo "You have successfully changed classname to ";
        echo $className;
        echo ", departmentName to ";
        echo $departmentName;
        echo ", startTime to ";
        echo $start;
        echo ", endTime to ";
        echo $end;
        echo ", days to ";
        echo $days;
        echo ", courseID to";
        echo $courseID;
        echo " and courseID has not changed!";
        echo "<br>";
    }
    else
    {
        echo "<p>statment failed to execute...life sucks!</p>";
    }
    $stmt->close();
}

function updateAuthenticationTable($mysqli, $passedUserID, $passedPassword, $passedRole) 
{

	$sql = "UPDATE `Authentication` SET password_hash = ? WHERE user_id= ?;";
       
    $stmt = $mysqli->stmt_init();
    if( !$stmt->prepare($sql) )
    {
        exit();
    }
    
    $hash = password_hash($passedPassword, PASSWORD_DEFAULT);
    
    $stmt->bind_param("ss", $hash ,$passedUserID);

    if( $stmt->bind_param("ss", $hash ,$passedUserID) )
    {
        $stmt->execute();
        echo"<p>Authentication Table successfully updated!</p>";
        echo "You have successfully changed password  to ";
        echo $passedPassword;
        echo " and userID has not changed because its a primary key.";
        echo "<br>";
    }
    else
    {
        echo "<p>statment failed to execute...life sucks!</p>";
    }
    updateUserLogTable($_SESSION['uname'], $sql);
    $stmt->close();
}

function updateCarTable($mysqli, $passedCarID, $passedCarType, $passedIsReserved) 
{

	$sql = "UPDATE `Car` SET is_reserved=? WHERE car_id= ?;";
       
    $stmt = $mysqli->stmt_init();
    if( !$stmt->prepare($sql) )
    {
        exit();
    }

    $stmt->bind_param("ss", $passedIsReserved, $passedCarID );

    if( $stmt->bind_param("ss", $passedIsReserved, $passedCarID) )
    {
        $stmt->execute();
        echo"<p>Car Table successfully updated!</p>";
        echo "You have successfully changed is_reserved to ";
        echo $passedIsReserved;
        echo " and carID and CarType have not changed because they are the primary keys!!";
        echo "<br>";
    }
    else
    {
        echo "<p>statment failed to execute...life sucks!</p>";
    }
    updateUserLogTable($_SESSION['uname'], $sql);
    $stmt->close();
}

function updateCarTypeTable($mysqli,$passedCarType, $passedCarPrice) 
{

	$sql = "UPDATE `Car_Type` SET car_type_price=? WHERE car_type= ?;";
       
    $stmt = $mysqli->stmt_init();
    if( !$stmt->prepare($sql) )
    {
        exit();
    }

    $stmt->bind_param("ss", $passedCarPrice, $passedCarType );

    if( $stmt->bind_param("ss", $passedCarPrice, $passedCarType) )
    {
        $stmt->execute();
        echo"<p>Car_Type Table successfully updated!</p>";
        echo "You have successfully changed car_type:  ";
        echo $passedCarType;
        echo "'s price to ";
        echo $passedCarPrice;
        echo ", and car type has not been changed because it is a primary key!";
        echo "<br>";
    }
    else
    {
        echo "<p>statment failed to execute...life sucks!</p>";
    }
    updateUserLogTable($_SESSION['uname'], $sql);
    $stmt->close();
}

function updateEmployeeTable($mysqli, $passedUserID, $passedFirstName, $passedLastName, $passedPassword, $passedRole, $passedStatus, $passedRank, $passedTotalHoursTraveled) 
{

    //user
    updateUserTable($mysqli, $passedUserID, $passedFirstName, $passedLastName);
    
    //authentication
    updateAuthenticationTable($mysqli, $passedUserID, $passedPassword, $passedRole);
    
    //OnSite Personnel
    updateOnSiteTable($mysqli, $passedUserID, $passedStatus);
    
    $employeeType=checkEmployeeType($mysqli, $passedUserID);
    //engineer
    if($employeeType ==3)
    {
        updateEngineerTable($mysqli, $passedUserID, $passedTotalHoursTraveled, $passedRank);
    }

    //conductor
    if($employeeType ==4)
    {
        updateConductorTable($mysqli, $passedUserID, $passedRank);     
    }
    
    
    
    $sql="UPDATE `join_Con_Eng_Admin` SET first_name=?, last_name=?, password_hash=?, role=?, status=?, rank=?, total_hours_traveling=? WHERE user_id=?";
    $stmt = $mysqli->stmt_init();
    if( !$stmt->prepare($sql) )
    {
        echo "joint conductor/eng table failed you suck!";
        exit();
    }
    $validStmt = password_hash($passedPassword, PASSWORD_DEFAULT);
    $bill=$stmt->bind_param("ssssssss", $passedFirstName, $passedLastName, $hash, $passedRole, $passedStatus, $passedRank, $passedTotalHoursTraveled, $passedUserID);
    
    if($validStmt)
    {
        $stmt->execute();
        echo "<br>";
        echo "<p> Joint Conductor Engineer Table has been updated successfully. ".$passedUserID." profile's first name to ".$passedFirstName.", last name to ".$passedLastName.", password to ".$passedPassword.", role to ".$passedRole.", status to ".$passedStatus.", rank to ".$passedRank.", and total hours traveled to ".$passedTotalHoursTraveled."</p>";
        echo "<br>";
    }
    updateUserLogTable($_SESSION['uname'], $sql);
    $stmt->close();
}

function updateEngineerTable($mysqli, $passedUserID, $passedTotalHoursTraveled, $passedRank) 
{
    
	$sql = "UPDATE `Engineer` SET total_hours_traveling = ?, rank=? WHERE user_id= ?;";
       
    $stmt = $mysqli->stmt_init();
    if( !$stmt->prepare($sql) )
    {
        exit();
    }
    
    $stmt->bind_param("ssi", $passedTotalHoursTraveled, $passedRank, $passedUserID);

    if( $stmt->bind_param("ssi", $passedTotalHoursTraveled, $passedRank, $passedUserID) )
    { 
        $stmt->execute();
        echo"<p>Engineer Table successfully updated!</p>";
        echo "You have successfully changed total hours traveled  to ";
        echo $passedTotalHoursTraveled;
        echo " , and rank to ".$passedRank;
        echo " , and userID has not changed because its a primary key.";
        echo "<br>";
    }
    else
    {
        echo "<p>statment failed to execute...life sucks!</p>";
    }
    updateUserLogTable($_SESSION['uname'], $sql);
    $stmt->close();
}

function updateConductorTable($mysqli, $passedUserID, $passedRank) 
{
    
    
	$sql = "UPDATE `Conductor` SET rank = ? WHERE user_id= ?;";
       
    $stmt = $mysqli->stmt_init();
    if( !$stmt->prepare($sql) )
    {
        exit();
    }
    
    $stmt->bind_param("ss", $passedRank, $passedUserID);

    if( $stmt->bind_param("ss", $passedRank, $passedUserID) )
    { 
        $stmt->execute();
        echo"<p>Conductor Table successfully updated!</p>";
        echo "You have successfully changed rank to ";
        echo $passedRank;
        echo " , and userID has not changed because its a primary key.";
        echo "<br>";
    }
    else
    {
        echo "<p>statment failed to execute...life sucks!</p>";
    }
    updateUserLogTable($_SESSION['uname'], $sql);
    $stmt->close();
}


function updateOnSiteTable($mysqli, $passedUserID, $passedStatus) 
{

	$sql = "UPDATE `On_Site_Personnel` SET status= ? WHERE user_id= ?;";
       
    $stmt = $mysqli->stmt_init();
    if( !$stmt->prepare($sql) )
    {
        exit();
    }

    $stmt->bind_param("ss",$passedStatus ,$passedUserID);

    if( $stmt->bind_param("ss",$passedStatus ,$passedUserID) )
    {
        $stmt->execute();
        echo"<p>On_Site_Personnel Table successfully updated!</p>";
        echo "You have successfully changed status to ";
        echo $passedStatus;
        echo " and userID has not changed because its a primary key!!";
        echo "<br>";
    }
    else
    {
        echo "<p>statment failed to execute...life sucks!</p>";
    }
    updateUserLogTable($_SESSION['uname'], $sql);
    $stmt->close();
}
function updateReservationTable($mysqli, $passedCarID, $passedCompanyID, $passedReservationDate, $passedFinalPrice, $passedDeparture, $passedDestination) 
{

	$sql = "UPDATE `Reservation` SET departure = ?, destination=?, running_days=?, hours_traveling=? WHERE train_ID= ?;";
       
    $stmt = $mysqli->stmt_init();
    if( !$stmt->prepare($sql) )
    {
        exit();
    }

    $stmt->bind_param("sssss", $passedFROM, $passedTO, $passedRunningDays, $passedTravelTime, $passedTrainID);

    if( $stmt->bind_param("sssss", $passedFROM, $passedTO, $passedRunningDays, $passedTravelTime, $passedTrainID) )
    {
        $stmt->execute();
        echo"<p>Train Table successfully updated!</p>";
        echo "You have successfully changed departure name to ";
        echo $passedFROM;
        echo ", destination to ";
        echo $passedTO;
        echo ", travel time to ";
        echo $passedTravelTime;
        echo ", running days to ";
        echo $passedRunningDays;
        echo " and trainID has not changed because its a primary key!!";
        echo "<br>";
    }
    else
    {
        echo "<p>statment failed to execute...life sucks!</p>";
    }
    updateUserLogTable($_SESSION['uname'], $sql);
    $stmt->close();
}


function updateTrainTable($mysqli, $passedTrainID, $passedFROM, $passedTO, $passedRunningDays, $passedTravelTime) 
{

	$sql = "UPDATE `Train` SET departure = ?, destination=?, running_days=?, hours_traveling=? WHERE train_ID= ?;";
       
    $stmt = $mysqli->stmt_init();
    if( !$stmt->prepare($sql) )
    {
        exit();
    }

    $stmt->bind_param("sssss", $passedFROM, $passedTO, $passedRunningDays, $passedTravelTime, $passedTrainID);

    if( $stmt->bind_param("sssss", $passedFROM, $passedTO, $passedRunningDays, $passedTravelTime, $passedTrainID) )
    {
        $stmt->execute();
        echo"<p>Train Table successfully updated!</p>";
        echo "You have successfully changed departure name to ";
        echo $passedFROM;
        echo ", destination to ";
        echo $passedTO;
        echo ", travel time to ";
        echo $passedTravelTime;
        echo ", running days to ";
        echo $passedRunningDays;
        echo " and trainID has not changed because its a primary key!!";
        echo "<br>";
    }
    else
    {
        echo "<p>statment failed to execute...life sucks!</p>";
    }
    updateUserLogTable($_SESSION['uname'], $sql);
    $stmt->close();
}

function updateUserTable($mysqli, $passedUserID, $passedFirstName, $passedLastName) 
{

	$sql = "UPDATE `User` SET first_name = ?, last_name=? WHERE user_id= ?;";
       
    $stmt = $mysqli->stmt_init();
    if( !$stmt->prepare($sql) )
    {
        exit();
    }

    $stmt->bind_param("sss", $passedFirstName, $passedLastName,$passedUserID);

    if( $stmt->bind_param("sss", $passedFirstName, $passedLastName,$passedUserID) )
    {
        $stmt->execute();
        echo"<p>User Table successfully updated!</p>";
        echo "You have successfully changed first name to ";
        echo $passedFirstName;
        echo ", last name to ";
        echo $passedLastName;
        echo " and userID has not changed because its a primary key!!";
        echo "<br>";
    }
    else
    {
        echo "<p>statment failed to execute...life sucks!</p>";
    }
    updateUserLogTable($_SESSION['uname'], $sql);
    $stmt->close();
}



function updateUserLogTable($user, $action)
{
    $action_taken_time = date('Y-m-d G:i:s');
    $IP_address = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
    $mysqli = connectToDB();
    $query = "INSERT INTO User_Logs (user_id, action_taken, action_taken_time, IP_address) VALUES(?,?,?,?)";
    $stmt = $mysqli->stmt_init();
    if (!$stmt->prepare($query))
    {
            printf("Error: %s.\n", $stmt->error);
            exit();
    }
    $stmt->bind_param("ssss", $user, $action, $action_taken_time , $IP_address);
    $stmt->execute();
    $stmt->close();
    $mysqli->close();
}

//function to verify an input password is correct
function validatePassword($mysqli, $uname,$psswd)
{
	$sql = "SELECT user_id, password_hash FROM Authentication WHERE user_id=?;";
	$stmt = $mysqli->stmt_init();
	if(!$stmt->prepare($sql)){
		echo "Error in preparing statement in validatePassword()";
		exit();
	}
	$stmt->bind_param("s", $uname);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_array(MYSQLI_ASSOC) or die ($mysqli->error);
	if(password_verify($psswd, $row["password_hash"])){
		return 1;
	}
	return 0;
}

// generates a random string of length $length
function generateRandomString($length) {
    //$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

//helper function for building trains
function newTrainID()
{
        $mysqli = connectToDB();
        $trainIDLength = 3;
        $id = generateRandomString($trainIDLength);
        $query = "SELECT train_ID from Train WHERE train_ID=?";
        if(!$stmt = $mysqli->prepare($query))
        {
                echo "failed to make new Train Id";
                exit();
        }
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        while ($result->num_rows > 0)
        {
                $id = generateRandomString($trainIDLength);
		if(!$stmt = $mysqli->prepare($query))
                {
                        echo "failed to make new Train Id";
                        exit();
                }
                $stmt->bind_param("s", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
        }
        return $id;
}


//takes a car_id found in the reservations table and adds it to a train
//if not usable train exists it creates a new one and assigns it to that
//trains over 50 cars will have a second locomotive added
//trains can only have up to 100 cars before a new train is created instead
function assign_car($car_id)
{
	$mysqli = connectToDB();
	
	$reservation_query = "SELECT * FROM Reservations WHERE car_id=?";
	
	if(!$stmt = $mysqli->prepare($reservation_query))
    	{
        	echo "Line 25";
		exit();
    	}
	$stmt->bind_param("s", $car_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();

	if ($result->num_rows == 0)
	{
		echo "reservation not found";
		exit();
	}
	$reservation = $result->fetch_array(MYSQLI_ASSOC);
		
	$train_query = "SELECT * FROM Train WHERE destination=? AND length<100";

	if(!$stmt = $mysqli->prepare($train_query))
        {
        	echo "failed to prepare train query";
		exit();
        }
        $stmt->bind_param("s", $reservation['destination']);
        $stmt->execute();
        $result = $stmt->get_result();
	$stmt->close();	
	//echo $reservation['car_id'];
	$train = $result->fetch_array(MYSQLI_ASSOC);

	if ($result->num_rows == 0)
	{
		//echo "Create train called";
		$train_id = create_train($reservation['departure'], $reservation['destination']);
	}
	else if($train['length'] == 50)
	{
	        $train_id = $train['train_ID'];
		$query = "SELECT locomotive_ID FROM Locomotive WHERE locomotive_ID NOT IN (SELECT locomotive_ID FROM Assigned_Locomotive)";
	        $result = $mysqli->query($query);

        	if ($result->num_rows == 0)
        	{
                	echo "no free locomotives";
			exit();
        	}
        	$locomotive = $result->fetch_array(MYSQLI_ASSOC);
		$insert_query = "INSERT INTO Assigned_Locomotive VALUES(?, ?)";

        	if(!$stmt = $mysqli->prepare($insert_query))
        	{
                	echo "Fail add second loco";
                	exit();
        	}
        	$stmt->bind_param("ss", $locomotive['locomotive_ID'], $train_id);
        	$stmt->execute();
        	$stmt->close();
	
	}
	else
	{ 	
		$train_id = $train['train_ID'];
	}
	
	$insert_query = "INSERT INTO Assigned_Car VALUES(?, ?)";

	if(!$stmt = $mysqli->prepare($insert_query))
        {
                echo "line 61";
		exit();
        }
        $stmt->bind_param("ss", $car_id, $train_id);
        $stmt->execute();
	$stmt->close();

	$update_query = "UPDATE Train SET length=length+1 WHERE train_ID=?";

        if(!$stmt = $mysqli->prepare($update_query))
        {
                echo "line 61";
                exit();
        }
        $stmt->bind_param("s", $train_id);
        $stmt->execute();
        $stmt->close();

	$update_query = "UPDATE Car SET is_reserved=True WHERE car_id=?";

        if(!$stmt = $mysqli->prepare($update_query))
        {
                echo "line 61";
                exit();
        }
        $stmt->bind_param("s", $reservation['car_id']);
        $stmt->execute();
        $stmt->close();


	$mysqli->close();

}

//creates a new train and assigns 1 locomotive, 1 conductor, and 2 engineers
function create_train($departure, $destination)
{
	$mysqli = connectToDB();
	$avg_speed = 50.0;
	$days = array("MTWTh", "TWThF", "WThFSa", "ThFSaSu", "FSaSuM", "MTW", "MWF", "TTh", "MTWThF", "TFSa", "SaSuMT");
	$running_days = $days[mt_rand(0, 10)];

        $travel_time = calculate_distance($departure, $destination)/$avg_speed;

	
	$train_id = newTrainID();
	$insert_query = "INSERT INTO Train VALUES(?, ?, ?, ?, ?, 0)";
	
	if(!$stmt = $mysqli->prepare($insert_query))
	{
		echo "line 83";
		exit();
	}
	$stmt->bind_param("sssss", $train_id, $departure, $destination, $running_days, $travel_time);
	$stmt->execute();
	$stmt->close();	

	$query = "SELECT locomotive_ID FROM Locomotive WHERE locomotive_ID NOT IN (SELECT locomotive_ID FROM Assigned_Locomotive)";
	$result = $mysqli->query($query);

	if ($result->num_rows == 0)
	{
		echo "no free locomotives";
		exit();
	}
	$locomotive = $result->fetch_array(MYSQLI_ASSOC);
	
	$insert_query = "INSERT INTO Assigned_Locomotive VALUES(?, ?)";

	if(!$stmt = $mysqli->prepare($insert_query))
	{
		echo "line 107";
		exit();
	}
	$stmt->bind_param("ss", $locomotive['locomotive_ID'], $train_id);
	$stmt->execute();
	$stmt->close();

	
	$query = "SELECT user_id FROM Engineer WHERE user_id NOT IN (SELECT user_id FROM Assigned_Engineer)";
	$result = $mysqli->query($query);
	if ($result->num_rows < 2)
	{
		echo "not enough free engineers";
		exit();
	}
	$engineer1 = $result->fetch_array(MYSQLI_ASSOC); 
	$engineer2 = $result->fetch_array(MYSQLI_ASSOC);
	
	$insert_query = "INSERT INTO Assigned_Engineer VALUES(?, ?)";
	if(!$stmt = $mysqli->prepare($insert_query))
	{
		echo "line 127";
		exit();
	}
	$stmt->bind_param("ss", $engineer1['user_id'], $train_id);
	$stmt->execute();
	$stmt->close();
	
	if(!$stmt = $mysqli->prepare($insert_query))
        {
                echo "line 136";
		exit();
        }
        $stmt->bind_param("ss", $engineer2['user_id'], $train_id);
        $stmt->execute();
        $stmt->close();
	
	$query = "SELECT user_id FROM Conductor WHERE user_id NOT IN (SELECT user_id FROM Assigned_Conductor)";
	$result = $mysqli->query($query);
	if ($result->num_rows == 0)
	{
		echo "no free conductors";
		exit();
	}
	$conductor = $result->fetch_array(MYSQLI_ASSOC);
	$insert_query = "INSERT INTO Assigned_Conductor VALUES(?, ?)";
	        if(!$stmt = $mysqli->prepare($insert_query))
        {
                echo "line 153";
		exit();
        }
        $stmt->bind_param("ss", $conductor['user_id'], $train_id);
        $stmt->execute();
        $stmt->close();


	$mysqli->close();
	
	return $train_id;
}

function calculate_distance($departure, $destination)
{
        $scale_factor = 50;

        $mysqli = connectToDB();
        $query = "SELECT * from Depot WHERE depot_location=?";
        if(!$stmt = $mysqli->prepare($query))
        {
                echo "failed to make new start_depot";
                exit();
        }
        $stmt->bind_param("s", $departure);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $start = $result->fetch_array(MYSQLI_ASSOC);

        if(!$stmt = $mysqli->prepare($query))
        {
                echo "failed to make new end_depot";
                exit();
        }
        $stmt->bind_param("s", $destination);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $end = $result->fetch_array(MYSQLI_ASSOC);

        $x1 = $start['x'];
        $y1 = $start['y'];

        $x2 = $end['x'];
        $y2 = $end['y'];
        echo $x1;
        echo $y1;

        $xdist = $start['x'] - $end['x'];
        $ydist = $end['y'] - $end['y'];

        if ($xdist < 0)
        {
                $xdist = $xdist*-1;
        }
        if ($ydist < 0)
        {
                $ydist = $ydist*-1;
        }
        $dist = sqrt($xdist*$xdist + $ydist*$ydist);
        echo $dist;
        $mysqli->close();
        return $dist*$scale_factor;
}


?>
