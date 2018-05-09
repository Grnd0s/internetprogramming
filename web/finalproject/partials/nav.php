<?php
session_start();
require_once 'config/db.php';
$conn = getDatabaseConnection("finalproject");
function displayNavCat()
{
    global $conn;
    $sql="SELECT * FROM categories";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $cat) 
    {
        echo '<li class="nav-item ';
        echo $_SESSION['currentPage'] == "category.php?cat=" . $cat['catId'] ? "active" : "";
        echo '" ><a class="nav-link" href="category.php?cat=' . $cat['catId'] . '">' . $cat['catName'] . '</a></li>';
    }
}
?>


        <!--<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
                
                    <div class='navbar-header'>
                        <a class='navbar-brand' href='#'>LPH</a>
                    </div>
                    <ul class='nav navbar-nav navbar-left'>
                        <li><a href='index.php'>Home</a></li>
                        <?php //displayNavCat();?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="search.php" class="navbar-link"><span class="glyphicon glyphicon-search"></span> Search</a></li>
                        <?php 
                       /*     if ($_SESSION['login'] == 0)
                            {
                                echo '<li><a href="login.php">Log In</a></li>';
                            }
                            else 
                            {
                                echo '<li><a href="#" class="navbar-link">Signed in as ' . $_SESSION['username'] . '</a></li>';
                                echo '<li><a href="logout.php"><span class="glyphicon glyphicon-off"></span></a></li>';
                            }*/
                        ?>
                    </ul>
                </div>
            </nav>-->
            
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="#">LPH</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item <?= $_SESSION['currentPage'] == 'index.php' ? "active" : "" ?>">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php displayNavCat();?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
                <li><a href="search.php" class="nav-link"><i class="fas fa-search"></i> Search</a></li>
                <?php 
                    if ($_SESSION['login'] == 0)
                    {
                        echo '<li class="nav-item"><a class="nav-link" href="login.php">Log In</a></li>';
                    }
                    else 
                    {
                        echo '<li class="nav-item"><a href="#" class="nav-link">Signed in as ' . $_SESSION['username'] . '</a></li>';
                        if ($_SESSION['isAdmin'] == 1) echo '<li class="nav-item"><a href="admin/index.php" class="nav-link"><i class="fa fa-cog"></i></a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="logout.php"><i class="fas fa-power-off"></i></a></li>';
                    }
                ?>
            </ul>
        </div>
      </nav>
        <main role="main" class="container">