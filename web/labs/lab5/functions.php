<?php

function displayCart() 
{
    if (isset($_SESSION['cart']))
    {
    
        echo "<table class='table'>";
        foreach ($_SESSION['cart'] as $item) 
        {
            $itemId = $item['id'];
            $itemQuant = $item['quantity'];
            
            echo '<tr>';
            
            echo "<td><img src='" . $item['img'] . "'></td>";
            echo "<td><h4>" . $item['name'] . "</h4></td>";
            echo "<td><h4>$" . $item['price'] . "</h4>></td>";
        }
    }
}



function displayCartCount() 
{
    echo count($_SESSION['cart']);
}
function displayResults()
{
    
}
?>