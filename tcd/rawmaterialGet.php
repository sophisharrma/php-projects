<?php
session_start();
require_once "errors.php";
/*require_once "SQL_queries/rawmaterial_query.php";*/
$today=date('Y-m-d');
GLOBAL $connection;
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
<?php
require_once "headerTCD.php";
?>
<!--heading-->

<!--main content-->
<div class="container-fluid p-0">
    <!--nav-->
    <?php require_once "navbarFunctions/navbar_rawmaterial.php";?>
    <!--nav-->

    <!--raw material-->
    <div class="row mx-3 justify-content-evenly">

        <!--heading-->
        <a href="rawmaterial.php" style="text-decoration: none; color: #131313;">
            <h1 class="my-3" style="text-align: center; text-transform: uppercase; font-family: 'Abyssinica SIL'; font-size: 25px;">
                raw material
            </h1>
        </a>
        <!--heading-->




        <div class="col-lg-8 border border-secondary mb-5 py-2">
            <ul class="nav nav-tabs my-3">
                <li class="nav-item">
                    <button class="nav-link active" aria-current="page">EDIT VALUES</button>
                </li>
            </ul>
            <form action="" method="post">
                <?php
                require_once "SQL_queries/db_connection.php";
                $getId=$_GET['edit'];
                $queryGet="SELECT * FROM rawmaterial WHERE id ='$getId';";
                $resultGet=mysqli_query($connection,$queryGet);
                while ($row=mysqli_fetch_assoc($resultGet)){
                    $getSelectItems=$row['items'];
                    $getAmount=$row['amount'];
                    $getPrice=$row['price_per_kg'];
                ?>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="amount" class="form-label m-0 p-1">Items</label>
                            <select class="form-select" aria-label="Default select example" name="select_itemsGet" required>

                                <!--this is to solve the duplicity of items-->
                                <?php
                                if($getSelectItems=="Sugar") {
                                    echo "<option value='Sugar' selected>Sugar</option>";

                                    echo "<option value='Flour'> Flour</option>";
                                    echo "<option value='Butter'> Butter</option>";
                                    echo "<option value='Baking Soda'> Baking Soda</option>";
                                    echo "<option value='Other'> Other</option>";
                                }
                                else if($getSelectItems=="Flour") {
                                    echo "<option value='Sugar'>Sugar</option>";
                                    echo "<option value='Flour' selected> Flour</option>";
                                    echo "<option value='Butter'> Butter</option>";
                                    echo "<option value='Baking Soda'> Baking Soda</option>";
                                    echo "<option value='Other'> Other</option>";
                                }
                                else if($getSelectItems=="Butter") {
                                    echo "<option value='Sugar'>Sugar</option>";
                                    echo "<option value='Flour' > Flour</option>";
                                    echo "<option value='Butter' selected> Butter</option>";
                                    echo "<option value='Baking Soda'> Baking Soda</option>";
                                    echo "<option value='Other'> Other</option>";
                                }
                                else if($getSelectItems=="Baking Soda") {
                                    echo "<option value='Sugar'>Sugar</option>";
                                    echo "<option value='Flour' > Flour</option>";
                                    echo "<option value='Butter'> Butter</option>";
                                    echo "<option value='Baking Soda' selected> Baking Soda</option>";
                                    echo "<option value='Other'> Other</option>";
                                }
                                else{
                                    echo "<option value='Sugar'>Sugar</option>";
                                    echo "<option value='Flour' > Flour</option>";
                                    echo "<option value='Butter'> Butter</option>";
                                    echo "<option value='Baking Soda' > Baking Soda</option>";
                                    echo "<option value='Other' selected> Other</option>";
                                }
                                ?>
                                <!--this is to solve the duplicity of items-->

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="amount" class="form-label m-0 p-1">Amount (Kg)</label>
                            <input type="number" class="form-control" id="amount" name="select_amountGet" value="<?php echo $getAmount; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="price_per_kg" class="form-label m-0 p-1">Price/Kg</label>
                            <input type="number" class="form-control" id="price_per_kg" name="select_price_per_kgGet" value="<?php echo $getPrice; ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mt-4 mb-2">
                            <input name="add_valuesGet" type="submit" class="form-control btn btn-primary fs-6" value="Update" onclick="return updateConfirm()">
                        </div>
                    </div>
                </div>

               <?php
                 }
                 ?>

                <script>
                function updateConfirm(){
                    if(confirm("Sure!! You want to Update This?")){
                        return true;
                    }else{
                        return false;
                    }
                }
                </script>

                <?php
                if(isset($_POST['add_valuesGet'])){

                    $select_itemsGet = $_POST['select_itemsGet'];
                    $select_amountGet = $_POST['select_amountGet'];
                    $select_price_per_kgGet = $_POST['select_price_per_kgGet'];
                    $select_total_price = $select_amountGet * $select_price_per_kgGet;

                    //connection
                    global $connection;
                    require_once "SQL_queries/db_connection.php";

                    $queryEdit="UPDATE rawmaterial 
                    SET items='$select_itemsGet',
                        amount='$select_amountGet',
                        price_per_kg='$select_price_per_kgGet',
                        totalPrice='$select_total_price'
                    WHERE id ='$getId'";

                    $resultEdit=mysqli_query($connection,$queryEdit);
                    if(!$resultEdit){
                        die("not updated". mysqli_error($connection));
                    }
                    ?>
                    <script>
                        window.location.href="rawmaterial.php";
                    </script>

                <?php
                }
                ?>
            </form>
        </div>


    </div>
    <!--raw material-->


</div>
<!--main content-->

<!--footer-->
<?php require_once "footerTCD.php" ?>
<!--footer-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
