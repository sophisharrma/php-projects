<?php
require_once "errors.php";
$today=date('Y-m-d');
GLOBAL $connection;
GLOBAL $today , $total_price_of_all_items;

require_once "SQL_queries/db_connection.php";
$query = "SELECT * FROM rawmaterial WHERE date ='$today';";
$result = mysqli_query($connection, $query);
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $items = $row['items'];
    $amount = $row['amount'];
    $price_per_kg = $row['price_per_kg'];
    $totalPrice = $row['totalPrice'];
    $total_price_of_all_items += $totalPrice;
}




