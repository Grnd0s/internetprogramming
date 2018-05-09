<?php include('partials/header.php');?>
    <body>
        <?php include('partials/nav.php');?>
            <h1 style="text-align: center;"> Login In</h1>
              <form class="form-signin" method="POST" action="loginProcess.php">
                <?php
                    if (isset($_SESSION['loginError']))
                    {
                        echo '<div class="alert alert-danger alert-dismissible" role="alert" style="position: block;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Error!</strong> ' . $_SESSION['loginError'] . '
                        </div>';
                    }
                    ?>
                    <h2 class="form-signin-heading">Please sign in</h2>
                    <label for="username" class="sr-only">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                    <button class="btn btn-success btn-block" type="submit" name="submitForm">Login</button>
              </form>
       <?php include('partials/footer.php');?>