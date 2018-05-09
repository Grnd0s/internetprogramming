<?php
require_once('../config/db.php');
$conn = getDatabaseConnection('finalproject');

$sql = "SELECT * FROM content WHERE 1";
$param = array();

if (isset($_POST['contentTitle']) && !empty($_POST['contentTitle']))
{
    $sql .= " AND contentTitle LIKE :contentTitle";
    $param[':contentTitle'] = "%" . $_POST['contentTitle'] . "%";
}
if (isset($_POST['category']) && !empty($_POST['category']))
{
    $sql .= " AND catId = :catId";
    $param[':catId'] = $_POST['category'];
    
}
if (isset($_POST['nameD']) && $_POST['nameD'] == 1)
{
    $sql .= " ORDER BY contentTitle DESC";
}
if (isset($_POST['nameA']) && $_POST['nameA'] == 1)
{
    $sql .= " ORDER BY contentTitle ASC";
}
if (isset($_POST['author']) && $_POST['author'] == 1)
{
    $sql .= " ORDER BY contentAuthor";
}
if (isset($_POST['date']) && $_POST['date'] == 1)
{
    $sql .= " ORDER BY contentDate";
}

$stmt = $conn->prepare($sql);
$stmt->execute($param);
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($records);

?>