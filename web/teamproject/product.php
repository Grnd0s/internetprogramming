<?php
    session_start();
    if (isset($_POST['return']))
    {
        header('Location: index.php');
    }
    
    $productId = $_GET['productId'];

    
 ?>


<?php
    
    include 'config/dbConn.php';
    include 'partials/functions.php';
    $conn = getDatabaseConnection("teamproject");



    //print_r($records);
    function displayProduct()
    {
        global $conn;
        $productId = $_GET['productId'];

        $sql = "SELECT * FROM `product`
            WHERE productId = :pId";    
    
        $np = array();
        $np[":pId"] = $productId;
    
        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo '<div class="container">
    	        <div class="card">
    		        <div class="container-fliud">
    			        <div class="wrapper row">
    				        <div class="preview col-md-6">
    					        <div class="preview-pic tab-content">
    					            <div class="tab-pane active" id="pic-1"><img src="' . $records[0]['productImage'] .'" /></div>
    					        </div>
    					
    				        </div>
    				        <div class="details col-md-6">
    					        <h3 class="product-title">' . $records[0]['productName'] . '</h3>
    					
    					        <p class="product-description">' . $records[0]['productDescription'] . '</p>
    					        <h4 class="price">current price: <span>$' . $records[0]['price'] . '</span></h4>
    					        ';
    	$sql2 = "SELECT catName, catDescription FROM category c INNER JOIN platform p ON c.catId = p.catId INNER JOIN product pr ON p.platformId = pr.platformId WHERE pr.productId = :pId";
    	$np = array();
        $np[":pId"] = $productId;
    
        $stmt = $conn->prepare($sql2);
        $stmt->execute($np);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);
    	echo				   '<h4 class="price">Category: ' .  $category['catName'] .'</h4>
    	                        <p class="product-description">' . $category['catDescription'] . '</p>';
    					        
    	echo '			        <div class="action">
    					            <form method="post">
    						            <input class="add-to-cart btn btn-success" type="submit" value="add to cart" name="add">
    						            <input class="add-to-cart btn btn-warning" type="submit" value="go back" name="return">
    					            </form>
    					        </div>
    					        ';
    					        echo  isset($_POST['add']) ? '<div class="alert alert-success alert-dismissible" role="alert" style="position: absolute;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Succes!</strong> ' . $records[0]['productName'] . ' has been added to youre cart !
                    </div>' : '';
                    echo '
    				        </div>
    			        </div>
    		        </div>
    	        </div>
            </div>';
    }
    if (isset($_POST['add']))
    {
         global $conn;
        $productId = $_GET['productId'];

        $sql = "SELECT * FROM `product`
            WHERE productId = :pId";    
    
        $np = array();
        $np[":pId"] = $productId;
    
        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $newItem = array();
        $newItem['name'] = $records[0]['productName'];
        $newItem['price'] = $records[0]['price'];
        $newItem['img'] = $records[0]['productImage'];
        $newItem['id'] = $records[0]['productId'];
        
        foreach ($_SESSION['cart'] as &$item) 
        {
            if ($newItem['id'] == $item['id'])
            {
                $item['quantity'] += 1;
                $found = true;
            }
        }
        if ($found != true)
        {
            $newItem['quantity'] = 1;
            array_push($_SESSION['cart'], $newItem);
          /*  echo '<div class="alert alert-success alert-dismissible" role="alert" style="position: absolute;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Succes!</strong> ' . $records[0]['productName'] . ' has been added to youre cart !
                    </div>';*/
        }
    }
 ?>

<!DOCTYPE html>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="css/product.css" type="text/css" />
        <title>GameMania</title>
    </head>
    <body>
        <!-- Bootstrap Navagation Bar -->
            <nav class='navbar navbar-inverse - navbar-fixed-top'>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                        <a class='navbar-brand' href='#'>GameMania</a>
                    </div>
                    <ul class='nav navbar-nav'>
                        <li><a href='index.php'>Home</a></li>
                        <li><a href='scart.php'>
                            <span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'>
                            </span> Cart: <?php displayCartCount();?></a>
                            </li>
                    </ul>
                </div>
            </nav>
            <br /><br />
            <?php displayProduct();?>
    </body>
</html>