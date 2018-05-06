<?php

    include 'inc/header.php';
    include '../../../db.php';
    
    $conn = getDatabaseConnection('pets');
    
    $sql = "SELECT name, pictureURL FROM pets";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $pictures = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

        <!-- Add Carousel here -->
        
        <!-- -------------------------------------------------------------------------------------------- -->
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" style="background-color: #dfe6e9;">
           <!-- <ol class="carousel-indicators">
                <?php 
                    for ($i = 0; $i < count($pictures); $i++) 
                    {
                        echo "<li data-target='#carouselExampleIndicators' data-slide-to='$i'";
                        echo ($i == 0) ? " class='active'" : "";
                        echo "></li>";
                    }
                ?>
        </ol>-->
        <div class="carousel-inner">
            <?php
                    for ($i = 0; $i < count($pictures); $i++)
                    {
                        echo '<div class="carousel-item ';
                        echo ($i == 0) ?"active":"";
                        echo '">';
                        echo '<img class="w-30" src="img/'. $pictures[$i]['pictureURL'] .'">';
                        echo '<div class="carousel-caption d-none d-md-block">
                                <h5>' . $pictures[$i]['name'] . '</h5>
                              </div>';
                        echo '</div>';
                        
                    }
                ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleSlidesOnly" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleSlidesOnly" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
        <br>
        
        <a href="adoptions.php"  class="btn btn-outline-primary" role="button" aria-pressed="true"> Adopt Now! </a>
        
        
        <br>
        

<?php

    include 'inc/footer.php';

?>