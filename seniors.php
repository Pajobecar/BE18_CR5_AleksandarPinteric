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
$layout="";
$res = mysqli_query($connect, "SELECT * FROM animal WHERE age > 8");


$res1 = mysqli_query($connect, "SELECT * FROM users WHERE id=" . $_SESSION['user']);
$row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC);

if(mysqli_num_rows($res) > 0){
    while($row = mysqli_fetch_assoc($res)){
        if($row['adopted'] == 'no'){
              $layout .= "<div class='card col-lg-4 col-md-6 col-sm-12 pt-1' style='width: 18rem;'>
              <img src='pictures/{$row['picture']}' class='card-img-top rounded' alt='...'>
              <div class='card-body'>
                <h5 class='card-title'>{$row['name']}</h5>
                <p class='card-text'>Age: {$row['age']}</p>
                <a href='details.php?id={$row['id']}' class='btn btn-primary'>Details</a>
                <a href='adopt.php?id={$row['id']}' class='btn btn-success'>Adopt me</a>
              </div>
            </div>";
        }else {
            $layout .= "";
        }
    }
}else {
    $layout .= "No results";
}
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
            <a class="nav-link" href="#">Seniors</a>
            <a class="nav-link" href="adopted.php">Adopted pets</a>
        </div>
        <div class="container text-center justify-content-end" >
            <a class="text-primary d-flex align-text-center pb-0 mt-0 me-2"><?= $row1['email'] ?></a>
        <a href="logout.php?logout " class="text-decoration-none" >Sign Out</a>
      
      </div>
      
    </nav>

    <h1 class="text-center  mt-5 mb-5">Seniors</h1>
  <div class="container mb-5 ">
    <div class="row text-center justify-content-center gap-3">
     <?= $layout ?>
     </div>
  </div>
</body>
      </body>
</html>