<?php
session_start();
require_once "errors.php";
require_once "SQL_queries/db_connection.php";
GLOBAL $connection;

if(isset($_POST['submitLogin'])){
    $login_email=$_POST['emailLogin'];
    $login_password=$_POST['passwordLogin'];

    $login_email=mysqli_real_escape_string($connection,trim(stripcslashes($login_email)));
    $login_password=mysqli_real_escape_string($connection,trim(stripcslashes($login_password)));

    //check if email exist
    $query="SELECT * FROM user_details WHERE email_id = '$login_email'";
    $result=mysqli_query($connection,$query);
    $row=mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0){
        //check if password is correct
        //decrypt password
        $finalPass=hash_equals($row['password'],crypt($login_password,$row['password']));
        if($finalPass){
            $_SESSION['id']=$row['id'];
            $_SESSION['name']=$row['name'];
            $_SESSION['category']=$row['user_or_admin'];
            $_SESSION['email']=$row['email_id'];
            $_SESSION['modalTimes']=$row['modalTimes'];

            header("location:rawmaterial.php");

        }else{
            echo "<script> alert ('wrong password')</script>";
        }

    }else{
        echo "<script> alert('user not registered') </script> ";
    }


}