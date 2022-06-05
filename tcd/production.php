 <?php
require_once "errors.php";
require_once "SQL_queries/production_query.php";
$today=date('Y-m-d');
GLOBAL $connection;
GLOBAL $today,$fileName,$soldStatus;

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

<!--production-->
<div class="container-fluid p-0">
    <!--nav-->
    <?php  require_once "navbarFunctions/navbar_production.php"; ?>
    <!--nav-->

    <!--form-->
    <div class="row mx-3 justify-content-evenly">

        <!--heading-->
        <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style="text-decoration: none; color:#131313">
            <h1 class="my-3" style="text-align: center; text-transform: uppercase; font-family: 'Abyssinica SIL'; font-size: 25px;">
                production
            </h1>
        </a>
        <!--heading-->

        <!--detailed heading-->
        <div class="col-lg-8 mb-1 py-2 px-0 text-secondary fs-5">
            <p>Entries for Specific Date</p>
        </div>
        <!--detailed heading-->

        <!--date-->
        <div class="col-lg-8 border border-secondary bg-light mb-5 py-2">
            <form action="productionEntries.php" method="post">
                <div class="mb-2">
                    <label for="date" class="form-label text-secondary fs-5">Date</label>
                    <input type="date" name="productionEntriesDate" class="form-control " id="date" required>
                </div>
                <div class="mb-3">
                    <input type="submit" name="productionEntriesSubmit" class="form-control btn btn-primary" value="View">
                </div>
            </form>
            <?php require_once "shortcuts/productionEntriesDateShortcut.php"; ?>
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
                    <button class="nav-link active" aria-current="page">PRODUCTION</button>
                </li>
            </ul>
            <form action="production.php" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input name="titleProduction" type="text" class="form-control" id="title" placeholder="Title" required>
                </div>

                <div class="mb-3">
                    <label for="typeofcake" class="form-label">Type of Cake</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type_of_cake" value="Shop Cake" id="typeofcake" required>
                        <label class="form-check-label mt-1" for="typeofcake">
                            Shop Cake
                        </label> <br>
                        <input class="form-check-input" type="radio" name="type_of_cake" value="Customer Order Cake" id="typeofcake" required>
                        <label class="form-check-label mt-1" for="typeofcake">
                            Customer Order Cake
                        </label>
                    </div>
                </div>
                <!--select all items-->
                <script>
                    $(document) .ready(function(){
                    $("#selectAllItems").click(function (){
                    $("#flour, #sugar,#fat,#salt,#milk,#baking_soda").prop('checked',this.checked);
                    });
                        });
                </script>
                <!--select all items-->
                <div class="row">
                    <label for="items" class="form-label" >Items</label>
                    <div class="col-12">
                        <div class="mb-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"  id="selectAllItems">
                                <label class="form-check-label my-1 text-uppercase" for="selectAllItems">
                                    Select All
                                </label>
                            </div>
                        </div>
                    </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Flour" id="flour" name="itemProduction[]">
                                    <label class="form-check-label my-1" for="flour">
                                        Flour
                                    </label> <br>
                                    <input class="form-check-input" type="checkbox" value="Sugar" id="sugar" name="itemProduction[]">
                                    <label class="form-check-label my-1" for="sugar">
                                        Sugar
                                    </label> <br>
                                    <input class="form-check-input" type="checkbox" value="Butter/Fat" id="fat" name="itemProduction[]">
                                    <label class="form-check-label my-1" for="fat">
                                        Butter/Fat
                                    </label> <br>
                                    <input class="form-check-input" type="checkbox" value="Salt" id="salt" name="itemProduction[]">
                                    <label class="form-check-label my-1" for="salt">
                                        Salt
                                    </label> <br>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Milk" id="milk" name="itemProduction[]">
                                    <label class="form-check-label my-1" for="milk">
                                        Milk
                                    </label> <br>
                                    <input class="form-check-input" type="checkbox" value="BakingSoda" id="baking_soda" name="itemProduction[]">
                                    <label class="form-check-label my-1" for="baking_soda">
                                        Baking Soda
                                    </label> <br>
                                    <input class="form-check-input" type="checkbox" value="Other" id="other" name="itemProduction[]">
                                    <label class="form-check-label my-1" for="other">
                                        Other
                                    </label> <br>
                                </div>
                            </div>
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
                    <label for="flavour" class="form-label">Flavours</label>
                    <div class="form-check">

                        <input class="form-check-input my-2" type="checkbox"  id="selectAllFlavours">
                        <label class="form-check-label my-2 text-uppercase" for="selectAllFlavours">
                           Select All
                        </label>
                        <br>

                        <input class="form-check-input " type="checkbox" value="Pineapple" id="pineapple" name="flavourProduction[]">
                        <label class="form-check-label my-1" for="pineapple">
                            Pineapple
                        </label>
                        <br>

                        <input class="form-check-input" type="checkbox" value="Chocolate" id="chocolate" name="flavourProduction[]">
                        <label class="form-check-label my-1" for="chocolate">
                            Chocolate
                        </label> <br>

                        <input class="form-check-input" type="checkbox" value="Redvelvet" id="redvelvet" name="flavourProduction[]">
                        <label class="form-check-label my-1" for="redvelvet">
                            Red Velvet
                        </label> <br>

                        <input class="form-check-input" type="checkbox" value="Butterscotch" id="butterscotch" name="flavourProduction[]">
                        <label class="form-check-label my-1" for="butterscotch">
                            Butterscotch
                        </label> <br>

                        <input class="form-check-input" type="checkbox" value="Blueberry" id="blueberry" name="flavourProduction[]">
                        <label class="form-check-label my-1" for="blueberry">
                            Blueberry
                        </label> <br>

                        <input class="form-check-input" type="checkbox" value="Other" id="other" name="flavourProduction[]">
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
                    <label for="description" class="form-label">Description</label>
                    <textarea name="descriptionProduction" class="form-control" id="description" rows="4"></textarea>
                </div>

                <div class="mb-3">
                    <input name="submitProduction" type="submit" class="form-control btn btn-primary" value="Add">
                </div>
            </form>

            <h3 class="display-6 fs-5 text-uppercase text-center">Entries</h3>

            <!--Accordion it will keep increasing with every form entry-->
                <div class="accordion accordion-flush " id="accordionFlushExample">
                    <?php
                    require_once "SQL_queries/db_connection.php";
                    $query="SELECT * FROM production WHERE date='$today'";
                    $result=mysqli_query($connection,$query);
                    while ($row = mysqli_fetch_assoc($result)){
                    $id=$row['id'];
                    $date=$row['date'];
                    $date=strtotime($date);
                    $date=date('d-M-Y',$date);
                    $title=$row['title'];
                    $type_of_cake=$row['type_of_cake'];
                    $items=$row['items'];
                    $flavours=$row['flavours'];
                    $image="uploads/".$row['image'];
                    $description=$row['description'];
                    if(empty($description)){
                        $description="-";
                    }
                    $soldStatus=$row['sold_unsold'];

                    ?>
                     <div class="accordion-item border border-secondary my-2">
                        <h2 class="accordion-header " id="flush-heading"  >
                            <button class="accordion-button collapsed text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne<?php echo $id; ?>" aria-expanded="false" aria-controls="flush-collapseOne<?php echo $id; ?>">
                                    <div class="col-6 text-start"><?php echo $title; ?></div>

                                    <div class="col-6 text-end">
                                        <?php
                                        if($soldStatus==='Sold'){
                                           echo "<span class='badge bg-success rounded-pill mx-3'>{$soldStatus}</span>";
                                        }else{
                                            echo "<span class='badge bg-danger rounded-pill mx-3'>{$soldStatus}</span>";
                                        }
                                        ?>
                                    </div>
                            </button>
                        </h2>
                        <div id="flush-collapseOne<?php echo $id; ?>" class="accordion-collapse collapse " aria-labelledby="flush-heading" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body ">
                                <div class="row">

                                    <div class="row ">
                                        <div class="col-12">
                                            <?php
                                            echo "<img class='img-fluid mb-3' style='width: 100%;' src='$image' alt='$fileName'>";
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
                                        <div class="col-6  text-uppercase">items</div>
                                        <div class="col-6 ">
                                            <p style="word-wrap: break-word;">
                                                <?php echo $items; ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row my-1">
                                        <div class="col-6  text-uppercase">flavours</div>
                                        <div class="col-6 ">
                                            <p style="word-wrap: break-word;">
                                                <?php echo $flavours; ?>
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
                                <div class="row mt-3">
                                    <div class="col-4 text-start">
                                        <a href="production.php?delete=<?php echo $id; ?>" class="text-uppercase  fs-6 btn btn-danger btn-sm" onclick="return deleteConfirm()">Delete</a>
                                    </div>

                                    <div class="col-4 text-center">
                                            <?php
                                            if($soldStatus==='Unsold'){?>
                                                <a href="production.php?status=Sold&id=<?php echo $id; ?>" class="text-uppercase  fs-6 btn btn-success btn-sm">mark as sold</a>
                                           <?php } else
                                           {?>
                                               <a href="production.php?status=Unsold&id=<?php echo $id; ?>" class="text-uppercase  fs-6 btn btn-danger btn-sm">mark as unsold</a>
                                            <?php }
                                            ?>

                                        <?php
                                        if(isset($_GET['status'])){
                                            $status=$_GET['status'];
                                            $idSold=$_GET['id'];

                                            require_once "SQL_queries/db_connection.php";
                                            $querySold="UPDATE production 
                                                        SET sold_unsold='$status'
                                                        WHERE id='$idSold'";
                                            $resultSold=mysqli_query($connection,$querySold);
                                            if(!$resultSold){
                                                die("not queried".mysqli_error($connection));
                                            }else{

                                                echo "<script>
                                                        window.location.href='production.php';
                                                  </script>";
                                            }
                                        }
                                        ?>

                                    </div>

                                    <div class="col-4 text-end">
                                        <a href="productionGet.php?edit=<?php echo $id; ?>" class="text-uppercase  fs-6 btn btn-primary btn-sm">Edit</a>
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

                                            <?php
                                            //delete the entries
                                            if(isset($_GET['delete'])){
                                            $idGet=$_GET['delete'];
                                            $queryGet="DELETE FROM production WHERE id= '$idGet'";
                                            $resultGet=mysqli_query($connection,$queryGet);
                                            if(!$resultGet){
                                                die("not deleted" . mysqli_error($connection));
                                            }?>
                                                <script> window.location.href="production.php";</script>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>

                    <?php } ?>
                </div>
            <!--Accordion-->

            <!--to count the total num of entries-->
            <?php
            $count=mysqli_num_rows($result);
            ?>
            <!--to count the total num of entries-->

            <!--total sales-->
            <div class="col-lg-8 py-3 display-6 fs-6 px-1 text-uppercase bg-light ">
                Total Production = <?php echo $count; ?>
            </div>
            <!--total sales-->
        </div>
        </div>
    <!--form-->
</div>
<!--production-->

<!--footer-->
<?php require_once "footerTCD.php" ?>
<!--footer-->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
