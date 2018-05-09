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

function getInfoboxInfo()
{
    global $conn;
    $sql = "SELECT * FROM infobox WHERE infoId = :infoId";
    $param = array();
    $param[':infoId'] = $_GET['infoId'];
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($param);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $record;
}
if (isset($_GET['updateInfo'])) 
{
    $sql = "UPDATE infobox
            SET infoTitle = '" . $_GET['infoTitle'] . "',
                infoContent = '" . $_GET['infoContent'] ."',
                infoAuthor = '" . $_GET['infoAuthor'] . "' 
            WHERE infoId = " . $_GET['infoId'];
        
                
    $stmt = $conn->prepare($sql);
    $stmt->execute();        

    header("Location: infobox.php");
}
    
if(isset ($_GET['infoId']))
{
    $info = getInfoboxInfo();
}

include('partials/header.php');?>
    <body>
        <?php include('partials/nav.php');?>
        <h1>Update Infobox</h1>
        
        <form class="form-horizontal">
            <input type="hidden" name="infoId" value="<?= $info['infoId']; ?>"/>
            <h4>Title: <input type="text" value="<?= $info['infoTitle']; ?>" name="infoTitle"></h4>
            <h4>Author: <input type="text" value="<?= $info['infoAuthor']; ?>" name="infoAuthor"></h4>
            <h4>Content: <textarea name="infoContent"><?= $info['infoContent']; ?></textarea></h4>
            
            <input class="btn btn-primary" type="submit" name="updateInfo" value="Update Info">
        </form>
        
   <?php include('partials/footer.php');?>