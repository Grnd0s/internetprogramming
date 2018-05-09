<?php
function displayResults()
{
    global $items;
    
    if (isset($items))
    {
        echo "<table class='table'>";
        foreach ($items as $item) 
        {
            $itemName = $item['name'];
            $itemPrice = $item['salePrice'];
            $itemImage = $item['thumbnailImage'];
            $itemId = $item['itemId'];
            
            echo '<tr>';
            
            echo "<td><img src='" . $itemImage . "'></td>";
            echo "<td><h4>" . $itemName . "</h4></td>";
            echo "<td><h4>$" . $itemPrice . "</h4></td>";
            
            echo '<form method="post">';
            echo "<input type='hidden' name='itemName' value='$itemName'>";
            echo "<input type='hidden' name='itemPrice' value='$itemPrice'>";
            echo "<input type='hidden' name='itemImg' value='$itemImage'>";
            echo "<input type='hidden' name='itemId' value='$itemId'>";
            
            if ($_POST['itemId'] == $itemId)
            {
                echo '<td><button class="btn btn-success">Added</button></td>';
            }
            else 
            {
                echo '<td><button class="btn btn-warning">Add</button></td>';
            }
            
            echo '</tr>';
            echo '</form>';
        }
        echo "</table>";
    }
}
    function displayPlatforms()
    {
        global $conn;
        
        $sql = "SELECT platformId, platformName FROM `platform` ORDER BY platformId";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($records);
        
        foreach ($records as $record) {
            
            echo "<option value='".$record["platformId"]."' >" . $record["platformName"] . "</option>";
            
        }
        
    }
    
    function displaySearchResults(){
        global $conn;
        
        if (isset($_GET['searchForm'])) { //checks whether user has submitted the form
            
            echo "<h3>Products Found: </h3>"; 
            
            //following sql works but it DOES NOT prevent SQL Injection
            //$sql = "SELECT * FROM om_product WHERE 1
            //       AND productName LIKE '%".$_GET['product']."%'";
            
            //Query below prevents SQL Injection
            
            $namedParameters = array();
            
            $sql = "SELECT * FROM product WHERE 1";
            
            if (!empty($_GET['product'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND productName LIKE :productName";
                 $namedParameters[":productName"] = "%" . $_GET['product'] . "%";
            }
                  
                  
             if (!empty($_GET['platform'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND platformId = :platformId";
                 $namedParameters[":platformId"] =  $_GET['platform'];
            }
            
            if (!empty($_GET['priceFrom'])) { 
                 $sql .=  " AND price >= :priceFrom";
                 $namedParameters[":priceFrom"] =  $_GET['priceFrom'];
            }
            if (!empty($_GET['priceTo'])) { 
                 $sql .=  " AND price <= :priceTo";
                 $namedParameters[":priceTo"] =  $_GET['priceTo'];
            }
            
            if (isset($_GET['orderBy']))
            {
                if ($_GET['orderBy'] == "priceA")
                {
                    $sql .= " ORDER BY price ASC";
                }
                else if ($_GET['orderBy'] == "priceD")
                {
                    $sql .= " ORDER BY price DESC";
                }
                else 
                {
                    $sql .= " ORDER BY productName";
                }
            }
            
            //echo $sql; //for debugging purposes
            
             $stmt = $conn->prepare($sql);
             $stmt->execute($namedParameters);
             $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            echo '<table class="table">';
            foreach ($records as $record) 
            {
                echo '<tr>';
                
                echo  "<td><a href=\"product.php?productId=" . $record['productId'] . "&img=" . $record['productImage'] ."\">" .$record["productName"] . "</a> </td>
                <td>" . $record["productDescription"] .  "</td> 
                <td>$" . $record['price'] . "</td>";
                
                echo '<form method="post">';
                echo "<input type='hidden' name='itemName' value='" . $record['productName'] . "'>";
                echo "<input type='hidden' name='itemPrice' value='" . $record['price'] . "'>";
                echo "<input type='hidden' name='itemImg' value='" . $record['productImage'] . "'>";
                echo "<input type='hidden' name='itemId' value='" . $record['productId'] . "'>";
            
                if ($_POST['itemId'] == $record['productId'])
                {
                    echo '<td><button class="btn btn-success">Added</button></td>';
                }
                else 
                {
                    echo '<td><button class="btn btn-warning">Add</button></td>';
                }
                
                echo '</form></tr>';
            }
            echo '</table>';
        }
        
    }

?>