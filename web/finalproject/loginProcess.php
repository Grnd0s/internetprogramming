<?php

    session_start();

    //print_r($_POST);  //displays values passed in the form
    
    include 'config/db.php';
    
    $conn = getDatabaseConnection("finalproject");
    
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    
    //echo $password;
    
     //following sql does not prevent SQL injection
    $sql = "SELECT * 
            FROM user
            WHERE username = '$username'
            AND   password = '$password'";
            
    //following sql prevents sql injection by avoiding using single quotes        
    $sql = "SELECT * 
            FROM user
            WHERE username = :username
            AND   password = :password";    
            
    $np = array();
    $np[":username"] = $username;
    $np[":password"] = $password;
    
            
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $record = $stmt->fetch(PDO::FETCH_ASSOC); //expecting one single record
    
    //print_r($record);

    if (empty($record)) {
        
        $_SESSION['loginError'] = "Wrong username or password!";
        header("Location:login.php");
    } else {
        
        if (isset($_SESSION['loginError'])) unset($_SESSION['loginError']);
            //echo $record['firstName'] . " " . $record['lastName'];
            $_SESSION['username'] = $record['username'];
            $_SESSION['login'] = 1;
            $_SESSION['isAdmin'] = $record['userAdmin'];
            header("Location:admin/index.php");
        
    }

?>