<?php
session_start();
?>

        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="#">LPH</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active"><a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a></li>
            <li class="nav-item"><a class="nav-link" href='addContent.php'>Add</a></li>
            <li class="nav-item"><a class="nav-link" href='users.php'>Users</a></li>
            <li class="nav-item"><a class="nav-link" href='infobox.php'>Infobox</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="nav-item"><a href="../index.php" class="nav-link"><i class="fa fa-home"></i> Index</a></li>
                <?php 
                    if ($_SESSION['login'] == 0)
                    {
                        echo '<li class="nav-item"><a class="nav-link" href="login.php">Log In</a></li>';
                    }
                    else 
                    {
                        echo '<li class="nav-item"><a href="#" class="nav-link">Signed in as ' . $_SESSION['username'] . '</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="logout.php"><i class="fas fa-power-off"></i></a></li>';
                    }
                ?>
            </ul>
        </div>
      </nav>
        <div class="container">