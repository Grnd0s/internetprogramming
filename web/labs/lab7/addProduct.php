<?php
session_start();
if(!isset( $_SESSION['adminName']))
{
  header("Location:index.php");
}
include "../../../db.php";
$conn = getDatabaseConnection("ottermart");

function getCategories() {
    global $conn;
    
    $sql = "SELECT catId, catName from om_category ORDER BY catName";
    
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($records as $record) {
        echo "<option value='".$record["catId"] ."'>". $record['catName'] ." </option>";
    }
}

if (isset($_GET['submitProduct'])) {
    $productName = $_GET['productName'];
    $productDescription = $_GET['description'];
    $productImage = $_GET['productImage'];
    $productPrice = $_GET['price'];
    $catId = $_GET['catId'];
    
    $sql = "INSERT INTO om_product
            ( `productName`, `productDescription`, `productImage`, `price`, `catId`) 
             VALUES ( :productName, :productDescription, :productImage, :price, :catId)";
    
    $namedParameters = array();
    $namedParameters[':productName'] = $productName;
    $namedParameters[':productDescription'] = $productDescription;
    $namedParameters[':productImage'] = $productImage;
    $namedParameters[':price'] = $productPrice;
    $namedParameters[':catId'] = $catId;
     $statement = $conn->prepare($sql);
    $statement->execute($namedParameters);
    header("Location: admin.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
       
        <title> Add a product </title>
    </head>
    <body>
        <div class="container">

        <nav class='navbar navbar-inverse '>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                        <a class='navbar-brand' href='#'>OtterMart</a>
                    </div>
                    <ul class='nav navbar-nav navbar-left'>
                        <li><a href='admin.php'>Product List</a></li>
                        <li><a href='addProduct.php'>Add Product</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" class="navbar-link">Signed in as <?=$_SESSION['adminName']?></a></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span></a></li>
                    </ul>
                </div>
            </nav>
        <h1> Add a product</h1>
        <form class="form-horizontal">
            <h4>Product name: </h4><input type="text" name="productName"><br>
            <h4>Description: </h4><textarea name="description" cols = 50 rows = 4></textarea><br>
            <h4>Price: </h4><input type="text" name="price"><br>
            <h4>Category: </h4><select name="catId">
                <option value="">Select One</option>
                <?php getCategories(); ?>
            </select> <br />
            <h4>Set Image Url: </h4><input type = "text" name = "productImage"><br><br />
            <input class="btn btn-success btn-lg" type="submit" name="submitProduct" value="Add Product">
            
        </form>
        </div>
    </body>
</html>