
<?php
// This is my original work and it shall not be used anywhere else without my written permission.
// This is my original work and not copied from anywhere else except for the given course material on elearn
// This file receives POST parameters for a new customer and inserts it into the database.
include "connect.php";
/**
 *
 */

// get the parameters via post method from the banksystem.js file
$firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_STRING);
$lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_STRING);
$addres = filter_input(INPUT_POST, "addres", FILTER_SANITIZE_STRING);
$phone = filter_input(INPUT_POST, "phone", FILTER_VALIDATE_INT);
$balance = filter_input(INPUT_POST, "balance", FILTER_SANITIZE_STRING);


$insert = "INSERT INTO accounts (firstname,lastname,addres,phone,balance) Values(?,?,?,?,?)";
                $params = [$firstname,$lastname,$addres,$phone,$balance];
                $stmt = $dbh -> prepare($insert);
                $stmt -> execute($params);
                       

// then use getlist.php file.
include "getlist.php";
?>
