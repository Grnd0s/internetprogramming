<?php
$sql1 = "SELECT COUNT(1) FROM user u INNER JOIN purchase p ON u.userId = p.user_id WHERE purchaseDate >= \"2018-02-01\" AND purchaseDate <= \"2018-02-31\"";
$sql2 = "SELECT productName, firstName FROM product INNER JOIN purchase ON product.productId = purchase.productId INNER JOIN user ON purchase.user_id = user.userId WHERE user.email LIKE \"%@aol%\"";
$sql4 = "SELECT catName FROM category INNER JOIN product ON category.catId = product.catId INNER JOIN purchase ON product.productId = purchase.purchaseId WHERE purchaseDate >= \"2018-02-01\" AND purchaseDate <= \"2018-02-31\"";



$sql1 = "SELECT COUNT(1) totalPurchases
            FROM purchase p
            INNER JOIN user u
            on p.user_id = u.userId
            WHERE purchaseDate >= \"2018-02-01\" AND purchaseDate <= \"2018-02-29\"";
            
 $sql2 = "SELECT productName
            FROM user u
            INNER JOIN purchase p
            on u.userId = p.user_id
            NATURAL JOIN product
            WHERE email LIKE \"%@aol.com\" ";
            
 $sql3 = "SELECT SUM(quantity) Amount, sex
            FROM user u
            INNER JOIN purchase p
            on u.userId = p.user_id
            GROUP BY sex";

 $sql4 = "SELECT DISTINCT(catName)
            FROM purchase p
            INNER JOIN user u
            on p.user_id = u.userId
            NATURAL JOIN product 
            NATURAL JOIN category cat
            WHERE purchaseDate >= \"2018-02-01\" AND purchaseDate <= \"2018-02-29\"";
            
$db = new PDO('mysql:host=localhost;dbname=ottermart', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "Connected <br />";

$stmt = $db->prepare($sql1);
$stmt->execute();
$records = $stmt->fetch(); //Fetch for one Records else FetchAll

echo "Total Purchases in Feb. : " . $records['totalPurchases'];

$stmt = $db->prepare($sql2);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<br/><br/>Products bought by users with an AOL account: <br />";

foreach ($records as $record) 
{
    echo $record['productName'] . "<br />";
}

$stmt = $db->prepare($sql3);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<br/><br/>Products bought by users with an AOL account: <br />";
foreach ($records as $record) 
{
    echo $record['sex'] . " : " . $record['Amount'] . "<br />";
}
?>