<?php
session_start();
require_once 'components/db_connect.php';
require_once 'components/file_upload.php';


if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}

$id = $_GET["id"];

$sql = "SELECT * FROM animal WHERE id = $id";

$result = mysqli_query($connect, $sql);

$row = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {

    $name = $_POST['name'];


    $size =$_POST['size'];


    $age = $_POST['age'];
 

    $vaccination_status = $_POST['vaccination_status'];
   

    $breed = $_POST['breed'];
   

    $location = $_POST['location'];
    
    $adopted = $_POST['adopted'];

    $picture = file_upload($_FILES['picture']);

    $query = "UPDATE `animal` SET `name`='$name',`size`='$size',`age`='$age',`vaccination_status`='$vaccination_status',
    `breed`='$breed',`location`='$location',`picture`='$picture->fileName',`adopted`='$adopted' WHERE id = $id";
      
      if (mysqli_query($connect, $query)){
        header("Location: dashboard.php");
        
      }
      
} 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <form class="w-75" method="POST" autocomplete="off" enctype="multipart/form-data">
            <h2>Update Form</h2>
            <hr />


            <input type="text" name="name" class="form-control" value="<?= $row['name']  ?>" maxlength="50" required/>
            <hr>

            <select name="size" id="size">
                <option value="">Size</option>
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
            </select>
            <hr>
            <input type="number" name="age" class="form-control" value="<?= $row['age']  ?>" maxlength="50" required  />
            <hr>


            <input type="text" name="breed" class="form-control" value="<?= $row['breed']  ?>" maxlength="40" required  />
            <hr>

            <select name="vaccination_status" id="vaccination_status" required>
                <option value="" selected>Vaccination status</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            <hr>
            <input type="text" name="location" class="form-control" required value="<?= $row['location']  ?>" maxlength="40"  />
            <br>
            <hr>
            <input class='form-control w-50' type="file" name="picture" >

            <hr>
            
            <button type="submit" class="btn btn-block btn-primary" name="submit">Update</button>
            <hr />
           
        </form>
    </div>
</body>

</html>