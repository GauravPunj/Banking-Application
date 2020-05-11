<?php
/**
 * once list field display is clicked, this page will open and will fetch all entries from database table
 * named accounts. The entries will be all accounts in the database  including its fields of customer name, phone number,
 * email id, balance in account.
 * 
 */
session_start();
$access = isset($_SESSION["userid"]);
include "connect.php";
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
    if ($access) {
        echo "<h1>List of all Customer Accounts</h1>";
        echo "<a href='menu.php'>back</a>";

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
    } else {
        echo "<h1>Not Logged in. Access denied.</h1>";
    }
    ?>
</body>

</html>