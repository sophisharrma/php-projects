<?php
session_start();

$today=date('Y-m-d');

if(isset($_POST['submitSignup'])){

require_once "SQL_queries/db_connection.php";
GLOBAL $connection;

    $name=$_POST['nameSignup'];
    $category=$_POST['radioBox'];
    $email=$_POST['emailSignup'];
    $password=$_POST['passwordSignup'];
    $confirmPassword=$_POST['confirmPasswordSignup'];

    $name=mysqli_real_escape_string($connection,trim(stripcslashes($name)));
    $email=mysqli_real_escape_string($connection,trim(stripcslashes($email)));
    $password=mysqli_real_escape_string($connection,trim(stripcslashes($password)));
    $confirmPassword=mysqli_real_escape_string($connection,trim(stripcslashes($confirmPassword)));

    $email=filter_var($email,FILTER_SANITIZE_EMAIL);
    $hash="$2y$10$";
    $salt="anystringthatistewntytwocharacterslong";
    $finalResult=$hash.$salt;
    $password=crypt($password,$finalResult);
    $confirmPassword=crypt($confirmPassword,$finalResult);

     if(!(filter_var($email,FILTER_VALIDATE_EMAIL))){
         echo "<script>alert('email not perfect')</script>";
     }else{
    //check if email is taken or not
    $query_to_check_email="SELECT * FROM user_details WHERE email_id ='$email'";
    $result_to_check_email=mysqli_query($connection,$query_to_check_email);
    if(mysqli_num_rows($result_to_check_email)>0){
        echo "<script> alert('email already taken') </script>";
    }else{
        //confirm password
        if($password===$confirmPassword){
            //insert the query and move to rawmaterial.php

            $query_to_insert_data="INSERT INTO user_details(date,user_or_admin,name,email_id,password,confirmPassword)
                       VALUES ('$today','$category','$name','$email','$password','$confirmPassword')";
            $result_to_insert_data=mysqli_query($connection,$query_to_insert_data);
            if(!$result_to_insert_data){
                die("data not inserted" . mysqli_error($connection));
            }else{

                header("location:login.php");
            }
        }else{
            echo "<script> alert('password doesn\'t match') </script>";
        }
}

}

}