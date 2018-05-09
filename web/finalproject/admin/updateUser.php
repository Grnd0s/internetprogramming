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

function getUserInfo()
{
    global $conn;
    $sql = "SELECT userId, username FROM user WHERE userId = :userId";
    $param = array();
    $param[':userId'] = $_GET['userId'];
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($param);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $record;
}
if (isset($_GET['updateUser'])) 
{
    $sql = "UPDATE user
            SET username = '" . $_GET['username'] . "',
                password = '" . sha1($_GET['password']) ."'
            WHERE userId = " .  $_GET['userId'];
        
                
    $stmt = $conn->prepare($sql);
    $stmt->execute();        

    header("Location: users.php");
}
    
if(isset ($_GET['userId']))
{
    $user = getUserInfo();
}

include('partials/header.php');?>
    <body>
        <?php include('partials/nav.php');?>
        <h1>Update Content</h1>
        
        <form class="form-horizontal">
            <input type="hidden" name="userId" value="<?=$user['userId']?>"/>
            <h4>Username: <input type="text" value="<?=$user['username']?>" name="username"></h4>
            <h4>Password: <input type="password" name="password" placeholder="new password"></h4>
            
            <input class="btn btn-primary btn-lg" type="submit" name="updateUser" value="Update User">
        </form>
        
   <?php include('partials/footer.php');?>