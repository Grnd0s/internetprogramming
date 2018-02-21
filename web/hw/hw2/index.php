<?php 
session_start();

if (!isset($_SESSION['Player1Wins']))
{
    $_SESSION['Player1Wins'] = 0;
    $_SESSION['Player2Wins'] = 0;
}

$_SESSION['Player1'] = 0;
$_SESSION['Player2'] = 0;

$cards = array("paper", "rock", "scissor");

function getRandCard($cards)
{
    $randomIndex = rand(0,2);
    return $cards[$randomIndex];
}
function getWinner($Player1, $Player2)
{
    if ($Player1 == "paper")
    {
        if ($Player2 == "paper")
            return -1;
        else if ($Player2 == "rock")
            return 1;
        else
            return 0;
    }
    else if ($Player1 == "rock")
    {
        if ($Player2 == "paper")
            return 0;
        else if ($Player2 == "rock")
            return -1;
        else
            return 1;
    }
    else 
    {
        if ($Player2 == "paper")
            return 1;
        else if ($Player2 == "rock")
            return 0;
        else
            return -1;
    }
}
function displayScore($Score)
{
    if ($Score == 1)
    {
        echo '<span class="score glyphicon glyphicon-menu-up"></span>';
        $_SESSION['Player1'] += 1;
    }
    else if ($Score == -1)
        echo '<span class="score glyphicon glyphicon-minus"></span>';
    else
    {
        echo '<span class="score glyphicon glyphicon-menu-down"></span>';
        $_SESSION['Player2'] += 1;
    }        
}

function displayCard($card)
{
    if ($card == "paper")
        echo '<img src="img/paper.png" alt="paper" />';
    else if ($card == "rock")
        echo '<img src="img/rock.png" alt="rock" />';
    else
        echo '<img src="img/scissor.png" alt="scissor" />';
}

function play($nbreRound, $cards)
{
    $Player1Hand = array();
    $Player2Hand = array();
    
    
    for ($i = 0; $i < $nbreRound; $i++) 
    {
        array_push($Player1Hand, getRandCard($cards));
        array_push($Player2Hand, getRandCard($cards));
    }
    foreach ($Player1Hand as $card) 
    {
        displayCard($card);
    }
    echo '</br>';
    
    
    for ($i = 0; $i < $nbreRound; $i++) 
    {
        $RoundScore = getWinner($Player2Hand[$i], $Player1Hand[$i]);
        displayScore($RoundScore);
    }
    
    echo '</br>';
    foreach ($Player2Hand as $card) 
    {
        displayCard($card);
    }
 
    echo '</br>';
    echo "<h2 style='display: inline-block;'><b>" . $_SESSION['Player2'] ." - " . $_SESSION['Player1'] ."</b></h2>";
    
    if ($_SESSION['Player1'] < $_SESSION['Player2'])
    {
        $_SESSION['Player1Wins']++;
        echo '<h1 id="winner">Player1 Wins</h1>';
    }
    else if ($_SESSION['Player1'] == $_SESSION['Player2'])
    {
        echo '<h1 id="winner">No one Wins</h1>';
    }
    else 
    {
        $_SESSION['Player2Wins']++;
        echo '<h1 id="winner">Player2 Wins</h1>';
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style>
            @import url("css/style.css");
        </style>
    </head>
    <body>
        <div id="game">
            <h1 class="rainbow"><b>Paper Rock Scissor</b></h1>
            <?php 
            play(20, $cards);?>
            
            <form>
                <input type="submit" class="btn btn-success" value="Try Again"/>
            </form>
            <div id="stats">
                <h1>Stats</h1>
                <ul>
                    <li>Player 1 : <?= $_SESSION['Player1Wins'] ?></li>
                    <li>Player 2 : <?= $_SESSION['Player2Wins'] ?></li>
                </ul>
            </div>
        </div>
    </body>
</html>