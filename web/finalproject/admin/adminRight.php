<?php

session_start();
if(!isset($_SESSION['login']) && $_SESSION['login'] != 1)
{
  header("Location:../login.php");
}
if (!isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] != 1)
{
  header("Location:../index.php");  
}
include '../config/db.php';
$conn = getDatabaseConnection("finalproject");

$sql= "SELECT userAdmin FROM user WHERE userId = :userId";
$param = array();
$param[':userId'] = $_GET['userId'];

$stmt = $conn->prepare($sql);
$stmt->execute($param);
$isAdmin = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "UPDATE user SET userAdmin = :userAdmin WHERE userId = :userId";

$param = array();
$param[':userAdmin'] = $isAdmin['userAdmin'] == 1 ? 0 : 1;
$param[':userId'] = $_GET['userId'];
$stmt = $conn->prepare($sql);
$stmt->execute($param);
 
header("Location: users.php");
?>