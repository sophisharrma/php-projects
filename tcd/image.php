<?php
require_once "SQL_queries/db_connection.php";
GLOBAL $connection;
$fileDir="uploads/";
$tmp_name=$_FILES["fileToUpload"]["tmp_name"];
if(isset($_POST['submit']) && !empty(($_FILES["fileToUpload"]["name"]))){
    $fileName=basename($_FILES["fileToUpload"]["name"]);
    $fileExt=pathinfo($fileName,PATHINFO_EXTENSION);
    $filePath=$fileDir.$fileName;
    $allowedArray=array('jpeg','jpg','png');
    if(in_array($fileExt,$allowedArray)){
            if(move_uploaded_file($tmp_name,$filePath)){
                $query="INSERT INTO images(imgName) VALUES ('$fileName')";
                $result=mysqli_query($connection,$query);
                if(!$result){
                    echo "not uploaded";
                }else{
                    echo "uploaded";
                }
            }else{
                echo "no";
            }
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
<body>


<div class="container-fluid p-0">
    <!--sales-->
    <div class="row mx-3 justify-content-evenly">

        <!--form-->
        <div class="col-lg-8 my-5 border border-secondary bg-light ">

            <form action="image.php" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="submit">
            </form>
            </form>
        </div>
        <!--form-->
         <div class="row">
           <?php
           require_once "SQL_queries/db_connection.php";
            $q="SELECT * FROM images";
            $r=mysqli_query($connection,$q);
            while ($row=mysqli_fetch_assoc($r)){
                $imageURL="uploads/".$row['imgName'];

            }
           echo "<img src='$imageURL' alt='$fileName'; >";
            ?>
         </div>

    </div>
    <!--sales-->
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
