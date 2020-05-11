<?php
// This is my original work and it shall not be used anywhere else without my written permission.
// This php file will take entries of new details from bank employee for an existing customer id and udpate the same
// in the database.
// If not found, error message will come.
include "connect.php";
/**
 *
 */
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Example</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style> 
    
    body {
    width: 7in;
    height: 7in;
    border-style: solid;
    border-width: 5px;
    background-image: url("tile.jpg");
    background-repeat: repeat;
    background-size: cover;
    font-family: "Times New Roman", sans-serif;
    font-weight: bold;
    font-size: 18pt;
    }
    
    </style>
</head>

<body>
<?php
// get the parameters
$balance = filter_input(INPUT_POST, "balance", FILTER_VALIDATE_INT);
$phone = filter_input(INPUT_POST, "phone", FILTER_VALIDATE_INT);
$customerid = filter_input(INPUT_POST,"customerid",FILTER_VALIDATE_INT);
$addres = filter_input(INPUT_POST, "addres", FILTER_SANITIZE_STRING);
$firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_STRING);
$lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_STRING);


// check from accounts table if the name of customer id input by bank employee is present in the database.
$command = "SELECT * from accounts where customerid = ?";
$stmt = $dbh->prepare($command);
$param = [$customerid];
$success = $stmt->execute($param);
$row = $stmt->fetch();
// if customer id is found in the database update the accounts table with the new details.
if($row>0){
        
        echo "update is done";
        echo "<a href='index.html'>back</a>";
        $update = "UPDATE accounts SET firstname = ?,lastname=?,addres=?,phone=?,balance=? WHERE customerid = ?";
        $stmt = $dbh -> prepare($update);
        $params = [$firstname,$lastname,$addres,$phone,$balance,$customerid];
        $stmt -> execute($params);
        // display the table from database with new entries.
        $table = "SELECT * FROM accounts Order By balance DESC";
        $stmt = $dbh-> prepare($table);
        $success = $stmt-> execute();
        echo "<table border = 10px><tr>
        <th>Customer Id</th>
        <th>First Name    </th>
        <th>Last Name    </th>
        <th>Phone Number</th>
        <th>Address</th>
        <th>Account Balance</th>
        </tr>";
        
        for ($i =0; $i<$stmt->rowCount(); $i++){
            $row = $stmt->fetch();
            $customerid =$row["customerid"];
            $addres = $row["addres"];
            $phone = $row["phone"];
            $balance = $row["balance"];
            $firstname = $row["firstname"];
            $lastname = $row["lastname"];
            echo "<tr>
            <td>$customerid</td>
            <td>$firstname</td>
            <td>$lastname</td>
            <td>$phone</td>
            <td>$addres</td>
            <td>$balance</td>
            </tr>";
        }
        echo "</table>";
        $dbh = null;
}
else{
    // if customer id is not found, show error message to bank employee.
        echo "<h1>Incorrect Customer Id</h1>";
       echo "<a href='index.html'>back</a>";
                       
}


?>
