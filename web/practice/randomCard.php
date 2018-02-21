<?php
session_start();

if(!isset($_SESSION['HumanWins']))
{
    $_SESSION['HumanWins'] = 0;
    $_SESSION['ComputerWins'] = 0;
}



$suits = array("Hearts","Spades","Clubs","Spades");
$cardValue = array("Ten","Jack","Queen","King","Ace");

function drawCard() {
    global $suits, $cardValue;
    
    $randomCard = array_rand($cardValue);
    echo $cardValue[$randomCard] . " <br />";
    echo $suits[array_rand($suits)];

    return $randomCard;
}

function displayWinner($human, $computer) {
    if ($human > $computer) {
        $_SESSION['HumanWins']++;
        echo "<h2> Human Wins </h2>";
    } else if  ($human < $computer) {
        $_SESSION['ComputerWins']++;
        echo "<h2> Computer Wins </h2>";
    } else {
        echo "<h2>Tie Game!";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Random Card Game </title>
        <link href="https://fonts.googleapis.com/css?family=Baloo+Tammudu" rel="stylesheet">
        <style>
            body {
                text-align: center;
                font-family: 'Baloo Tammudu', cursive;
            }
            div {
                display:inline-block;
                padding: 0px 30px;
            }
            #winner {
                color: green;
            }

        </style>
    </head>
    <body>

    <h1>Random Card Game</h1>
        
        <div>
            <h2>Human</h2>
            <?php
                $human = drawCard();
            ?>
        </div>
        <div>
            <h2>Computer</h2>
            <?php
                $computer = drawCard();
            ?>
        </div>
        
        <br>
        <div id="winner"> <h2><?=displayWinner($human, $computer)?> </h2></div>
        <br>
        
        <ul>
            <li>Human Wins = <?= $_SESSION['HumanWins']?></li>
            <li>Computer Wins = <?= $_SESSION['ComputerWins']?></li>
        </ul>
    
    </body>
</html>