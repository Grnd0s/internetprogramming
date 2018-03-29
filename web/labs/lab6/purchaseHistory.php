<?php


    $productId = $_GET['productId'];


 ?>


<?php
    
    include '../../../db.php';
    $conn = getDatabaseConnection("ottermart");

    $productId = $_GET['productId'];

    $sql = "SELECT * FROM `om_product`
            NATURAL JOIN om_purchase 
            WHERE productId = :pId";    
    
    $np = array();
    $np[":pId"] = $productId;
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //print_r($records);
    if (empty($records))
    {
        echo "<img src='" . $_GET['img'] . "' width='200' /><br/>";
    }
    else 
    {
        echo $records[0]['productName'] . "<br>";
        echo "<img src='" . $records[0]['productImage'] . "' width='200' /><br/>";
        foreach ($records as $record) 
        {
            echo "Purchase Date: " . $record["purchaseDate"] . "<br />";
            echo "Unit Price: " . $record["unitPrice"] . "<br />";
            echo "Quantity: " . $record["quantity"] . "<br />";
        }
    }
 ?>

<!DOCTYPE html>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
        <title> </title>
    </head>
    <body>

    </body>
</html>