<?php

    include '../../../db.php';
    
    $conn = getDatabaseConnection("ottermart");

    function displayCategories()
    {
        global $conn;
        
        $sql = "SELECT catId, catName FROM `om_category` ORDER BY catName";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($records);
        
        foreach ($records as $record) {
            
            echo "<option value='".$record["catId"]."' >" . $record["catName"] . "</option>";
            
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
            
            $sql = "SELECT * FROM om_product WHERE 1";
            
            if (!empty($_GET['product'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND productName LIKE :productName";
                 $namedParameters[":productName"] = "%" . $_GET['product'] . "%";
            }
                  
                  
             if (!empty($_GET['category'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND catId = :categoryId";
                 $namedParameters[":categoryId"] =  $_GET['category'];
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
                if ($_GET['orderBy'] == "price")
                {
                    $sql .= " ORDER BY price";
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
        
            foreach ($records as $record) {
            
                 echo  "<a href=\"purchaseHistory.php?productId=" . $record['productId'] . "&img=" . $record['productImage'] ."\">" .$record["productName"] . "</a> " . $record["productDescription"] .  " $" . $record['price'] . "<br />";
            
            }
        }
        
    }

    
?>

<!DOCTYPE html>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
        <title> OtterMart Product Search </title>
        <style type="text/css">
            .center_div
            {
                margin: 0 auto;
                width:50% /* value of your choice which suits your alignment */
            }
        </style>
    </head>
    <body>
        <div class="container">
        
        
        
        <form class="form-horizontal">
        <fieldset>

        <!-- Form Name -->
        <legend style="text-align: center;"><h1>  OtterMart Product Search </h1></legend>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="product">Product :</label>  
            <div class="col-md-4">
                <input id="product" name="product" type="text" placeholder="Input Text" class="form-control input-md">
            </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="category">Category:</label>
          <div class="col-md-4">
            <select id="category" name="category" class="form-control">
              <option value="">Select One</option>
              <?=displayCategories()?>
            </select>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="priceFrom">Price: From:</label>  
          <div class="col-md-2">
              <input id="priceFrom" name="priceFrom" type="text" placeholder="" class="form-control input-md">
          </div>
          <label class="col-md-1 control-label" for="priceTo">To:</label>  
          <div class="col-md-2">
          <input id="priceTo" name="priceTo" type="text" placeholder="" class="form-control input-md">
            
          </div>
        </div>

        <!-- Multiple Radios -->
        <div class="form-group">
          <label class="col-md-5 control-label" for="orderBy">Order Results By:</label>
          <div class="col-md-4">
          <div class="radio">
            <label for="orderBy-0">
              <input type="radio" name="orderBy" id="orderBy-0" value="name" checked="checked">
              Product Name
            </label>
        	</div>
          <div class="radio">
            <label for="orderBy-1">
              <input type="radio" name="orderBy" id="orderBy-1" value="price">
              Price
            </label>
        	</div>
          </div>
        </div>
        <div class="form-group">
                     <input type="submit" value="Search" class="col-md-12 btn btn-success" name="searchForm" />
        </div>
        </fieldset>
        </form>
        <br />
        <hr>
        
        <?= displaySearchResults() ?>
    </div>
    </body>
</html>