<?php
session_start();
require_once "components/db_connect.php";

if (isset($_SESSION['adm'])) {
    header("Location: dashboard.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
$res1 = mysqli_query($connect, "SELECT * FROM users WHERE id=" . $_SESSION['user']);
$row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC);

$id = $_GET["id"];

$sql = "SELECT * FROM animal WHERE id = $id ";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "components/boot.php" ?>
    <link rel="stylesheet" href="css/home.css">
    <title>Details</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar bg-dark mb-5" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand " href="#"><img class="userImage rounded img-fluid" src="pictures/<?php echo $row1['picture']; ?>" alt="<?php echo $row1['first_name']; ?>"></a>
            <a class="nav-link flex-end" aria-current="page" href="home.php"><?php echo "Hi " . $row1['first_name']; ?></a>

            <a class="nav-link " aria-current="page" href="home.php">Available pets</a>
            <a class="nav-link" href="seniors.php">Seniors</a>
            <a class="nav-link" href="adopted.php">Adopted pets</a>

        </div>
        <div class="container text-center justify-content-end" >
            <a class="text-primary d-flex align-text-center pb-0 mt-0 me-2"><?= $row1['email'] ?></a>
        <a href="logout.php?logout " class="text-decoration-none" >Sign Out</a>
      
      </div>
    </nav>
    <div class="container d-flex justify-content-center mt-3">
        <div class="card" style="width: 18rem;">
            <img src="pictures/<?=  $row['picture'] ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= $row['name'] ?></h5>
            </div>
            <ul class="list-group list-group-flush ">
                <li class="list-group-item">Age: <?= $row['age'] ?></li>
                <li class="list-group-item">Size: <?= $row['size'] ?></li>
                <li class="list-group-item">Vaccinated: <?= $row['vaccination_status'] ?></li>
                <li class="list-group-item">Breed: <?= $row['breed'] ?></li>
                <li class="list-group-item">Location: <?= $row['location'] ?></li>


            </ul>
            <div class="card-body">
                <a href="home.php" class="btn btn-primary">Home</a>
                 <a href="adopt.php?id=<?= $row['id' ]?>" class="btn btn-success">Adopt me</a>
            </div>
        </div>
    </div>
</body>

</html>