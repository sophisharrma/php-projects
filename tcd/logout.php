<?php session_start();

$_SESSION['id']=NULL;
$_SESSION['category']=NULL;
$_SESSION['name']=NULL;
$_SESSION['email']=NULL;


session_unset();
session_destroy();
header("location:login.php");