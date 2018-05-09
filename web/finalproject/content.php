<?php 
    session_start();
    include('partials/header.php');
    require_once 'config/db.php';
    $conn = getDatabaseConnection("finalproject");
    
    function getCat()
    {
        global $content;
        global $conn;
        $sql = "SELECT * FROM categories WHERE catId = :catId";
        $param = array();
        $param[':catId'] = $content['catId'];
        $statement = $conn->prepare($sql);
        $statement->execute($param);
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        return $record;
    }
    function getContent()
    {
        global $conn;
        $sql = "SELECT * FROM content WHERE contentId = :contentId";
        $param = array();
        $param[':contentId'] = $_GET['id'];
        $statement = $conn->prepare($sql);
        $statement->execute($param);
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        return $record;
    }
    if (isset($_GET['id']))
    {
        $content = getContent();
        $cat = getCat();
    }
?>
    <body>
        <?php include('partials/nav.php');?>
            <h3><b><?= $content['contentTitle'] ?> - <?= $cat['catName'] ?></b></h3>
            <?= $content['content'] ?>
            <em>Written by <b><?= $content['contentAuthor'] ?></b></em>
    <?php include('partials/footer.php');?>
 