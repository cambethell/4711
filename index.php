<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if(!isset($_GET['board'])) {
            $position = "---------";
        }
        else {
            $position = $_GET['board'];
        }
        
        $squares = str_split($position);
        //main game logic
        $game = new Game($squares);
        if ($game->winner('x')) {
            echo 'You win. Lucky guesses!';
        }
        else if ($game->winner('o')) {
            echo 'I win. Muahahahaha';
        }
        else {
            echo 'No winner yet, but you are losing.';
        }
        
        class Game {
            var $posi;
            var $result;
            function _construct($squares) {
                $this->posi = $squares;
            }
            
            function winner($token) {
                //check cols/////////
                echo $this->posi[0];
                for($row=0;$row<3;$row++) {
                    $result = true;
                    for($col=0;$col<3;$col++) {
                        if ($this->posi[3*$row+$col] != $token) {
                            echo $this->posi[3*$row+$col];
                            $result=false;
                        }
                    }
                    if($result == true) {
                        break;
                    }
                }
                if ($result) {
                    return true;
                }
                //check rows/////////
                for($row=0;$row<3;$row++) {
                    $result = true;
                    for($col=0;$col<3;$col++) {
                        if ($this->posi[$row+3*$col] != $token) {
                            $result=false;
                        }
                    }
                    if($result == true) {
                        break;
                    }
                }
                if ($result) {
                    return true;
                }
                //check diag/////////
                if(($this->posi[0] == $token) &&
                   ($this->posi[4] == $token) &&
                   ($this->posi[8] == $token)) {
                    $result = true;
                }
                if(($this->posi[6] == $token) &&
                   ($this->posi[4] == $token) &&
                   ($this->posi[2] == $token)) {
                    $result = true;
                }
                return $result;
            }
        }
        ?>
    </body>
</html>
