<?php
require_once "errors.php";
require_once "shortcuts/reportsEntriesDateShortcut.php";
require_once "shortcuts/reportQueryFromSales.php";
GLOBAL $today,$dateReportEntry,$connection,$totalPriceOfRawMaterial,$totalAmountPaid;
$today=date('Y-m-d');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <title>ePortal</title>
</head>
<body class="mb-5">

<!--heading-->
<?php require_once "headerTCD.php"; ?>
<!--heading-->

<!--reports-->
<div class="container-fluid p-0">
    <!--nav-->
    <?php require_once "navbarFunctions/navbar_reportsEntries.php";?>
    <!--nav-->

    <!--reports-->
    <div class="row mx-3 justify-content-evenly">

        <!--heading-->
        <h1 class="my-3" style="text-align: center; text-transform: uppercase; font-family: 'Abyssinica SIL'; font-size: 25px;">
            <a href="reports.php" style="text-decoration: none; color: black;">reports</a>
        </h1>
        <!--heading-->

        <!--data-->
        <div class="col-lg-8  border border-secondary bg-light">
            <ul class="nav nav-tabs my-3">
                <li class="nav-item">
                    <button class="nav-link active" aria-current="page">REPORTS</button>
                </li>
            </ul>

            <?php
            require_once "SQL_queries/db_connection.php";
            $queryForRaw="SELECT totalPrice FROM rawmaterial WHERE date='$dateReportEntry'";
            $resultForRaw=mysqli_query($connection,$queryForRaw);
            while ($row = mysqli_fetch_assoc($resultForRaw)){
            $totalPrice=$row['totalPrice'];
            $totalPriceOfRawMaterial+=$totalPrice;
            }

            $queryForSales="SELECT amount_paid FROM sales WHERE date='$dateReportEntry'";
            $resultForSales=mysqli_query($connection,$queryForSales);
            while ($row = mysqli_fetch_assoc($resultForSales)){
                $amountPaid=$row['amount_paid'];
                $totalAmountPaid+=$amountPaid;
            }

            //calculations

            if($totalPriceOfRawMaterial<$totalAmountPaid){
                //profit
                $resultProfit=$totalAmountPaid-$totalPriceOfRawMaterial;

                //if sales or raw material 0 to divide make the variable 1 to avoid error
                if($totalAmountPaid==0){
                    $totalAmountPaid=1;
                }
                if($totalPriceOfRawMaterial==0){
                    $totalPriceOfRawMaterial=1;
                }

                $resultProfit=($resultProfit/$totalAmountPaid)*100;
                $resultProfit=intval($resultProfit);
                ?>
                <p class='text-uppercase my-3 fs-5'>
                    Date : <?php
                    $dateReportEntry=strtotime($dateReportEntry);
                    echo date('d-M-Y',$dateReportEntry);
                    ?>
                </p>
                <p class='text-uppercase my-3 text-success fs-5'>Profit : <?php echo $resultProfit; ?>%</p>
                <div class="progress my-4" style="height: 25px;">
                    <div class="progress-bar bg-success fs-5" role="progressbar" style="width: <?php echo $resultProfit; ?>%;" aria-valuenow="<?php echo $resultProfit; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $resultProfit; ?>%</div>
                </div>

          <?php
            }else if($totalPriceOfRawMaterial>$totalAmountPaid){
                //loss
                $resultLoss=$totalPriceOfRawMaterial-$totalAmountPaid;

                //if sales or raw material 0 to divide make the variable 1 to avoid error
                if($totalAmountPaid==0){
                    $totalAmountPaid=1;
                }
                if($totalPriceOfRawMaterial==0){
                    $totalPriceOfRawMaterial=1;
                }

                $resultLoss=($resultLoss/$totalPriceOfRawMaterial)*100;
                $resultLoss=intval($resultLoss);
                echo $resultLoss;?>
                <p class='text-uppercase my-3 fs-5'>
                    Date : <?php
                    $dateReportEntry=strtotime($dateReportEntry);
                    echo date('d-M-Y',$dateReportEntry);
                    ?>
                </p>
                <p class='text-uppercase my-3 text-danger fs-5'>Loss : <?php echo $resultLoss; ?>%</p>
                <div class="progress my-4" style="height: 25px;">
                    <div class="progress-bar bg-danger fs-5" role="progressbar" style="width: <?php echo $resultLoss; ?>%;" aria-valuenow="<?php echo $resultLoss; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $resultLoss; ?>%</div>
                </div>

                <?php

            }else{ //neutral ?>
                <p class='text-uppercase my-3 fs-5'>
                    Date : <?php
                    $dateReportEntry=strtotime($dateReportEntry);
                    echo date('d-M-Y',$dateReportEntry);
                    ?>
                </p>
                <p class='text-uppercase my-2 text-secondary fs-5'>No Profit/loss</p>
                <div class="progress my-3" style="height: 25px;">
                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
           <?php } ?>
        </div>
        <!--data-->

    </div>
    <!--reports-->

</div>
<!--reports-->


<!--footer-->
<?php require_once "footerTCD.php" ?>
<!--footer-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
