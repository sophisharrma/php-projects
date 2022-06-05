<?php
require_once "errors.php";
require_once "SQL_queries/sales_query.php";
$today=date('Y-m-d');
GLOBAL $connection;
GLOBAL $today,$totalPriceSales,$fileName;

#if image is not empty execute the insertImages.php
if(!empty(($_FILES["file"]["name"]))){
   require_once "SQL_queries/insertImages.php";
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


        <!--detailed heading-->
        <div class="col-lg-8 mb-1 py-2 px-0 text-secondary fs-5">
            <p>Entries for Specific Date</p>
        </div>
        <!--detailed heading-->

        <!--date-->
        <div class="col-lg-8 border border-secondary bg-light mb-5 py-2">
            <form action="salesEntries.php" method="post">
                <div class="mb-3">
                    <label for="date" class="form-label text-secondary fs-5">Date</label>
                    <input name="salesEntriesDate" type="date" class="form-control" id="date" required>
                </div>
                <div class="mb-3">
                    <input type="submit" class="form-control btn btn-primary" value="View" name="salesEntriesSubmit">
                </div>
            </form>
            <?php require_once "shortcuts/salesEntriesDateShortcut.php";?>
        </div>
        <!--date-->

        <!--detailed heading-->
        <div class="col-lg-8 mb-1 py-2 px-0 text-secondary fs-5">
            <p>Today's Entries</p>
        </div>
        <!--detailed heading-->

        <!--form-->
        <div class="col-lg-8 mb-5 border border-secondary bg-light ">
            <ul class="nav nav-tabs my-3">
                <li class="nav-item">
                    <button class="nav-link active" aria-current="page">SALES</button>
                </li>
            </ul>
            <form action="sales.php" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input name="titleSales" type="text" class="form-control" id="title" placeholder="Title" required>
                </div>

                <div class="mb-3">
                    <label for="typeofcake" class="form-label">Type of Cake</label>
                    <div class="form-check">
                        <input name="type_of_cake" value="Shop Cake" class="form-check-input" type="radio" id="typeofcake" required>
                        <label class="form-check-label mt-1" for="typeofcake" >
                            Shop Cake
                        </label>
                        <br>
                        <input name="type_of_cake" value="Customer Cake" class="form-check-input" type="radio" id="typeofcake" required>
                        <label class="form-check-label mt-1" for="typeofcake">
                            Customer Order Cake
                        </label>
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

                        <input class="form-check-input " type="checkbox" value="Pineapple" id="pineapple" name="flavourSales[]">
                        <label class="form-check-label my-1" for="pineapple">
                            Pineapple
                        </label>
                     <br>

                      <input class="form-check-input" type="checkbox" value="Chocolate" id="chocolate" name="flavourSales[]">
                      <label class="form-check-label my-1" for="chocolate">
                          Chocolate
                      </label> <br>

                      <input class="form-check-input" type="checkbox" value="Redvelvet" id="redvelvet" name="flavourSales[]">
                      <label class="form-check-label my-1" for="redvelvet">
                          Red Velvet
                      </label> <br>

                       <input class="form-check-input" type="checkbox" value="Butterscotch" id="butterscotch" name="flavourSales[]">
                        <label class="form-check-label my-1" for="butterscotch">
                           Butterscotch
                        </label> <br>

                        <input class="form-check-input" type="checkbox" value="Blueberry" id="blueberry" name="flavourSales[]">
                        <label class="form-check-label my-1" for="blueberry">
                            Blueberry
                        </label> <br>

                        <input class="form-check-input" type="checkbox" value="Other" id="other" name="flavourSales[]">
                        <label class="form-check-label my-1" for="other">
                            Other
                        </label> <br>
                  </div>
                </div>


                <div class="mb-3">
                    <label for="file" class="form-label">File</label>
                    <div class="input-group mb-3">
                        <input name="file" type="file" class="form-control" id="file">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input name="priceSales" type="number" class="form-control" id="price" placeholder="Price of the cake" min="0" max="10000" required>
                </div>

                <div class="mb-3">
                    <label for="amount_by_customer" class="form-label">Amount Paid </label>
                    <input name="amountSales" type="number"  class="form-control" id="amount_by_customer" placeholder="Amount Paid by Customer" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="descriptionSales" class="form-control" id="description" rows="4"></textarea>
                </div>

                <div class="mb-3">
                    <input name="submitSales" type="submit" class="form-control btn btn-primary" value="Add">
                </div>
            </form>


            <h3 class="display-6 fs-5 text-uppercase text-center">Entries</h3>

                <!-- Accordion it will keep increasing with every form entry-->
                <div class="accordion  accordion-flush " id="accordionFlushExample">
                    <?php
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
                    $image="uploads/".$row['image'];
                    $price=$row['price'];
                    $amount_paid=$row['amount_paid'];
                    $amount_left=$row['amount_left'];
                    $description=$row['description'];
                    $totalPriceSales+=$amount_paid;
                    $rupees="Rs";


                    if(empty($description)){
                        $description="-";
                    }
                    ?>

                    <div class="accordion-item  border border-secondary my-2 ">
                        <h2 class="accordion-header " id="flush-headingOne<?php echo $id; ?>">
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $id; ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                                <?php echo $title; ?>
                            </button>
                        </h2>
                        <div id="collapse<?php echo $id ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne<?php echo $id; ?>" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="row ">
                                        <div class="col-12">
                                            <?php
                                                echo "<img class='img-fluid mb-3' style='width: 100%' src='$image' alt='$fileName'>";
                                            ?>
                                        </div>
                                    </div>

                                    <div class="row my-1">
                                        <div class="col-6 text-uppercase ">Date</div>
                                        <div class="col-6 ">
                                            <p style="word-wrap: break-word;">
                                                <?php echo $date; ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row my-1">
                                        <div class="col-6  text-uppercase">type </div>
                                        <div class="col-6 ">
                                            <p style="word-wrap: break-word;">
                                                <?php echo $type_of_cake; ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row my-1">
                                        <div class="col-6  text-uppercase">flavour</div>
                                        <div class="col-6 ">
                                            <p style="word-wrap: break-word;">
                                                <?php echo $flavour; ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row my-1">
                                        <div class="col-6  text-uppercase">price</div>
                                        <div class="col-6 ">
                                            <p style="word-wrap: break-word;">
                                                <?php echo $rupees." ". $price ; ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row my-1">
                                        <div class="col-6  text-uppercase">amount paid</div>
                                        <div class="col-6 ">
                                            <p style="word-wrap: break-word;">
                                                <?php echo $rupees." ". $amount_paid ; ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row my-1">
                                        <div class="col-6  text-uppercase">amount left</div>
                                        <div class="col-6 ">
                                            <p style="word-wrap: break-word;">
                                                <?php echo $rupees." ".$amount_left; ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row my-1 ">
                                        <div class="col-6 text-uppercase">Description</div>
                                        <div class="col-6 ">
                                            <p style="word-wrap: break-word;">
                                                <?php echo $description; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-6 text-start">
                                        <a href="sales.php?delete=<?php echo $id; ?>" class="text-uppercase btn btn-danger btn-sm fs-6"
                                        onclick="return deleteConfirm()" >Delete</a>
                                    </div>
                                    <div class="col-6 text-end">
                                        <a href="salesGet.php?edit=<?php echo $id; ?>" class="text-uppercase btn btn-primary btn-sm  fs-6">Edit</a>
                                    </div>
                                </div>

                                <script>
                                    function deleteConfirm(){
                                        if(confirm("Sure!! You Want to Delete this?")){
                                            return true;
                                        }else{
                                            return false;
                                        }
                                    }
                                </script>


                                            <!--delete the saved data-->
                                            <?php
                                            if(isset($_GET['delete'])){
                                            $idGet=$_GET['delete'];
                                            $queryGet="DELETE FROM sales WHERE id= '$idGet'";
                                            $resultGet=mysqli_query($connection,$queryGet);
                                            if(!$resultGet){
                                                die("not deleted" . mysqli_error($connection));
                                            }?>
                                                <script> window.location.href="sales.php";</script>
                                              <?php } ?>
                                             <!--delete the saved data-->




                            </div>
                        </div>
                    </div>
                    <?php  } ?>
                </div>
                <!--Accordion-->



            <!--for count the total entries-->
            <?php
            $count=mysqli_num_rows($result);
            ?>
            <!--for count the total entries-->

            <!--total sales-->
            <div class="col-lg-8 display-6 fs-6 p-3 text-uppercase bg-light ">
                <p>Total Sale = <?php echo $count;?></p>
                <p>Total price = <?php echo $totalPriceSales;
                if($totalPriceSales!=0){
                    echo "<span style='text-transform: none;'> Rs</span>";
                }else{
                    echo 0;
                }
                ?>
                </p>
            </div>
            <!--total sales-->
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
