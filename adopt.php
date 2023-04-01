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
$userId = $_SESSION['user'];
$id = $_GET["id"];

$sql = "INSERT INTO `pet_adoption`(`user_id`, `pet_id`, `adoption_date`) 
VALUES ('$userId', '$id', NOW())";

$sql1 = "UPDATE `animal` SET `adopted`='yes' WHERE id = $id";
if(mysqli_query($connect, $sql)){
    if(mysqli_query($connect, $sql1)){
    header("Location: home.php");
    }
}