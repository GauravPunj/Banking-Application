
<?php
// This is my original work and it shall not be used anywhere else without my written permission.
// this file gets the entire table from the databse sorted alphabetically at items and creates an array of objects of ListItem and
// outputs the array as JSON encoded
include "connect.php";
include "listitem.php";
/**
 *
 */

$table = "SELECT * FROM accounts Order By balance ASC";
$stmt = $dbh-> prepare($table);
$success = $stmt-> execute();


$list = [];
// if values are found to be present in databse, make array of objects from each record line in the database.
while($row=$stmt->fetch()){
    $listitem = new ListItem($row["firstname"],$row["lastname"],$row["customerid"],$row["addres"],$row["phone"],$row["balance"]);
    array_push($list,$listitem);
}
// encode array named list as JSON
echo json_encode($list);
?>
