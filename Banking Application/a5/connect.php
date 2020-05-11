<?php
/**
 * This is my original work and it shall not be used anywhere else without my written permission.
 * This connect.php will connect to the database named 000794079, when called. if connection fails, error couldnt connect shall be displayed.
 */
try {
    $dbh = new PDO(
        "mysql:host=localhost;dbname=000794079",
        "000794079",
        "19890212"
    );
} catch (Exception $e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}
?>
