<?php
ini_set('display_errors', 1);
$error = 0;
if (isset($_POST['btn_reset']))
{
    unset($_POST['name']);
    unset($_POST['email']);
    unset($_POST['topic']);
    unset($_POST['subscribe']);
    unset($_POST['gender']);
}
if (isset($_POST['btn_submit']))
{
    if (!isset($_POST['termsandconditions']))
    {
        echo '<div class="alert alert-warning" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Warning:</span>
            You need to accept Terms and Conditions ! 
            </div>';
        $error++;
    }
    if (!isset($_POST['name']))
    {
       echo '<div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            You need to enter a valid Name ! 
            </div>';
        $error++;
    }
    if (!isset($_POST['gender']))
    {
       echo '<div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            You need to select a gender ! 
            </div>';
        $error++;
    }
    if (!isset($_POST['subscribe']))
    {
       echo '<div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            You need to select a subscribing time ! 
            </div>';
        $error++;
    }
    if (!isset($_POST['topic']))
    {
       echo '<div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            You need to select a valid topic ! 
            </div>';
        $error++;
    }
    if (isset($_POST['email']))
    {
        $email = mysql_escape_string($_POST['email']);
        if (!isEmailValid($email))
        {
            echo '<div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            Pleaser enter a valid email adress ! 
            </div>';
            $error++;
        }
    }
    if ($error == 0)
    {
        /*echo '<div class="alert alert-success" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Success:</span>
             You\'ve been successfully register to the newsletter with the email <b>' . $_POST['email'] . '</b> for ' . getSubscribeTime($_POST['subscribe']) . ' to the ' . 
             getTopic($_POST['topic']) . ' topic
            </div>';*/
        $email = mysql_escape_string($_POST['email']);
        $name = mysql_escape_string($_POST['name']);
        sendConfirmMail($email, $name);
    }
}

