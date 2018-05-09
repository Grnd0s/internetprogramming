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

function getCategories() {
    global $conn;
    
    $sql = "SELECT catId, catName from categories ORDER BY catName";
    
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($records as $record) {
        echo "<option value='".$record["catId"] ."'>". $record['catName'] ." </option>";
    }
}

if (isset($_GET['submit'])) {
    $username = $_GET['username'];
    $password = $_GET['password'];
    $isAdmin = $_GET['admin'] == 1 ? 1 : 0;
    
    $sql = "INSERT INTO user
            ( `username`, `password`, `userAdmin`) 
             VALUES ( :username, SHA1(:password), :userAdmin)";
    
    $namedParameters = array();
    $namedParameters[':username'] = $username;
    $namedParameters[':password'] = $password;
    $namedParameters[':userAdmin'] = $isAdmin;
    
    $statement = $conn->prepare($sql);
    $statement->execute($namedParameters);
    header("Location: users.php");
}

include('partials/header.php');?>
    <body>
        <?php include('partials/nav.php');?>
        <h1> Add New User</h1>
        <form class="form-horizontal">
            <h4>Username: <input type="text" name="username"></h4>
            <h4>Password: <input type="password" name="password"></h4>
            <h4>Admin: <input type="checkbox" name="admin" value="1"></h4><br />
            <input class="btn btn-success btn-lg" type="submit" name="submit" value="Add New User">
        </form>
        
   <?php include('partials/footer.php');?>
 