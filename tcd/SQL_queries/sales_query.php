<?php
GLOBAL  $fileName;
if(isset($_POST['submitSales'])){
    //connection
    GLOBAL $connection;
    require_once "db_connection.php";

    $dateSales=date('Y-m-d');
    $titleSales=$_POST['titleSales'];
    $type_of_cakeSales=$_POST['type_of_cake'];
    $flavourSales=$_POST['flavourSales'];
    $priceSales=$_POST['priceSales'];
    $amountSales=$_POST['amountSales'];
    $amount_leftSales=($priceSales-$amountSales);
    $descriptionSales=$_POST['descriptionSales'];
    $values="";

    if(strlen($titleSales)>50){
        echo "<script>
                 alert('Title Should be less than 50 characters');
                 window.location.href='./sales.php';
              </script>";
    }elseif (strlen($descriptionSales)>500){
        echo "<script>
                 alert('Description Should be less than 500 characters');
                 window.location.href='./sales.php';
              </script>";
    }else{
        //query
        foreach ($flavourSales as $i) {
            $values.= ($i." ");
        }

        if(!empty(($_FILES["file"]["name"]))){
            require_once "insertImages.php";
        }

        $query ="INSERT INTO sales(date,title,type_of_cake,flavour,image,price,amount_paid,amount_left,description)
                     VALUES('$dateSales','$titleSales','$type_of_cakeSales','$values',
                     '$fileName','$priceSales','$amountSales','$amount_leftSales','$descriptionSales')";


        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("query,not connected " . mysqli_error($connection));
        }else{
            echo "<script>
            window.location.href='./sales.php';
            </script>";
        }
}
}
