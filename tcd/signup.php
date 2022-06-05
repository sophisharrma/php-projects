<?php
require_once "errors.php";
require_once "SQL_queries/signup_query.php";
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
                            <a class="nav-link active" data-bs-toggle="tab" href="#signup">Signup</a>
                        </li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <!--signup form-->
                        <div id="signup" class="container tab-pane active"><br>
                            <form action="" method="post">

                                <div class="mb-3">
                                    <label for="Name" class="form-label">Name</label>
                                    <input name="nameSignup" type="text" class="form-control" id="Name" placeholder="Name" required>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input my-1" type="radio" name="radioBox" id="admin" value="Admin" required>
                                    <label class="form-check-label my-1" for="admin">
                                        Admin
                                    </label>
                                    <br>
                                    <input class="form-check-input my-1" type="radio" name="radioBox" id="user" value="User" required>
                                    <label class="form-check-label my-1" for="user">
                                        User
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <label for="emailId " class="form-label">Email address</label>
                                    <input name="emailSignup" type="email" class="form-control" id="emailId" placeholder="Your Email Address" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input name="passwordSignup" type="Password" class="form-control" id="password" placeholder="Your Password" required>
                                </div>

                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                                    <input name="confirmPasswordSignup" type="Password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
                                </div>

                                <div class="my-4">
                                    <input name="submitSignup" type="submit" class="form-control btn btn-primary" value="Submit">
                                </div>
                            </form>
                            <div class="mb-5">
                                <p class="fs-5">Already a User?<a href="login.php" style="text-decoration: none; font-weight: bold; color: black;"> Log In </a></p>
                            </div>
                       </div>
                        <!--signup form-->
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