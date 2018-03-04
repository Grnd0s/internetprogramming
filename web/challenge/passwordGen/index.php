<?php
    
    
    function generatePassword($numberOfPassword)
    {
        $passwords = array();
        for ($j = 0; $j < $numberOfPassword; $j++) 
        {
            $password = array();
            
            $len = rand(5,10);
            for ($i = 0; $i < $len; $i++) 
            {
                   
                array_push($password, generateRandLetter());
            }
            $digits = rand(1,3);
            for ($i = 0; $i < $digits; $i++) {
                 array_push($password, rand(0,9));
            }
            
            shuffle($password);
            array_push($passwords, $password);
        }
        return $passwords;
    }
    
    function generateRandLetter()
    {
                return chr(rand(65, 90));
    }
    
    
    function displayPassword($passwords)
    {
        for ($i = 0; $i < count($passwords); $i++) 
        {
           /* $tmp = "";
           for ($j = 0; $j < count($passwords[$i]); $j++) 
           {
               $tmp += $passwords[$i][$j]; 
           }*/
           echo $i . ": ";
           echo implode($passwords[$i]) . "<br \>";
           //echo $tmp;
        }
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Challenge: Passwords </title>
    </head>
    <body>
        <?php
            $list = generatePassword(25);
            //var_dump($list);
            displayPassword($list);
        ?>
    </body>
</html>