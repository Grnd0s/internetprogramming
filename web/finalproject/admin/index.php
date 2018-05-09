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
require_once '../config/db.php';
$conn = getDatabaseConnection("finalproject");

function displayAllContents(){
    global $conn;
    $sql="SELECT * FROM content";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    //print_r($records);

    return $records;
}
function getContentStats()
{
    global $conn;
    $sql = "SELECT COUNT(contentId) nbreContent FROM content WHERE 1";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetch(PDO::FETCH_ASSOC);
    
    return $records;
}
function getUserStats()
{
    global $conn;
    $sql = "SELECT COUNT(userId) nbreUsers FROM user WHERE 1";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetch(PDO::FETCH_ASSOC);
    
    return $records;
}
function getCategoryStats()
{
    global $conn;
    $sql = "SELECT COUNT(catId) nbreCategories FROM categories WHERE 1";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetch(PDO::FETCH_ASSOC);
    
    return $records;
}
function getInfoStats()
{
    global $conn;
    $sql = "SELECT COUNT(infoId) nbreInfos FROM infobox WHERE 1";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetch(PDO::FETCH_ASSOC);
    
    return $records;
}
$contentStats = getContentStats();
$userStats = getUserStats();
$categoryStats = getCategoryStats();
$infoStats = getInfoStats();

include('partials/header.php');?>
    <body>
        <?php include('partials/nav.php');?>
        <h1> Admin Main Page </h1>
        
        <h3> Welcome <?=$_SESSION['username']?>! </h3>
        
        <div class="row mb-3">
                <div class="col-lg-3 col-md-6">
                    <div class="card card-inverse card-success">
                        <div class="card-block bg-success">
                            <div class="rotate">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <h6 class="text-uppercase">Users</h6>
                            <h1 class="display-1"><?= $userStats['nbreUsers'];?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card card-inverse card-danger">
                        <div class="card-block bg-danger">
                            <div class="rotate">
                                <i class="fa fa-list fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Posts</h6>
                            <h1 class="display-1"><?= $contentStats['nbreContent'];?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card card-inverse card-info">
                        <div class="card-block bg-info">
                            <div class="rotate">
                                <i class="fas fa-file-alt fa-5x"></i>
                            </div>
                            <h6 class="text-uppercase">Category</h6>
                            <h1 class="display-1"><?= $categoryStats['nbreCategories'];?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card card-inverse card-warning">
                        <div class="card-block bg-warning">
                            <div class="rotate">
                                <i class="fa fa-info fa-5x"></i>
                            </div>
                            <h6 class="text-uppercase">Infobox</h6>
                            <h1 class="display-1"><?= $infoStats['nbreInfos'];?></h1>
                        </div>
                    </div>
                </div>
            </div>

        
        <br />
        <form action="addContent.php">
            <input class="btn btn-success" type="submit" name="addContent" value="Add New Content"/>
        </form>
        
        <br />
        <strong> Contents: </strong> <br />
        
        <?php $records=displayAllContents();
            foreach($records as $record) 
            {
                echo '<a href="updateContent.php?contentId=' . $record['contentId'] .'"><button class="btn btn-warning">Update</button></a> ';
                echo '<a href="deleteContent.php?contentId=' . $record['contentId'] .'"><button class="btn btn-danger">Delete</button></a> ';
                echo $record['contentTitle'];
                echo '<br>';
            }
        
        ?>
        
   <?php include('partials/footer.php');?>
 