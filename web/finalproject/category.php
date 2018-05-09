<?php 
    session_start();
    include('partials/header.php');
    require_once 'config/db.php';
    $conn = getDatabaseConnection("finalproject");
    $catId = "";
    $catName = "";
    $contents;
    function getCat()
    {
        global $conn;
        global $catId;
        global $catName;
        $sql = "SELECT * FROM categories WHERE catId = :id";
        $param = array();
        $param[':id'] = $_GET['cat'];
        $statement = $conn->prepare($sql);
        $statement->execute($param);
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        $catId = $record['catId'];
        $catName = $record['catName'];
    }
    function getAllContent()
    {
        global $conn;
        global $catId;
        $sql = "SELECT * FROM content WHERE catId = :catId";
        $param = array();
        $param[':catId'] = $catId;
        $statement = $conn->prepare($sql);
        $statement->execute($param);
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $records;
    }
    if (isset($_GET['cat']))
    {
        getCat();
        $contents = getAllContent();
        $_SESSION['currentPage'] = 'category.php?cat=' . $_GET['cat'];
    }
?>
    <body id="categoryPage">
        <?php include('partials/nav.php');?>
            <h1 style="text-align: center;"><?= $catName ?></h1>
            <div id="all_projets">
            <?php 
                $cardId = 1;
                $countCard = 0;
                foreach($contents as $content)
                {
                    if ($return == 3)
                    {
                        echo '<br />';
                        $return = 0;
                    }
                    echo '<div class="card_projet" style="background: white;">';
                    echo '<a href="content.php?id=' . $content['contentId'] . '">';
                    echo '<div class="voile_card">';
                    echo '<span class="id">#' . $cardId . '</span> - ' . $content['contentTitle'] . '</div></a>';
                    echo '</div>';
                    $cardId++;
                    $countCard++;
                }
            ?>
        
        </div>
    <?php include('partials/footer.php');?>
 