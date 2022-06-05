<?php
require_once "errors.php";
require_once "SQL_queries/sales_query.php";
$today=date('Y-m-d');
GLOBAL $connection;
GLOBAL $today,$totalPriceSales,$fileName;

#if image is not empty execute the insertImages.php
if(!empty(($_FILES["imageSalesGet"]["name"]))){
    $fileDir="uploads/";
    $tmp_name=$_FILES["imageSalesGet"]["tmp_name"];
    $fileName=basename($_FILES["imageSalesGet"]["name"]);
    $fileExt=pathinfo($fileName,PATHINFO_EXTENSION);
    $filePath=$fileDir.$fileName;
    $allowedArray=array('jpeg','jpg','png');
    if(in_array($fileExt,$allowedArray)){
        move_uploaded_file($tmp_name,$filePath);
    }

}

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

<!--jquery needed to select all checkboxes-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!--jquery needed to select all checkboxes-->

<!--heading-->
<?php require_once "headerTCD.php"; ?>
<!--heading-->

<div class="container-fluid p-0">
    <!--nav-->
    <?php require_once "navbarFunctions/navbar_sales.php";?>
    <!--nav-->

    <!--sales-->
    <div class="row mx-3 justify-content-evenly">

        <!-- heading sales-->
        <a href="sales.php" style="text-decoration: none; color:#131313">
            <h1 class="my-3" style="text-align: center; text-transform: uppercase; font-family: 'Abyssinica SIL'; font-size: 25px;">
                sales
            </h1>
        </a>
        <!-- heading sales-->



        <!--form-->
        <div class="col-lg-8 mb-5 border border-secondary bg-light ">
            <ul class="nav nav-tabs my-3">
                <li class="nav-item">
                    <button class="nav-link active" aria-current="page">SALES</button>
                </li>
            </ul>

            <?php
            #to input the already selected values in the form
            $getId=$_GET['edit'];
            require_once "SQL_queries/db_connection.php";
            $queryGet="SELECT * FROM sales WHERE id='$getId';";
            $resultGet=mysqli_query($connection,$queryGet);
            while ($row=mysqli_fetch_assoc($resultGet)){
                $titleGet=$row['title'];
                $type_of_cakeGet=$row['type_of_cake'];
                $flavourGet=$row['flavour'];
                $priceGet=$row['price'];
                $amount_paidGet=$row['amount_paid'];
                $descriptionGet=$row['description'];
                $arrayFlavours=explode(' ',$flavourGet);

            ?>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input name="titleSalesGet" type="text" class="form-control text-secondary" id="title"  value="<?php echo $titleGet; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="typeofcake" class="form-label">Type of Cake</label>
                    <div class="form-check">
                        <?php
                       if($type_of_cakeGet=='Customer Cake') { ?>
                            <input name='type_of_cakeGet' value='Shop Cake' class='form-check-input' type='radio' id='typeofcake' required>
                            <label class='form-check-label mt-1' for='typeofcake' >
                                Shop Cake
                            </label>

                            <br>
                            <input name='type_of_cakeGet' value='Customer Cake' checked class='form-check-input' type='radio' id='typeofcake' required>
                            <label class='form-check-label mt-1' for='typeofcake'>
                                Customer Order Cake
                            </label>
                        <?php
                        }
                        ?>
                        <?php
                        if($type_of_cakeGet=='Shop Cake') { ?>
                            <input name='type_of_cakeGet' value='Shop Cake' checked class='form-check-input' type='radio' id='typeofcake' required>
                            <label class='form-check-label mt-1' for='typeofcake' >
                                Shop Cake
                            </label>

                            <br>
                            <input name='type_of_cakeGet' value='Customer Cake'  class='form-check-input' type='radio' id='typeofcake' required>
                            <label class='form-check-label mt-1' for='typeofcake'>
                                Customer Order Cake
                            </label>
                            <?php
                        }
                        ?>


                    </div>
                </div>

                <!--select all flavours-->
                <script>
                    $(document) .ready(function(){
                        $("#selectAllFlavours").click(function (){
                            $("#pineapple, #chocolate,#redvelvet,#butterscotch,#blueberry").prop('checked',this.checked);
                        });
                    });
                </script>
                <!--select all flavours-->

                <div class="mb-3">
                    <label for="flavour" class="form-label">Flavour</label>
                    <div class="form-check">

                        <input class="form-check-input my-2" type="checkbox"  id="selectAllFlavours">
                        <label class="form-check-label my-2 text-uppercase" for="selectAllFlavours">
                            Select All
                        </label>
                        <br>

                        <input class="form-check-input " type="checkbox" value="Pineapple" id="pineapple" name="flavourSalesGet[]"
                        <?php if(in_array('Pineapple',$arrayFlavours)){ ?> checked <?php } ?> >
                        <label class="form-check-label my-1" for="pineapple">
                            Pineapple
                        </label>
                        <br>

                        <input class="form-check-input" type="checkbox" value="Chocolate" id="chocolate" name="flavourSalesGet[]"
                            <?php if(in_array('Chocolate',$arrayFlavours)){ ?> checked <?php } ?> >
                        <label class="form-check-label my-1" for="chocolate">
                            Chocolate
                        </label> <br>

                        <input class="form-check-input" type="checkbox" value="Redvelvet" id="redvelvet" name="flavourSalesGet[]"
                            <?php if(in_array('Redvelvet',$arrayFlavours)){ ?> checked <?php } ?> >
                        <label class="form-check-label my-1" for="redvelvet">
                            Red Velvet
                        </label> <br>

                        <input class="form-check-input" type="checkbox" value="Butterscotch" id="butterscotch" name="flavourSalesGet[]"
                            <?php if(in_array('Butterscotch',$arrayFlavours)){ ?> checked <?php } ?> >
                        <label class="form-check-label my-1" for="butterscotch">
                            Butterscotch
                        </label> <br>

                        <input class="form-check-input" type="checkbox" value="Blueberry" id="blueberry" name="flavourSalesGet[]"
                            <?php if(in_array('Blueberry',$arrayFlavours)){ ?> checked <?php } ?> >
                        <label class="form-check-label my-1" for="blueberry">
                            Blueberry
                        </label> <br>

                        <input class="form-check-input" type="checkbox" value="Other" id="other" name="flavourSalesGet[]"
                            <?php if(in_array('Other',$arrayFlavours)){ ?> checked <?php } ?> >
                        <label class="form-check-label my-1" for="other">
                            Other
                        </label> <br>
                    </div>
                </div>


                <div class="mb-3">
                    <label for="file" class="form-label">File</label>
                    <div class="input-group mb-3">
                        <input name="imageSalesGet" type="file" class="form-control" id="file">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input name="priceSalesGet" type="number" class="form-control text-secondary" id="price"  min="0" max="10000" value="<?php echo $priceGet; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="amount_by_customer" class="form-label">Amount Paid </label>
                    <input name="amountSalesGet" type="number"  class="form-control text-secondary" id="amount_by_customer" value="<?php echo $amount_paidGet ?>" required>
                </div>


                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="descriptionSalesGet" class="form-control text-secondary" id="description" rows="4"><?php echo $descriptionGet; ?></textarea>
                </div>

                <div class="mb-3">
                    <input name="submitSalesGet" type="submit" class="form-control btn btn-primary" value="Update" onclick="return updateConfirm()">
                </div>
            </form>
<?php } ?>

            <script>
                function updateConfirm(){
                    if(confirm("Sure!! You want to Update this?")){
                        return true;
                    }else{
                        return false;
                    }
                }
            </script>

            <!--editing the saved data-->
            <?php
            if(isset($_POST['submitSalesGet'])){
            $titleSalesGet=$_POST['titleSalesGet'];
            $type_of_cakeSalesGet=$_POST['type_of_cakeGet'];
            $flavourSalesGet=$_POST['flavourSalesGet'];
            $priceSalesGet=$_POST['priceSalesGet'];
            $amountSalesGet=$_POST['amountSalesGet'];
            $amount_leftSalesGet=($priceSalesGet-$amountSalesGet);
            $descriptionSalesGet=$_POST['descriptionSalesGet'];
            $valuesGet="";
            //connection
            GLOBAL $connection;
            require_once "SQL_queries/db_connection.php";

            //query
            foreach ($flavourSalesGet as $i) {
                $valuesGet.= ($i." ");
            }

            $queryEdit="UPDATE sales
            SET title='$titleSalesGet',
                type_of_cake='$type_of_cakeSalesGet',
                flavour='$valuesGet',
                price='$priceSalesGet',
                image='$fileName',
                amount_paid='$amountSalesGet',
                amount_left='$amount_leftSalesGet',
                description='$descriptionSalesGet'
            WHERE id = '$getId'   ";

            $resultEdit = mysqli_query($connection, $queryEdit);
            if (!$resultEdit) {
                die("not updates " . mysqli_error($connection));
            }
            ?>
            <script>
                window.location.href="sales.php";
            </script>
            <?php
            }
            ?>
            <!--editing the saved data-->

        </div>
        <!--form-->


    </div>
    <!--sales-->
</div>

<!--footer-->
<?php require_once "footerTCD.php" ?>
<!--footer-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
