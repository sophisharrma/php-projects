<?php
session_start();
require_once "errors.php";
require_once "SQL_queries/rawmaterial_query.php";
$today=date('Y-m-d');
GLOBAL $connection;
GLOBAL $today,$total_price_of_all_items;
//if not logged in
if(!isset($_SESSION['id'])){
    header("location:login.php");
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <title>ePortal</title>

</head>
<body class="mb-5">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!--heading-->
<?php
require_once "headerTCD.php";
?>
<!--heading-->

<?php

if($_SESSION['modalTimes']==1){?>
<!--welcome modal-->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content " >
            <div class="row m-3 border">
                <div class="col-12 mt-4 text-center fs-4 ">
                    WELCOME <?php echo "<span class='text-uppercase fs-5' style='font-family: utkal'>{$_SESSION['name']}</span>"; ?>
                </div>
                <div class="col-12 my-3 text-center">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Let's Go</button>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#myModal").modal('show');
    });
</script>
<!--welcome modal-->
<?php
    $_SESSION['modalTimes']=0;
}
?>


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




        <!--date-->
        <div class="col-lg-8 border border-secondary bg-light mb-3 py-2">

            <div class="col-lg-8 mb-1 py-2 px-0 text-secondary fs-5">
                <a href="rawmaterialSpecificDateEntries.php" class="text-secondary my-2" style="text-decoration: none">Entries for Specific Date</a>
            </div>
            <div class="col-lg-8 mb-1 py-2 px-0 text-secondary fs-5">
                <a href="rawmaterialSpecificMonthEntries.php" class="text-secondary my-2" style="text-decoration: none">Entries for Specific Month</a>
            </div>

        </div>
        <!--date-->

        <!--detailed heading-->
        <div class="col-lg-8 mb-1 py-2 px-0 text-secondary fs-5">
            <p>Today's Entries</p>
        </div>
        <!--detailed heading-->

        <!--entry-->
        <div class="col-lg-8 border border-secondary mb-5 py-2">

            <!--tab-->
            <ul class="nav nav-tabs my-3">
                <li class="nav-item">
                    <button class="nav-link active" aria-current="page">RAW MATERIAL</button>
                </li>
            </ul>
            <!--tab-->

            <!--select values-->
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                        <label for="amount" class="form-label m-0 p-1">Items</label>
                        <select class="form-select" aria-label="Default select example" name="select_items" required>
                            <option selected disabled>-- Select Items --</option>
                            <option value="Sugar">Sugar</option>
                            <option value="Flour">Flour</option>
                            <option value="Butter">Butter</option>
                            <option value="Baking Soda">Baking Soda</option>
                            <option value="Other">Other</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="amount" class="form-label m-0 p-1">Amount (Kg)</label>
                            <input type="number" class="form-control" id="amount" name="select_amount" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="price_per_kg" class="form-label m-0 p-1">Price/Kg</label>
                            <input type="number" class="form-control" id="price_per_kg" name="select_price_per_kg" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mt-4 mb-2">
                            <input name="add_values" type="submit" class="form-control btn btn-primary " value="Add ">
                        </div>
                    </div>
                </div>

            </form>
            <!--select values-->

        </div>
        <!--entry-->

        <!--table-->
        <div class="col-lg-8 border border-secondary mb-5 py-2">
            <div class="col-12 table-responsive">
                <table class="table table-striped table-bordered table-hover">

                    <thead>
                    <tr>
                        <th scope="col">S.NO.</th>
                        <th scope="col">ITEMS</th>
                        <th scope="col">AMOUNT</th>
                        <th scope="col">PRICE/
                                         KG</th>
                        <th scope="col">PRICE/
                                        AMOUNT</th>
                        <th scope="col">DELETE</th>
                        <th scope="col">EDIT</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    require_once "SQL_queries/db_connection.php";
                    $query="SELECT * FROM rawmaterial WHERE date ='$today';";
                    $result=mysqli_query($connection,$query);
                    $i=1;
                    while ($row = mysqli_fetch_assoc($result)){
                        $id=$row['id'];
                        $items=$row['items'];
                        $amount=$row['amount'];
                        $price_per_kg=$row['price_per_kg'];
                        $totalPrice=$row['totalPrice'];
                        $total_price_of_all_items+=$totalPrice;


                        ?>
                        <tr>
                            <td class="px-2 py-3"><?php echo $i++; ?></td>
                            <td class="px-2 py-3"><?php echo $items; ?></td>
                            <td class="px-2 py-3"><?php echo $amount; ?></td>
                            <td class="px-2 py-3"><span style="text-transform: none"> Rs </span><?php echo $price_per_kg; ?></td>
                            <td class="px-2 py-3"><span style="text-transform: none"> Rs </span><?php echo $totalPrice; ?></td>
                            <td class="px-2 py-3">
                                <a style="text-transform: uppercase; color: black; font-weight: normal;" class="text-danger" href='rawmaterial.php?delete=<?php echo $id; ?>' onclick="return deleteConfirm()">
                                    Delete
                                </a>
                            </td>
                            <td class="px-2 py-3">
                                <a style="text-transform: uppercase; color: black; font-weight: normal;" class="text-primary" href="rawmaterialGet.php?edit=<?php echo $id; ?>">
                                    Edit
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>

                    <script>
                        function  deleteConfirm(){
                           $var= (confirm("Sure!! You Want to Delete this?"));
                            if($var){
                                return true;
                            }else{
                                return false;
                            }
                        }
                    </script>


                    <?php
                    //deleting values from table
                    if(isset($_GET['delete'])){
                        $deleteId=$_GET['delete'];
                        $deleteQuery="DELETE FROM rawmaterial WHERE id = '$deleteId'";
                        $deleteResult=mysqli_query($connection,$deleteQuery);
                        if(!$deleteResult){
                            die("not queried" . mysqli_error($connection));
                        }
                        echo '<script> window.location.href = "rawmaterial.php"</script>';

                    } ?>





                </table>
            </div>
            <?php
            $count=mysqli_num_rows($result);
            ?>
            <div class="border border-secondary p-2">
            <p style=" text-transform: uppercase;">total items = <?php echo $count; ?> </p> <br>
            <p style=" text-transform: uppercase;">Total Price =
                <?php
                if(!$total_price_of_all_items==0){

                    if($total_price_of_all_items!=0){
                        echo "<span style='text-transform: none'> Rs </span>". ' ';
                    }
                }else{
                    echo 0;
                }
                echo $total_price_of_all_items ;

                ?>
            </p>
            </div>
        </div>
        <!--table-->
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
