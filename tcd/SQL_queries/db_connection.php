<?php
$connection=mysqli_connect('localhost','root','','tcd');
if(!$connection){
    die("not connected" . mysqli_connect_error());
}