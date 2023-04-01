<?php
session_start();
require_once 'components/db_connect.php';

// if adm will redirect to dashboard
if (isset($_SESSION['adm'])) {
  header("Location: dashboard.php");
  exit;
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
  header("Location: index.php");
  exit;
}
$layout ="";
// select logged-in users details - procedural style
$res = mysqli_query($connect, "SELECT * FROM users WHERE id=" . $_SESSION['user']);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
// select all animals details
$sql1 = "SELECT * FROM animal";
$res1 = mysqli_query($connect, $sql1);

// create all animal cards
if(mysqli_num_rows($res1) > 0){
    while($row1 = mysqli_fetch_assoc($res1)){
        if($row1['adopted'] == 'no'){
              $layout .= "<div class='card col-lg-4 col-md-6 col-sm-12 pt-1' style='width: 18rem;'>
              <img src='pictures/{$row1['picture']}' class='card-img-top rounded' alt='...'>
              <div class='card-body'>
                <h5 class='card-title'>{$row1['name']}</h5>
                <p class='card-text'>Age: {$row1['age']}</p>
                <a href='details.php?id={$row1['id']}' class='btn btn-primary'>Details</a>
                <a href='adopt.php?id={$row1['id']}' class='btn btn-success'>Adopt me</a>
              </div>
            </div>";
        }else {
            $layout .= "";
        }
    }
}else {
    $layout .= "No results";
}
mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome - <?php echo $row['first_name']; ?></title>
  <?php require_once 'components/boot.php' ?>
  <link rel="stylesheet" href="css/home.css">
  
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary navbar bg-dark" data-bs-theme="dark">
  <div class="container">
    <a class="navbar-brand " href="#"><img class="userImage rounded img-fluid" src="pictures/<?php echo $row['picture']; ?>" alt="<?php echo $row['first_name']; ?>"></a>
    <a class="nav-link flex-end" aria-current="page" href="home.php">Hi <?php echo $row['first_name']; ?></a>
    
        <a class="nav-link " aria-current="page" href="home.php">Available pets</a>
        <a class="nav-link" href="seniors.php">Seniors</a>
        <a class="nav-link" href="adopted.php">Adopted pets</a>
  </div>
        <div class="container text-center justify-content-end" >
            <a class="text-primary d-flex align-text-center pb-0 mt-0 me-2"><?= $row['email'] ?></a>
        <a href="logout.php?logout " class="text-decoration-none" >Sign Out</a>
      
      </div>
</nav>
<h1 class="text-center  mt-5 mb-5">All available Pets</h1>
  <div class="container mb-5 ">
    <div class="row text-center justify-content-center gap-3">
     <?= $layout ?>
     </div>
  </div>
</body>
</html>