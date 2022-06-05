<?php
require_once "errors.php";
require_once "SQL_queries/login_query.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>ePortal</title>
</head>
<body class="mb-5">
<!--header-->
<?php require_once "headerTCD.php"; ?>
<!--header-->

<!--main section-->
<div class="container my-3">
    <div class="row mt-3">
        <div class="col"></div>

        <div class="col-md-6 border border-light">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#login">Login</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <!--login form-->
                 <div id="login" class="container tab-pane active"><br>
                     <form action="" method="post">
                         <div class="mb-3">
                             <label for="exampleFormControlInput" class="form-label">Email address</label>
                             <input type="email" name="emailLogin" class="form-control" id="exampleFormControlInput" placeholder="Your Email Id" required>
                         </div>
                         <div class="mb-3">
                             <label for="password" class="form-label">Password</label>
                             <input type="Password" name="passwordLogin" class="form-control" id="password" placeholder="Your Password" required>
                         </div>
                         <div class="my-3">
                             <input type="submit" name="submitLogin" class="form-control btn btn-primary" value="Submit" >
                         </div>
                     </form>
                     <div class="mb-3">
                         <!--<p class="fs-6"><a href="" style="text-decoration: none;  font-style: italic;"> Forgot Password? </a></p>
                         <br>-->
                         <p class="fs-5">New User?<a href="signup.php" style="text-decoration: none; font-weight: bold; color: black;"> Sign Up </a></p>
                     </div>
                 </div>
                <!--login form-->
            </div>
        </div>

        <div class="col"></div>
    </div>
</div>
<!--main section-->

<!--footer-->
<?php require_once "footerTCD.php" ?>
<!--footer-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>