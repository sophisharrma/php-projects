<?php
require_once "errors.php";
require_once "SQL_queries/db_connection.php";
GLOBAL $connection,$getId;

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


        <!--Profile-->
        <div class="col-lg-8 border border-secondary bg-light mb-3 py-2">
            <?php
            #to input the already selected values in the form
            $getId=$_SESSION['id'];

            $queryGet="SELECT * FROM user_details WHERE id='$getId';";
            $resultGet=mysqli_query($connection,$queryGet);
            $row=mysqli_fetch_assoc($resultGet);
            $id=$row['id'];
            $alreadyName=$row['name'];
            $alreadyEmail=$row['email_id'];
            $alreadyPassword=$row['password'];
            ?>

           <div class="row">
               <div class="col-12"> <ul class="list-group">
                       <li class="list-group-item fs-5 text-capitalize">Name:-  <?php echo $_SESSION['name']; ?></li>
                       <li class="list-group-item fs-5 ">Email:- <?php echo $_SESSION['email']; ?></li>
                       <li class="list-group-item fs-5 text-capitalize">Category:- <?php echo $_SESSION['category']; ?></li>
                   </ul>
               </div>
           </div>
        </div>
        <!--Profile-->


        <!--form-->
        <div class="col-lg-8  border border-secondary bg-light py-2 mb-5">
            <div class="row ">
                <div class="col-8">
                    <div class="py-2">
                        <a href="updateName.php?updateName=<?php echo $id; ?>" style="text-decoration: none;">UPDATE NAME</a>
                    </div>

                   <div class="py-2">
                       <a href="updateEmail.php?updateEmail=<?php echo $id; ?>" style="text-decoration: none;">UPDATE EMAIL</a>
                   </div>

                    <div class="py-2">
                        <a href="updatePassword.php?updatePass=<?php echo $id; ?>" style="text-decoration: none;">UPDATE PASSWORD</a>
                    </div>
                </div>
            </div>
        </div>
        <!--form-->

    </div>
    <!--data-->

</div>
<!--reports-->


<!--footer-->
<?php require_once "footerTCD.php" ?>
<!--footer-->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
