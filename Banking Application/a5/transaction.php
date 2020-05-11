<?php
// This is my original work and it shall not be used anywhere else without my written permission.
// This php file will take the cash transaction details from the bank employee. it will check the entered 
// customer id whose bank transaction is to be done. Amount is entered. There are two buttons- add and reduce.
// If add button is clicked, the balance will be increased with the amount else reduced if reduce button is clicked.

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


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
$amount = filter_input(INPUT_POST, "amount", FILTER_VALIDATE_INT);
$customerid = filter_input(INPUT_POST,"customerid",FILTER_VALIDATE_INT);

// check from accounts table if the customer id input by bank official is present in the database.
$command = "SELECT * from accounts where customerid = ?";
$stmt = $dbh->prepare($command);
$param = [$customerid];
$success = $stmt->execute($param);
$row = $stmt->fetch();
// if customer id is found in the database update the balance in the account against the customer id.
if($row>0){
    //Jquery used to check which button add or reduce is clicked.
    if (isset($_POST["add"])) {
        
        echo "add is clicked";
        echo "<a href='index.html'>back</a>";
        $update = "UPDATE accounts SET balance=? WHERE customerid = ?";
        $stmt = $dbh -> prepare($update);
        $params = [$row["balance"]+$amount,$customerid];
        $stmt -> execute($params);
        
        $table = "SELECT * FROM accounts Order By balance DESC";
        $stmt = $dbh-> prepare($table);
        $success = $stmt-> execute();
        echo "<table border = 10px><tr>
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
    elseif (isset($_POST["withdraw"])) {
        echo "withdraw is clicked";
        echo "<a href='index.html'>back</a>";
        $update = "UPDATE accounts SET balance=? WHERE customerid = ?";
        $stmt = $dbh -> prepare($update);
		
        if($row["balance"]>$amount){
        $params = [$row["balance"]-$amount,$customerid];
        
        $stmt -> execute($params);
        
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
        $dbh = null;}
        else {
            // show error message to user if the amount withdrawn is greater than the balance in the account.
            $table = "SELECT * FROM accounts Where customerid = $customerid";
            $stmt = $dbh-> prepare($table);
            $success = $stmt-> execute();
            $row=$stmt->fetch();
            echo "<h1>Cannot withdraw more than current balance</h1>";
            $message = "Transaction Amount ".$amount." is greater than balance in account of ".$row["balance"];
            echo "<script type='text/javascript'>alert('$message');</script>";
        
        echo "<table border = 10px><tr>
        <th>Customer Id</th>
        <th>First Name    </th>
        <th>Last Name    </th>
        <th>Phone Number</th>
        <th>Address</th>
        <th>Account Balance</th>
        </tr>";
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
        
        echo "</table>";
        $dbh = null;
        }
    }
}

else{
        echo "<h1>Incorrect Customer Id</h1>";
       echo "<a href='index.html'>back</a>";
                       
}


?>
