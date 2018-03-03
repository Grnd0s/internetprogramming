<?php
	//Varaible for holding time
    $startTime  = microtime(true);
	//Start session
    session_start(); //start or resume a session
	//Check if there is a session
    if (!isset($_SESSION['gameCount'])) { 
        $_SESSION['gameCount'] = 1;
        $_SESSION['finalTime'] = 0;
    }
    // Returns an array of cards per player
    function retrieveHand(&$cards)
    {
         // Stores the hand of cards for player in an array
        $playerHand = array();
        $playerScore = 0;
        // Drawing another card if haven’t reached score
        while($playerScore <= 36)
        {
            $drawCard = rand(1, 13);
            $drawSuit = rand(0, 3);
            while($cards[13 * $drawSuit + $drawCard] == 1)
            {
                $drawCard = rand(1,13);
                $drawSuit = rand(0,3);
            }
        
            $cards[13 * $drawSuit + $drawCard] = 1;
            switch ($drawSuit) 
            {
                case 0: $drawSuit = "spades";
                    break;
                case 1: $drawSuit = "diamonds";
                    break;
                case 2: $drawSuit = "clubs";
                    break;
                case 3: $drawSuit = "hearts";
                    break;
            }
            
            $playerHand[] = $drawSuit;
            $playerHand[] = $drawCard;
            $playerScore = $playerScore + $drawCard;
            $i++;
        }
        $playerHand[] = $playerScore;
        return $playerHand;
    }
    
    function retrievePlayer($character, $total) 
    {
        echo "<h3>$character[$total]</h3>";
        echo "<img id='players' src=img/players/$character[$total].png>";
        return $character;
    }
    
    // Displays the array of cards per player along with the sum of points
    function showPlayerCards($playerHand)
    {
        for($i=0; $i<count($playerHand) - 1; $i++) 
        {
            $temp = $i + 1;
            echo "<img id='playerHand' src=cards/$playerHand[$i]/$playerHand[$temp].png>";
            $i++;
       }   
    }
    
    
    
        //Displays the Total / AVG Time for Games Played
    function displayTime()
    {
        global $startTime;
        $timeInSeconds = microtime(true) - $startTime;
        echo "<h3>This Game Took: " . $timeInSeconds . " in seconds (MicroTime) </h3><br /><br/>";
        echo "<h3>Total Matches:"  . $_SESSION['gameCount'] . "</h3><br />";
        $_SESSION['finalTime'] += $timeInSeconds;
        echo "<h3>Total Time for All Matches: " .  $_SESSION['finalTime'] . "</h3><br /><br />";
        echo "<h3>Average Time Per Game: " . ( $_SESSION['finalTime']  / $_SESSION['gameCount'])."</h3>";
        $_SESSION['gameCount']++; 
    } 
    
    //Display the winner base on a list of final score
    function displayWinner($score, $players)
    {
        //print_r($score);
        
        //print_r($players);
        
        $possible_winning_scores_array = array();
        
        for ($index=0; $index<4;$index++){
            if($score[$index] <= 42){
                array_push($possible_winning_scores_array,$score[$index]);
            }
        }
        
        $max_score =  (max($possible_winning_scores_array));
        //echo $max_score;
        $winning_index_array = array();
        
        for($index = 0;$index<4;$index++){
            if($score[$index]==$max_score){
                echo "</br><h1>".$players[$index]." WINS!</h1>";
            }
        }
    }
    
    // Play game function
    function startSilverJack() 
    {
        $players = array("Evert", "Simrit", "Pierre", "Logan");           
        $cards = array();
        $FinalScore = array();
        for($i=0; $i<52; $i++)
        {
            $cards[] = 0;
        }
        shuffle($cards);
        shuffle($players);
        
        for($i = 0; $i < 4; $i++)
        {
            $player[$i] = array();
            $playerScore = array();
            //Display Player Image and Name
            $player[$i] = retrievePlayer($players, $i);
            $player[$i] = retrieveHand($cards);
            //Display hand for the current Player
            showPlayerCards($player[$i]);
            //Get and display the Score of the curr Player
	        $playerScore[$i] = $player[$i][count($player[$i])-1];
	        
	        array_push($FinalScore, $playerScore[$i]);
	        echo '<span style="font-size: 30px;"><b>' . $playerScore[$i] . '</b></span>';
	        
        }
        
        displayWinner($FinalScore, $players);
        
        echo '<br /><br />';
        displayTime();
    }
?>



<!DOCTYPE html>
<html>
    <style type="text/css" href ="css/styles.css" rel ="styles">
    
  
    
    body {
        background-color: darkgreen;
    }
     div  {
          background-image:url("img/border.jpg");
          text-align: left;
          color: red;
        }
        h1 {
            text-align: center;
            color: white;
            font-size: 4em;
            background-color: red;
        }
        
        h2 {
            text-align: center;
            padding: 150px;
            color: red;
            display: inline;
            font-size: 2em;
        }
        
        footer, #csumbLogo {
            text-align: center;
        }
        
    
    </style>
    <head>
        <title>Lab #3: SilverJack Card Game </title>
    </head>
    
     <h1 style="color:white;"> World Series of Poker</h1>
 
     
    <div>
      <?php 
      startSilverJack();
      ?>
      
    </div>
    
    <body>

    </body>
    
    <footer>
        <hr> CST 336 Internet Programming. 2018 &copy; Logan Louks<br />
                <strong> Disclaimer: <strong>
                  All information in this website belongs to Evert, Pierre, Simirit, and Logan and is used for Academic and Business purposes.
                  <a href="http://csumb.edu">California State University, Monterey Bay</a>
                   <p><img id ="csumbLogo" src="img/csumblogo.png"  alt ="Picture of CSU Monterey logo (Otter)" /></p>
    </footer>
    
</html>