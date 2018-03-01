<?php 
$backgroundImage = "img/sea.jpg"; 
    
if (isset($_GET['keyword']))
{
    if (empty($_GET['keyword']) && empty($_GET['category']))
    {
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'index.php';
        header("Location: http://$host$uri/$extra");
    }
    include 'api/pixabayAPI.php';
    echo "<h3>You searched for " . $_GET['keyword'] . "</h3>";
      
    $orientation = "horizontal";
    $keyword = $_GET['keyword'];
      
    if (isset($_GET['layout'])) $orientation = $_GET['layout'];
      
    if (!empty($_GET['category'])) $keyword = $_GET['category'];
    
    $imageURLs = getImageURLs($keyword, $orientation);
    $backgroundImage = $imageURLs[array_rand($imageURLs)];
}

function checkCategory($category)
{
    if ($category == $_GET['category']) echo " selected";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Image Carousel</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            @import url('css/styles.css');
            body 
            {
                background-image: url('<?= $backgroundImage ?>');
            }
            h3
            {
                color: green;
                font-size: 60px;
                background-color: white;
                margin: 0 auto;
                width: 50%;
                border: 2px solid green;
            }
        </style>
    </head>
    <body>
        <br/> <br/>
        <?php 
            if (!isset($imageURLs))
            {
                echo '<h2> Type a keyword to display a slidehsow <br /> with random images from Pixabay.com </h2>';
            }
            else 
            {
                //Display Carousel
                ?>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicator Here -->
            <ol class="carousel-indicators">
                <?php 
                    for ($i = 0; $i < 7; $i++) 
                    {
                        echo "<li data-target='#carousel-example-generic' data-slide-to='$i'";
                        echo ($i == 0) ? " class='active'" : "";
                        echo "></li>";
                    }
                ?>
            </ol>
            <!-- Wrapper for Images -->
            <div class="carousel-inner" role="listbox">
                <?php
                    for ($i = 0; $i < 7; $i++) 
                    {
                        do {
                            $randomIndex = rand(0, count($imageURLs));
                        } 
                        while (!isset($imageURLs[$randomIndex]));
                        
                        echo '<div class="carousel-item ';
                        echo ($i == 0) ?"active":"";
                        echo '">';
                        echo '<img src="'. $imageURLs[$randomIndex] .'">';
                        echo '</div>';
                        unset($imageURLs[$randomIndex]);
                    }
                ?>
            </div>
            <!-- Controls Here -->
            <a class="left carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            
        </div>
        <a href="index.php"><button class="btn btn-danger">Go Back</button></a>
        <?php } ?>
        <br />
        <?php 
            if (!isset($_GET['keyword']))
            {
        ?>
                <form method="GET">
                    <input type="text" size="20" name="keyword" placeholder="Keyword to search for" value="<?=$_GET['keyword']?>"/>
                    <input type="radio" name="layout" value="horizontal" id="hlayout" <?php if ($_GET['layout'] == "horizontal") echo "checked";?>>
                    <label for="hlayout"> Horizontal </label>
                    
                    <input type="radio" name="layout" value="vertical" id="vlayout" <?= ($_GET['layout']=="vertical")?"checked":"" ?>>
                    <label for="vlayout"> Vertical </label>
                    
                    <select name="category">
                        <option value="" >  Select One </option> 
                        <option value="sea" <?=checkCategory('sea')?>>  Ocean </option>
                        <option <?=checkCategory('Forest')?>>  Forest </option>
                        <option <?=checkCategory('Sky')?>>  Sky </option>
                    </select>
                    
                    <input type="submit" value="Submit!"/>
                            
                </form>
        <?php
            }
        ?>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>