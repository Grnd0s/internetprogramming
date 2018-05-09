<?php 
session_start();
include 'config/db.php';
$conn = getDatabaseConnection("finalproject");

function displayCategories()
{
    global $conn;
    $sql= "SELECT catId, catName FROM categories";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record) 
    {
        echo "<option value='".$record["catId"]."' >" . $record["catName"] . "</option>";
    }
}
function getInfobox()
{
  global $conn;
  $sql= "SELECT * FROM infobox WHERE 1 LIMIT 4";

  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  return $records;
}

$infos = getInfobox();
$_SESSION['currentPage'] = "index.php";

include('partials/functions.php');
include('partials/header.php');
?>
    <body>
        <?php include('partials/nav.php');?>
        
        <div class="card-columns">
  <div class="card">
    <!--<img class="card-img-top" src=".../100px160/" alt="Card image cap">-->
    <div class="card-body">
      <h5 class="card-title"><?= $infos[0]['infoTitle']; ?></h5>
      <p class="card-text"><?= $infos[0]['infoContent']; ?></p>
    </div>
  </div>
  <div class="card p-3">
    <blockquote class="blockquote mb-0 card-body">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
      <footer class="blockquote-footer">
        <small class="text-muted">
          Someone famous in <cite title="Source Title">Source Title</cite>
        </small>
      </footer>
    </blockquote>
  </div>
  <div class="card">
    <img class="card-img" src="img/pourqui.gif" alt="Card image">
  </div>
  <div class="card">
    <!--<img class="card-img-top" src=".../100px160/" alt="Card image cap">-->
    <div class="card-body">
      <h5 class="card-title"><?= $infos[1]['infoTitle']; ?></h5>
      <p class="card-text"><?= $infos[1]['infoContent']; ?></p>
      <p class="card-text"><small class="text-muted"><?= $infos[1]['infoAuthor']; ?></small></p>
    </div>
  </div>
  <div class="card bg-success text-white text-center p-3">
    <blockquote class="blockquote mb-0">
      <h4 style="color: white; text-align: center; text-shadow: 2px 1px 1px black;">LPH, the dedicated community site<br >
to learning Travian!</h4>
      <footer class="blockquote-footer" style="color: white">
        <small>
          <cite title="Source Title">The LPH Team</cite>
        </small>
      </footer>
    </blockquote>
  </div>
  <div class="card text-center">
    <div class="card-body">
      <h5 class="card-title"><?= $infos[2]['infoTitle']; ?></h5>
      <p class="card-text"><?= $infos[2]['infoContent']; ?></p>
      <p class="card-text"><small class="text-muted"><?= $infos[2]['infoAuthor']; ?></small></p>
    </div>
  </div>
  <div class="card">
    <img class="card-img" src="img/LPH.gif" alt="Card image">
  </div>
  <div class="card p-3 text-right">
    <blockquote class="blockquote mb-0">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
      <footer class="blockquote-footer">
        <small class="text-muted">
          Someone famous in <cite title="Source Title">Source Title</cite>
        </small>
      </footer>
    </blockquote>
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title"><?= $infos[3]['infoTitle']; ?></h5>
      <p class="card-text"><?= $infos[3]['infoContent']; ?></p>
      <p class="card-text"><small class="text-muted"><?= $infos[3]['infoAuthor']; ?></small></p>
    </div>
  </div>
</div>
        
    <?php include('partials/footer.php');?>
 