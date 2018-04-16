<?php

 include '../../../db.php';
    
 $connection = getDatabaseConnection("ottermart");
    
 $sql = "DELETE FROM om_product WHERE productId =  " . $_GET['productId'];
 $statement = $connection->prepare($sql);
 $statement->execute();
 
 header("Location: admin.php");
?>