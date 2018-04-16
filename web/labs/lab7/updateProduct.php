<?php
    include '../../../db.php';
    
    $connection = getDatabaseConnection("ottermart");
    
    function getCategories($catId) {
    global $connection;
    
    $sql = "SELECT catId, catName from om_category ORDER BY catName";
    
    $statement = $connection->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($records as $record) {
        echo "<option  ";
        echo ($record["catId"] == $catId)? "selected": ""; 
        echo " value='".$record["catId"] ."'>". $record['catName'] ." </option>";
    }
}
    
    function getProductInfo()
    {
        global $connection;
        $sql = "SELECT * FROM om_product WHERE productId = " . $_GET['productId'];
    
        //echo $_GET["productId"];
        
        $statement = $connection->prepare($sql);
        $statement->execute();
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $record;
    }
    if (isset($_GET['updateProduct'])) {
        
        //echo "Trying to update the product!";
        
        $sql = "UPDATE om_product
                SET productName = :productName,
                    productDescription = :productDescription,
                    productImage = :productImage,
                    price = :price,
                    catId = :catId
                WHERE productId = :productId";
        $np = array();
        $np[":productName"] = $_GET['productName'];
        $np[":productDescription"] = $_GET['description'];
        $np[":productImage"] = $_GET['productImage'];
        $np[":price"] = $_GET['price'];
        $np[":catId"] = $_GET['catId'];
        $np[":productId"] = $_GET['productId'];
                
        $statement = $connection->prepare($sql);
        $statement->execute($np);        

        header("Location: admin.php");
    }
    
    if(isset ($_GET['productId']))
    {
        $product = getProductInfo();
    }
    //print_r($product);
    
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
        <title>Update Product </title>
        
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
        <h1>Update Product</h1>
        
        <form class="form-horizontal">
            <input type="hidden" name="productId" value= "<?=$product['productId']?>"/>
            <h4>Product name: </h4><input type="text" value = "<?=$product['productName']?>" name="productName"><br>
            <h4>Description: </h4><textarea name="description" cols = 50 rows = 4><?=$product['productDescription']?></textarea><br>
            <h4>Price: </h4><input type="text" name="price" value = "<?=$product['price']?>"><br>
    
            <h4>Category: </h4><select name="catId">
                <option>Select One</option>
                <?php getCategories( $product['catId'] ); ?>
            </select> <br />
            <h4>Set Image Url: </h4><input type = "text" name = "productImage" value = "<?=$product['productImage']?>"><br><br />
            <input class="btn btn-primary btn-lg" type="submit" name="updateProduct" value="Update Product">
            
        </form>
        </div>
    </body>
</html>