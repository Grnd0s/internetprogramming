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

$sql = "DELETE FROM content WHERE contentId =  " . $_GET['contentId'];
$statement = $conn->prepare($sql);
$statement->execute();
 
header("Location: index.php");
?>