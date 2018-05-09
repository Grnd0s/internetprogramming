<?php

session_start();
if(!isset($_SESSION['login']) && $_SESSION['login'] != 1)
{
  header("Location:../login.php");
}
if (!isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] != 1)
{
  header("Location:../index.php");  
}
require_once '../config/db.php';
$conn = getDatabaseConnection("finalproject");

function displayAllUsers(){
    global $conn;
    $sql="SELECT * FROM user";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    //print_r($records);

    return $records;
}

include('partials/header.php');?>
    <body>
        <?php include('partials/nav.php');?>
        <h1> Admin Main Page </h1>
        
        <h3> Welcome <?=$_SESSION['username']?>! </h3>
        
        <br />
        <form action="addUser.php">
            <input class="btn btn-success" type="submit" name="addUser" value="Add New User"/>
        </form>
        
        <br />
        <strong> Users: </strong> <br />
        <ul class="list-group">
        <?php $records=displayAllUsers();
            foreach($records as $record) 
            {
                echo '<li class="list-group-item" style="font-size: 18px;">';
                echo '<a href="updateUser.php?userId=' . $record['userId'] .'"><i class="fas fa-cog"></i></a> ';
                echo '<a href="deleteUser.php?userId=' . $record['userId'] .'"><i class="fas fa-trash-alt"></i></a> ';
                echo $record['userAdmin'] == 1 ? "<a href='adminRight.php?userId=" . $record['userId'] ."'><i class='fas fa-user' style='color: red;'></i></a>" : "<a href='adminRight.php?userId=" . $record['userId'] ."'><i class='fas fa-user' style='color: green;'></i></a>";
                echo " - " . $record['username'];
                
                //echo '<br>';
                echo '</li>';
            }
        
        ?>
        </ul>
        <p style="text-align: center;font-size: 20px;">
            <i class="fas fa-user" style='color: red;'></i><b> Admin</b>
            <i class="fas fa-user" style='color: green;'></i><b> User</b>
        </p>
   <?php include('partials/footer.php');?>
 