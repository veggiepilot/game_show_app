<?php

class Game {

    private $phrase;
    private $lives = 5;
    private $scoreIconHtml = "";

    public function __construct(Phrase $phrase) {

        $this->phrase = $phrase;

    }

    /*Create a onscreen keyboard form. See the example_html/keyboard.txt file for an example of what the render HTML for the keyboard should look like. 
    If the letter has been selected the button should be disabled. Additionally, the class "correct" or "incorrect' should be added based on the checkLetter() method of the Phrase object. 
    Return a string of HTML for the keyboard form. */
    public function displayKeyboard() {

        $keyboard =
        "<form method='POST' action='play.php'>
        <div id='qwerty' class='section'>
            <div class='keyrow'>".

                $this->letter('q').
                $this->letter('w').
                $this->letter('e').
                $this->letter('r').
                $this->letter('t').
                $this->letter('y').
                $this->letter('u').
                $this->letter('i').
                $this->letter('o').
                $this->letter('p').
                
            "</div>

            <div class='keyrow'>".
                $this->letter('a').
                $this->letter('s').
                $this->letter('d').
                $this->letter('f').
                $this->letter('g').
                $this->letter('h').
                $this->letter('j').
                $this->letter('k').
                $this->letter('l').
                
            "</div>

            <div class='keyrow'>".
                $this->letter('z').
                $this->letter('x').
                $this->letter('c').
                $this->letter('v').
                $this->letter('b').
                $this->letter('n').
                $this->letter('m').
            "</div>
        </div>
    </form>";

    return $keyboard;

    }

    /*Display the number of guesses available. See the example_html/scoreboard.txt file for an example of what the render HTML for a scoreboard should look like. 
    Return string HTML of Scoreboard.*/
    public function displayScore() {

        for ($i = 0; $i < $this->lives - $this->phrase->numberLost(); $i++) {
   
            $this->scoreIconHtml .= "<li class='tries'><img src='images/liveHeart.png' height='35px' widght='30px'></li>";    
      
        }

        for ($x = 0; $x < $this->phrase->numberLost(); $x++ ) {

            $this->scoreIconHtml .= "<li class='tries'><img src='images/lostHeart.png' height='35px' widght='30px'></li>";
            
        }

        return $this->scoreIconHtml;

    }

    public function letter ($letter) {
        
        if (!in_array($letter, $this->phrase->getSelected())) {

            $outcome =  "<button class='key' name='key' value='".$letter."'>".$letter."</button>";
            return $outcome;
        }

        if ($this->phrase->checkLetter($letter)) {

            $outcome = "<button class='key' name='key' value='".$letter."' style='background-color: green'>".$letter."</button>";
            return $outcome;

        } else {

            $outcome = "<button class='key' name='key' value='".$letter."' style='background-color: red' disabled>".$letter."</button>";
        }

        return $outcome;
 
    }

    //this method checks to see if the player has selected all of the letters.
    public function checkForWin() {

        $matchArray = array_intersect($this->phrase->getLetterArray(), $this->phrase->getSelected());

        if (count($matchArray) == count($this->phrase->getLetterArray())) {

            return true;

        }

    }

    //this method checks to see if the player has guessed too many wrong letters.
    public function checkForLose() {

        if ($this->phrase->numberLost() == 5) {

            return true;

        }
    
    }

    //this method displays one message if the player wins and another message if they lose. It returns false if the game has not been won or lost.
    public function gameOver() {

        if ($this->checkForLose()) {

            $message = "<h1 id='game-over-message'>The phrase was: '". $this->phrase->getCurrentPhrase()."'. Better luck next time!</h1>
            <form action='play.php' method='POST'>
                <input id='btn__reset' type='submit'  name='restart' value='Restart Game' />
            </form>";

            return $message;

        }

        if ($this->checkForWin()) {

            $message = "<h1 id='game-over-message-won'>Congratulations on guessing: '".$this->phrase->getCurrentPhrase()."'.</h1>
            <form action='play.php' method='POST'>
                <input id='btn__reset' type='submit'  name='restart' value='Restart Game' />
            </form>";

            return $message;

        }

    }

}

