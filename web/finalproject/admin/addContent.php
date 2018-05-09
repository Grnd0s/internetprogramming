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

if (isset($_GET['submit'])) 
{
    $contentTitle = $_GET['contentTitle'];
    $contentAuthor = $_GET['contentAuthor'];
    $content = $_GET['content'];
    $catId = $_GET['catId'];
    
    $sql = "INSERT INTO content
            ( `contentTitle`, `contentAuthor`, `content`, `catId`) 
             VALUES ( :contentTitle, :contentAuthor, :content, :catId)";
    
    $namedParameters = array();
    $namedParameters[':contentTitle'] = $contentTitle;
    $namedParameters[':contentAuthor'] = $contentAuthor;
    $namedParameters[':content'] = $content;
    $namedParameters[':catId'] = $catId;
    
    $statement = $conn->prepare($sql);
    $statement->execute($namedParameters);
    header("Location: index.php");
}

include('partials/header.php');?>
    <body>
        <?php include('partials/nav.php');?>
        <h1> Add New Content</h1>
        <form class="form-horizontal">
            <h4>Title: </h4><input type="text" name="contentTitle"><br>
            <h4>Author: </h4><input type="text" name="contentAuthor"><br>
            <h4>Category: </h4><select name="catId">
                <option value="">Select One</option>
                <?php getCategories(); ?>
            </select> <br />
            <h4>Content: </h4>
            <textarea id="txtEditor" name="content"></textarea>
            
            <br><br />
            <input class="btn btn-success btn-lg" type="submit" name="submit" value="Add New Content">
        </form>
          <script>
              $("#txtEditor").jqte();
          </script>
   <?php include('partials/footer.php');?>
 