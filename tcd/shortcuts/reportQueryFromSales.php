<?php
require_once "errors.php";
$today=date('Y-m-d');
GLOBAL $connection;
GLOBAL $today,$totalPriceSales;

require_once "SQL_queries/db_connection.php";
$query="SELECT * FROM sales WHERE date='$today'";

$result=mysqli_query($connection,$query);
if(!$result){
    die("no".mysqli_error($connection));
}
while ($row=mysqli_fetch_assoc($result)){
    $id=$row['id'];
    $date=$row['date'];
    $date=strtotime($date);
    $date=date('d-M-Y');
    $title=$row['title'];
    $type_of_cake=$row['type_of_cake'];
    $flavour=$row['flavour'];
    $image=$row['image'];
    $price=$row['price'];
    $amount_paid=$row['amount_paid'];
    $amount_left=$row['amount_left'];
    $description=$row['description'];
    $totalPriceSales+=$amount_paid;
    if(empty($description)){
        $description="-";
    }
}
