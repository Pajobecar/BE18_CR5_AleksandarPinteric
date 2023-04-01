<?php
session_start();
require_once 'components/db_connect.php';

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
  header("Location: index.php");
  exit;
}
if (isset($_SESSION["user"])) {
  header("Location: home.php");
  exit;
}

$id = $_GET["id"];

$sql = "DELETE FROM animal WHERE id = $id";

if(mysqli_query($connect,$sql)){
    header("Location: dashboard.php");
}