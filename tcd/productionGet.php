<?php
require_once "errors.php";
require_once "SQL_queries/production_query.php";
$today=date('Y-m-d');
GLOBAL $connection;
GLOBAL $today,$titleProduction,$type_of_cakeProduction,$itemProduction,$flavourProduction,$descriptionProduction,$fileName;

#if image is not empty execute the insertImages.php
if(!empty(($_FILES["fileProductionGet"]["name"]))){
    $fileDir="uploads/";
    $tmp_name=$_FILES["fileProductionGet"]["tmp_name"];
    $fileName=basename($_FILES["fileProductionGet"]["name"]);
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

<!--production-->
<div class="container-fluid p-0">
    <!--nav-->
    <?php  require_once "navbarFunctions/navbar_production.php"; ?>
    <!--nav-->

    <!--data-->
    <div class="row mx-3 justify-content-evenly">

        <!--heading-->
        <a href="production.php" style="text-decoration: none; color:#131313">
            <h1 class="my-3" style="text-align: center; text-transform: uppercase; font-family: 'Abyssinica SIL'; font-size: 25px;">
                production
            </h1>
        </a>
        <!--heading-->


        <?php
        $getId=$_GET['edit'];
        require_once "SQL_queries/db_connection.php";
        $queryGet="SELECT * FROM production WHERE id='$getId';";
        $resultGet=mysqli_query($connection,$queryGet);
        while ($row=mysqli_fetch_assoc($resultGet)){
            $titleGet=$row['title'];
            $type_of_cakeGet=$row['type_of_cake'];
            $itemsGet=$row['items'];
            $flavoursGet=$row['flavours'];
            $descriptionGet=$row['description'];
            $arrayFlavours=explode(' ',$flavoursGet);
            $arrayItems=explode(' ',$itemsGet);
            if(empty($descriptionGet)){
                $descriptionGet="NULL";
            }

        ?>

        <!--form-->
        <div class="col-lg-8 mb-5 border border-secondary bg-light ">
            <ul class="nav nav-tabs my-3">
                <li class="nav-item">
                    <button class="nav-link active" aria-current="page">EDIT VALUES</button>
                </li>
            </ul>
            <form action="" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input name="titleProductionGet" type="text" class="form-control text-secondary" id="title" placeholder="Title" value="<?php echo $titleGet; ?>"  required>
                </div>

                <div class="mb-3">
                    <label for="typeofcake" class="form-label">Type of Cake</label>
                    <div class="form-check">

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
                        <?php
                        if($type_of_cakeGet=='Customer Order Cake') { ?>
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
                    <label for="items" class="form-label">Items</label>
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
                                <input class="form-check-input" type="checkbox" value="Flour" id="flour" name="itemProductionGet[]"
                                    <?php if(in_array('Flour',$arrayItems)){ ?> checked <?php } ?> >
                                <label class="form-check-label my-1" for="flour">
                                    Flour
                                </label> <br>
                                <input class="form-check-input" type="checkbox" value="Sugar" id="sugar" name="itemProductionGet[]"
                                    <?php if(in_array('Sugar',$arrayItems)){ ?> checked <?php } ?>>
                                <label class="form-check-label my-1" for="sugar">
                                    Sugar
                                </label> <br>
                                <input class="form-check-input" type="checkbox" value="Butter/Fat" id="fat" name="itemProductionGet[]"
                                    <?php if(in_array('Butter/Fat',$arrayItems)){ ?> checked <?php } ?>>
                                <label class="form-check-label my-1" for="fat">
                                    Butter/Fat
                                </label> <br>
                                <input class="form-check-input" type="checkbox" value="Salt" id="salt" name="itemProductionGet[]"
                                    <?php if(in_array('Salt',$arrayItems)){ ?> checked <?php } ?>>
                                <label class="form-check-label my-1" for="salt">
                                    Salt
                                </label> <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Milk" id="milk" name="itemProductionGet[]"
                                    <?php if(in_array('Milk',$arrayItems)){ ?> checked <?php } ?>>
                                <label class="form-check-label my-1" for="milk">
                                    Milk
                                </label> <br>
                                <input class="form-check-input" type="checkbox" value="BakingSoda" id="baking_soda" name="itemProductionGet[]"
                                    <?php if(in_array('BakingSoda',$arrayItems)){ ?> checked <?php } ?>>
                                <label class="form-check-label my-1" for="baking_soda">
                                    Baking Soda
                                </label> <br>
                                <input class="form-check-input" type="checkbox" value="Other" id="other" name="itemProductionGet[]"
                                    <?php if(in_array('Other',$arrayItems)){ ?> checked <?php } ?>>
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
                    <label for="flavour" class="form-label">Flavour</label>
                    <div class="form-check">

                        <input class="form-check-input my-2" type="checkbox"  id="selectAllFlavours">
                        <label class="form-check-label my-2 text-uppercase" for="selectAllFlavours">
                            Select All
                        </label>
                        <br>

                        <input class="form-check-input " type="checkbox" value="Pineapple" id="pineapple" name="flavourProductionGet[]"
                            <?php if(in_array('Pineapple',$arrayFlavours)){ ?> checked <?php } ?>>
                        <label class="form-check-label my-1" for="pineapple">
                            Pineapple
                        </label> <br>

                        <input class="form-check-input" type="checkbox" value="Chocolate" id="chocolate" name="flavourProductionGet[]"
                            <?php if(in_array('Chocolate',$arrayFlavours)){ ?> checked <?php } ?>>
                        <label class="form-check-label my-1" for="chocolate">
                            Chocolate
                        </label> <br>

                        <input class="form-check-input" type="checkbox" value="Redvelvet" id="redvelvet" name="flavourProductionGet[]"
                            <?php if(in_array('Redvelvet',$arrayFlavours)){ ?> checked <?php } ?>>
                        <label class="form-check-label my-1" for="redvelvet">
                            Red Velvet
                        </label> <br>

                        <input class="form-check-input" type="checkbox" value="Butterscotch" id="butterscotch" name="flavourProductionGet[]"
                            <?php if(in_array('Butterscotch',$arrayFlavours)){ ?> checked <?php } ?>>
                        <label class="form-check-label my-1" for="butterscotch">
                            Butterscotch
                        </label> <br>

                        <input class="form-check-input" type="checkbox" value="Blueberry" id="blueberry" name="flavourProductionGet[]"
                            <?php if(in_array('Blueberry',$arrayFlavours)){ ?> checked <?php } ?>>
                        <label class="form-check-label my-1" for="blueberry">
                            Blueberry
                        </label> <br>

                        <input class="form-check-input" type="checkbox" value="Other" id="other" name="flavourProductionGet[]"
                            <?php if(in_array('Other',$arrayFlavours)){ ?> checked <?php } ?>>
                        <label class="form-check-label my-1" for="other">
                            Other
                        </label> <br>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">File</label>
                    <div class="input-group mb-3">
                        <input name="fileProductionGet" type="file" class="form-control" id="file" >
                    </div>
                </div>


                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea  name="descriptionProductionGet" class="form-control text-secondary" id="description" rows="4" ><?php echo $descriptionGet;?>
                    </textarea>
                </div>

                <div class="mb-3">
                    <input name="submitProductionGet" type="submit" class="form-control btn btn-primary" value="Update" onclick="return updateConfirm()">
                </div>
            </form>

            <script>
                function updateConfirm(){
                    if(confirm("Sure!! You want to Update This?")){
                        return true;
                    }else{
                        return false;
                    }
                }
            </script>
            <!--editing the data-->
            <?php
            if(isset($_POST['submitProductionGet'])){
                $titleProductionGet=$_POST['titleProductionGet'];
                $type_of_cakeGet=$_POST['type_of_cakeGet'];
                $itemProductionGet=$_POST['itemProductionGet'];
                $flavourProductionGet=$_POST['flavourProductionGet'];
                $descriptionProductionGet=$_POST['descriptionProductionGet'];

                GLOBAL $connection;
                require_once "SQL_queries/db_connection.php";

                $item_valuesGet="";
                $flavours_valueGet="";
                foreach($itemProductionGet as $item){
                    $item_valuesGet.= ($item . " ");
                }
                foreach ($flavourProductionGet as $flavour) {
                    $flavours_valueGet.= ($flavour." ");
                }



                $queryEdit="UPDATE production
                 SET title='$titleProductionGet',
                     image='$fileName',
                     type_of_cake='$type_of_cakeGet',
                     items='$item_valuesGet',
                     flavours='$flavours_valueGet',
                     description='$descriptionProductionGet'
                 WHERE id='$getId'";
                $resultEdit=mysqli_query($connection,$queryEdit);
                if(!$resultEdit){
                    die("not edited". mysqli_error($connection));
                }
                ?>
                <script>
                    window.location.href="production.php";
                </script>

            <?php
            }
            ?>
            <!--editing the data-->

        </div>
        <!--form-->
        <?php
        }
        ?>

    </div>
    <!--data-->
</div>
<!--production-->

<!--footer-->
<?php require_once "footerTCD.php" ?>
<!--footer-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
