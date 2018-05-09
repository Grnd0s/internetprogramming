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

function getCategories($catId) 
{
    global $conn;
    
    $sql = "SELECT catId, catName from categories ORDER BY catName";
    
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($records as $record) 
    {
        echo "<option  ";
        echo ($record["catId"] == $catId) ? "selected" : ""; 
        echo " value='".$record["catId"] ."'>". $record['catName'] ." </option>";
    }
}
function getContentInfo()
{
    global $conn;
    $sql = "SELECT * FROM content WHERE contentId = " . $_GET['contentId'];
    
    $statement = $conn->prepare($sql);
    $statement->execute();
    $record = $statement->fetch(PDO::FETCH_ASSOC);
    
    return $record;
}
if (isset($_GET['updateContent'])) 
{
    $sql = "UPDATE content
            SET contentTitle = :contentTitle,
                contentAuthor = :contentAuthor,
                content = :content,
                catId = :catId
            WHERE contentId = :contentId";
        
    $np = array();
    $np[":contentTitle"] = $_GET['contentTitle'];
    $np[":contentAuthor"] = $_GET['contentAuthor'];
    $np[":content"] = $_GET['content'];
    $np[":catId"] = $_GET['catId'];
    $np[":contentId"] = $_GET['contentId'];
                
    $statement = $conn->prepare($sql);
    $statement->execute($np);        

    header("Location: index.php");
}
    
if(isset ($_GET['contentId']))
{
    $content = getContentInfo();
}

include('partials/header.php');?>
    <body>
        <?php include('partials/nav.php');?>
        <h1>Update Content</h1>
        
        <form class="form-horizontal">
            <input type="hidden" name="contentId" value="<?=$content['contentId']?>"/>
            <h4>Title: </h4><input type="text" value="<?=$content['contentTitle']?>" name="contentTitle"><br>
            <h4>Author: </h4><input type="text" name="contentAuthor" value="<?=$content['contentAuthor']?>"><br>
    
            <h4>Category: </h4><select name="catId">
                <option>Select One</option>
                <?php getCategories( $content['catId'] ); ?>
            </select> <br />
            <h4>Content: </h4>
            <textarea id="txtEditor" name="content"><?=$content['content']?></textarea>
            <br><br />
            <input class="btn btn-primary btn-lg" type="submit" name="updateContent" value="Update Content">
        </form>
        <script>
              $("#txtEditor").jqte();
          </script>
   <?php include('partials/footer.php');?>