function getSubscribeTime($id)
{
    switch ($id) {
        case 1:
            return "6 months";
        case 2:
            return "1 year";
        case 3:
            return "2 years";
        default:
            return "undetermined time";
    }
}
function getTopic($id)
{
    switch ($id) {
        case 0:
            return "History";
        case 1:
            return "Business";
        case 2:
            return "Computer Science";
        case 3:
            return "Physics";
        case 4:
            return "Chemistry";
        case 5:
            return "Language";
        default:
            return "all topic";
    }
}
function isEmailValid($email)
{
    if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email))
    {
        // Return Error - Invalid Email
        return false;
    }
    else
    {
        // Return Success - Valid Email
        return true;
    }
}
function sendConfirmMail($email, $name)
{
    $message = "Welcome " . $name ." to the Newsletter ! \n
                You have chose " . getTopic($_POST['topic']) . " for " . getSubscribeTime($_POST['subscribe']) . " !\n
                Thanks for youre registration.";
                
    $dest = $email; 
 
    $object = "[NEWSLETTER] " . $name . " : successful registration"; // On définit l'objet qui contient la date.
 
    // On définit le reste des paramètres.
    $headers  = 'MIME-Version: 1.0' . '\r\n';
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . '\r\n';
    $headers .= 'From: pverhaeghe@csumb.edu' . '\r\n'; // On définit l'expéditeur.
    $headers .= 'Bcc:' . $dest . '' . '\r\n'; // On définit les destinataires en copie cachée pour qu'ils ne puissent pas voir les adresses des autres inscrits.
    
    if (mail($dest, $object, $message, $headers))
    {
          echo '<div class="alert alert-success" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Success:</span>
                Successful registration an Email have been sent to : ' .  $email .'</div>';
    }
    else
    {
      echo '<div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            Something Wrong happened, the email adress might not working !</div>';
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> HW3 </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
    <form class="form-horizontal" method="POST">
    <fieldset>
    
    <!-- Form Name -->
    <legend>Newsletter Form</legend>
    
    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="name">Name</label>  
      <div class="col-md-3">
      <input id="name" name="name" type="text" placeholder="Name" class="form-control input-md" required="" value="<?= isset($_POST['name']) ? $_POST['name'] : "" ?>">
        
      </div>
    </div>
    
    
    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="email">Email</label>  
      <div class="col-md-3">
      <input id="email" name="email" type="text" placeholder="Email" class="form-control input-md" required="" value="<?= isset($_POST['email']) ? $_POST['email'] : "" ?>">
        
      </div>
    </div>
    
    <!-- Multiple Radios -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="gender">Gender</label>
      <div class="col-md-4">
      <div class="radio">
        <label for="gender-0">
          <input type="radio" name="gender" id="gender-0" value="1" <?= isset($_POST['gender']) && $_POST['gender'] == 1 ? "checked" : "" ?>>
          Male
        </label>
    	</div>
      <div class="radio">
        <label for="gender-1">
          <input type="radio" name="gender" id="gender-1" value="0" <?= isset($_POST['gender']) && $_POST['gender'] == 0 ? "checked" : "" ?>>
          Female
        </label>
    	</div>
      </div>
    </div>
    
    <!-- Select Basic -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="topic">News Topic</label>
      <div class="col-md-2">
        <select id="topic" name="topic" class="form-control">
          <option value="0" <?= isset($_POST['topic']) && $_POST['topic'] == 0 ? "selected" : "" ?>>History</option>
          <option value="1" <?= isset($_POST['topic']) && $_POST['topic'] == 1 ? "selected" : "" ?>>Business</option>
          <option value="2" <?= isset($_POST['topic']) && $_POST['topic'] == 2 ? "selected" : "" ?>>Computer Science</option>
          <option value="3" <?= isset($_POST['topic']) && $_POST['topic'] == 3 ? "selected" : "" ?>>Physics</option>
          <option value="4" <?= isset($_POST['topic']) && $_POST['topic'] == 4 ? "selected" : "" ?>>Chemistry</option>
          <option value="5" <?= isset($_POST['topic']) && $_POST['topic'] == 5 ? "selected" : "" ?>>Language</option>
        </select>
      </div>
    </div>
    
    <!-- Multiple Checkboxes -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="subscribe">Subscribe for :</label>
      <div class="col-md-4">
      <div class="radio">
        <label for="subscribe-0">
          <input type="radio" name="subscribe" id="subscribe-0" value="1" <?= isset($_POST['subscribe']) && $_POST['subscribe'] == 1 ? "checked" : "" ?>>
          6 Months
        </label>
    	</div>
      <div class="radio">
        <label for="subscribe-1">
          <input type="radio" name="subscribe" id="subscribe-1" value="2" <?= isset($_POST['subscribe']) && $_POST['subscribe'] == 2 ? "checked" : "" ?>>
          1 year
        </label>
    	</div>
      <div class="radio">
        <label for="subscribe-2">
          <input type="radio" name="subscribe" id="subscribe-2" value="3" <?= isset($_POST['subscribe']) && $_POST['subscribe'] == 3 ? "checked" : "" ?>>
          2 years
        </label>
    	</div>
      <div class="radio">
        <label for="subscribe-3">
          <input type="radio" name="subscribe" id="subscribe-3" value="4" <?= isset($_POST['subscribe']) && $_POST['subscribe'] == 4 ? "checked" : "" ?>>
          for life
        </label>
    	</div>
      </div>
    </div>
    
    
    <!-- Multiple Checkboxes (inline) -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="termsandconditions">Terms and conditions</label>
      <div class="col-md-4">
        <label class="checkbox-inline" for="termsandconditions">
          <input type="checkbox" name="termsandconditions" id="termsandconditions" value="1">
          i agree
        </label>
      </div>
    </div>
    <!-- Button (Double) -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="btn_submit"></label>
      <div class="col-md-8">
        <button id="btn_submit" name="btn_submit" class="btn btn-success" value="submit">Register</button>
        <button id="btn_reset" name="btn_reset" class="btn btn-danger" value="reset">Cancel</button>
      </div>
    </div>
    </form>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </body>
</html>