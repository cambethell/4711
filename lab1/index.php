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
        //if the board isn't set, we initialize it to be empty
        if(!isset($_GET['board'])) {
            $position = "---------";
        }
        else {
            $position = $_GET['board'];
        }
        
        //main game logic
        $squares = str_split($position);
        $game = new Game($squares);
        //check for winners
        if ($game->winner('x')) {
            echo 'You win. Lucky guesses!';
        }
        else if ($game->winner('o')) {
            echo 'I win. Muahahahaha';
        }
        else {
            //make a move. if the computer wins, end here!
            //else display the game and continue
            $game->move();
            if( $game->winner('o')) {
                echo 'I win. Muahahahaha';
            }
            else {
                $game->display();
            }
        }
        
        //game class!
        class Game {
            var $posi;
            var $newposi;
            var $result;
            //constructor for the Game
            function __construct($squares) {
                $this->posi = $squares;
            }
            
            //my winner function
            function winner($token) {
                //check cols/////////
                for($row=0;$row<3;$row++) {
                    $result = true;
                    for($col=0;$col<3;$col++) {
                        if ($this->posi[3*$row+$col] != $token) {
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
            
            //your display function
            function display() {
                echo '<table cols="3">';
                echo '<tr>';
                for ( $posi = 0; $posi < 9; $posi++ ) {
                    echo $this->showcell( $posi );
                    if( $posi % 3 == 2 )
                        echo '</tr><tr>';
                }
                echo '</tr>';
                echo '</table>';
            }
            
            //your showcell function
            function showcell( $cell ) {
                $token = $this->posi[$cell];
                if( $token <> '-' )
                    return '<td>' . $token . '</td>';
                $this->newposi = $this->posi;
                $this->newposi[$cell] = 'x';
                $move = implode( $this->newposi );
                $url = '?board=' . $move;
                return '<td><a href="' . $url . '">-</a></td>';
            }
            
            function move() {
                $game = null;
                //if the board isn't empty, do this stuff
                if( strcmp( implode( $this->posi ), '---------' ) != 0 ) {
                    //set the positions and track the empty spaces
                    $this->newposi = $this->posi;
                    for ( $i = 0, $j = 0; $i < sizeof( $this->posi ); $i++ ) 
                        if ( $this->posi[$i] == '-' )
                            $game[$j++] = $i;
                    //apply legal game logic
                    if( sizeof( $game ) > 1 ) {
                        $this->newposi[$game[array_rand( $game, 1 )]] = 'o';
                        $this->posi = $this->newposi;
                    }
                }
            }
        }
        ?>
    </body>
</html>
