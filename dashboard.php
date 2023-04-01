<?php
session_start();
require_once 'components/db_connect.php';
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
  header("Location: index.php");
  exit;
}
//if session user exist it shouldn't access dashboard.php
if (isset($_SESSION["user"])) {
  header("Location: home.php");
  exit;
}

$id = $_SESSION['adm'];
$status = 'adm';
$sql = "SELECT * FROM users WHERE status != '$status'";
$result = mysqli_query($connect, $sql);
$layout = "";
//this variable will hold the body for the table
$tbody = '';
if ($result->num_rows > 0) {
  while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $tbody .= "<tr>
          <td><img class='img-thumbnail rounded-circle' src='pictures/" . $row['picture'] . "' alt=" . $row['first_name'] . "></td>
          <td>" . $row['first_name'] . " " . $row['last_name'] . "</td>
          <td>" . $row['date_of_birth'] . "</td>
          <td>" . $row['email'] . "</td>
          <td>
          <a href='delete.php?id=" . $row['id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
       </tr>";
  }
} else {
  $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

$sql1 = "SELECT * FROM animal";
$res1 = mysqli_query($connect, $sql1);


if(mysqli_num_rows($res1) > 0){
    while($row1 = mysqli_fetch_assoc($res1)){
        if($row1['adopted'] == "Yes" || $row1['adopted'] == "yes"){
              $layout .= "<div class='card col-lg-4 col-md-6 col-sm-12 pt-1' style='width: 18rem;'>
              <img src='pictures/{$row1['picture']}' class='card-img-top rounded' alt='...'>
              <div class='card-body'>
              <ul class='list-group list-group-flush'>
              <li class='list-group-item fw-bold'>{$row1['name']} </li>
              <li class='list-group-item'>Age:  {$row1['age']} </li>
              <li class='list-group-item'>Size:  {$row1['size']} </li>
              <li class='list-group-item'>Vaccinated:  {$row1['vaccination_status']} </li>
              <li class='list-group-item'>Breed:  {$row1['breed']} </li>
              <li class='list-group-item'>Location:  {$row1['location']} </li>


          </ul>
                <a href='update.php?id={$row1['id']}' class='btn btn-success'>Update</a>
                <a href='deletea.php?id={$row1['id']}' class='btn btn-danger disabled'>Delete</a>
              </div>
            </div>";
        }else {
            $layout .= "<div class='card col-lg-4 col-md-6 col-sm-12 pt-1' style='width: 18rem;'>
              <img src='pictures/{$row1['picture']}' class='card-img-top rounded' alt='...'>
              <div class='card-body'>
              <ul class='list-group list-group-flush'>
              <li class='list-group-item fw-bold'>{$row1['name']} </li>
              <li class='list-group-item'>Age:  {$row1['age']} </li>
              <li class='list-group-item'>Size:  {$row1['size']} </li>
              <li class='list-group-item'>Vaccinated:  {$row1['vaccination_status']} </li>
              <li class='list-group-item'>Breed:  {$row1['breed']} </li>
              <li class='list-group-item'>Location:  {$row1['location']} </li>


          </ul>
                <a href='update.php?id={$row1['id']}' class='btn btn-success'>Update</a>
                <a href='deletea.php?id={$row1['id']}' class='btn btn-danger '>Delete</a>
              </div>
            </div>";
        }
        }
    }

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adm-Dashboard</title>
  <?php require_once 'components/boot.php' ?>
  <link rel="stylesheet" href="css/home.css">
  <style type="text/css">
      .img-thumbnail {
          width: 70px !important;
          height: 70px !important;
      }

      td {
          text-align: left;
          vertical-align: middle;
      }

      tr {
          text-align: center;
      }

      .userImage {
          width: 100px;
          height: auto;
      }
  </style>
</head>

<body>
  <div class="container">
      <div class="row">
          <div class="col-2">
              <img class="userImage" src="pictures/admavatar.png" alt="Adm avatar">
              <p class="">Administrator</p>
              <a href="logout.php?logout">Sign Out</a>
          </div>
          <div class="col-8 mt-2">
              <p class='h2'>Users</p>
              <table class='table table-striped'>
                  <thead class='table-success'>
                      <tr>
                          <th>Picture</th>
                          <th>Name</th>
                          <th>Date of birth</th>
                          <th>Email</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?= $tbody ?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>

  <h1 class="text-center  mt-5 mb-5">All Pets</h1>
  <div class="container mb-5 ">
    <div class="row text-center justify-content-center gap-3">
        <a href="create.php" class="btn btn-success">Instert a new animal</a>
     <?= $layout ?>
     </div>
  </div>

</body>
</html>