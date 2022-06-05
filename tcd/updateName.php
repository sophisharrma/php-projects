<?php
require_once "errors.php";
require_once "SQL_queries/db_connection.php";
GLOBAL $connection,$getId,$updateNameID;

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
    <?php require_once "navbarFunctions/navbar_myAccount.php";?>
    <!--nav-->

    <!--data-->
    <div class="row mx-3 justify-content-evenly">

        <!--heading-->
        <a href="myAccount.php" style="text-decoration: none; color:#131313">
            <h1 class="my-3" style="text-align: center; text-transform: uppercase; font-family: 'Abyssinica SIL'; font-size: 25px;">
                My Accounts
            </h1>
        </a>
        <!--heading-->

        <?php
        if(isset($_GET['updateName'])){
            $updateNameID=$_GET['updateName'];
            $queryGet="SELECT name FROM user_details WHERE id='$updateNameID'";
            $resultGet=mysqli_query($connection,$queryGet);
            $row=mysqli_fetch_assoc($resultGet);
            $alreadyName=$row['name'];
            if(!$resultGet){
                die("query not get".mysqli_error($connection));
            }
        }
        ?>

        <!--Profile-->
        <div class="col-lg-8 border border-secondary bg-light mb-3 py-2">
            <form action="" method="post">
               <div class="form-group">
                   <div class="mb-3 fs-5">
                       <label for="updateName" class="mb-2">Update Name</label>
                       <input type="text" class="form-control" id="updateName" name="updateName" value="<?php echo $alreadyName; ?>" required>
                   </div>

                   <div class="mb-3">
                       <input type="submit" class="form-control btn btn-primary" name="updateNameSubmit">
                   </div>
               </div>
                <?php

                if(isset($_POST['updateNameSubmit'])){
                    $newUpdatedName=$_POST['updateName'];
                    GLOBAL $connection;
                    require_once "SQL_queries/db_connection.php";
                           $queryUpdateName="UPDATE user_details
                           SET name='$newUpdatedName'
                           WHERE id='$updateNameID'";
                           $resultUpdateName=mysqli_query($connection,$queryUpdateName);

                           if(!$resultUpdateName){
                               die("not queried".mysqli_error($connection));
                           }else{
                               $_SESSION['name']=$newUpdatedName;
                               echo "<script>
                                  window.location.href='myAccount.php';
                                  </script>";
                           }




                }
                ?>


            </form>
        </div>
    <!--data-->

    </div>
<!--reports-->
</div>

<!--footer-->
<?php require_once "footerTCD.php" ?>
<!--footer-->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
