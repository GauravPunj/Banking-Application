<?php
/**
 * This php page is opened post clicking submit button. It has connect.php which will make connection to mysql database
 * and verify the user id and password entered by the user. If successful session would be live and a menu option to various
 * functions for bank employee will open eg. to create a new account, update account details, cash transactions etc 
 */
include "connect.php";
 session_start();


// check login information first from database table named login.
$userid = filter_input(INPUT_POST, "userid", FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
$command = "SELECT userid, password from login Where userid = ? and password = ? ";
$stmt = $dbh->prepare($command);
$params = [$userid,$password];
$success = $stmt->execute($params);
// if successful session will be live.
if ($success and $stmt->rowCount() > 0 ){
        echo "Login Successful";
        $_SESSION["userid"] = $userid;
}
// if failed, display failure message to user
else {echo"Login Unsuccessful";

    session_unset();
    session_destroy();
}
$dbh = null;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Example</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
    width: 5in;
    height: 5in;
    border-style: solid;
    border-width: 5px;
    background-image: url("tile.jpg");
    background-repeat: repeat;
    background-size: cover;
    font-family: "Times New Roman", sans-serif;
    font-weight: bold;
    font-size: 18pt;
    }

    a:hover{
        background-color: yellow;
    }
        </style>

</head>

<body>
    <?php
    if (isset($_SESSION["userid"])) {
    ?>
        <h1>Welcome <?= $_SESSION["userid"] ?>!</h1>
        <p>Please click appropriate option for banking transactions?</p>
        <ul>
            <!--List from which user may select appropriate function-->
            <li><a href="create.php">Create New Customer Account</a></li>
            <li><a href="updatemenu.php">Update Customer Account</a></li>
            <li><a href="display.php">Display All Accounts</a></li>
            <li><a href="cash.php">Add/Withdraw Cash</a></li>
            <li><a href="logout.php">logout</a></li>
        </ul>
  
    <?php
} else {
    ?>
        <h1>Login Error! Access denied.</h1>
        <a href="index.html">Try again.</a>
    <?php
}
?>
</body>

</html>