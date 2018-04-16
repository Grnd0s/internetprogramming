<?php

session_start();
if(!isset( $_SESSION['adminName']))
{
  header("Location:index.php");
}
include '../../../db.php';
$conn = getDatabaseConnection("ottermart");

function displayAllProducts(){
    global $conn;
    $sql="SELECT * FROM om_product";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    //print_r($records);

    return $records;
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
        
        <title> Admin Main Page </title>
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
        <h1> Admin Main Page </h1>
        
        <h3> Welcome <?=$_SESSION['adminName']?>! </h3>
        
        <br />
        <form action="addProduct.php">
            <input class="btn btn-success" type="submit" name="addproduct" value="Add Product"/>
        </form>
        
        <br />
        <strong> Products: </strong> <br />
        
        <?php $records=displayAllProducts();
            foreach($records as $record) 
            {
                echo '<a href="updateProduct.php?productId=' . $record['productId'] .'"><button class="btn btn-warning">Update</button></a> ';
                echo '<a href="deleteProduct.php?productId=' . $record['productId'] .'"><button class="btn btn-danger">Delete</button></a> ';
                echo $record['productName'];
                echo '<br>';
            }
        
        ?>
        
        </div>

    </body>
</html>