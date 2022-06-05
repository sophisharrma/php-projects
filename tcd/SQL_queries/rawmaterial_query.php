<?php
 if(isset($_POST['add_values'])){
     $date = date('Y-m-d');
     $select_items = $_POST['select_items'];
     $select_amount = $_POST['select_amount'];
     $select_price_per_kg = $_POST['select_price_per_kg'];
     $select_total_price = $select_amount * $select_price_per_kg;

     //connection
     global $connection;
     require_once "db_connection.php";



    $query = "INSERT INTO rawmaterial(date,items,amount,price_per_kg,totalPrice) 
             VALUES('$date','$select_items','$select_amount','$select_price_per_kg','$select_total_price')";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("not connected " . mysqli_error($connection));
    }else{
        echo " <script>
              window.location.href='./rawmaterial.php';
            </script>";
    }
 }
