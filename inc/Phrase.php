<?php

class Phrase {

    private $currentPhrase; 
    private $selected;
    public  $phrases = [

        'Boldness be my friend',
        'Leave no stone unturned',
        'Broken crayons still color',
        'The adventure begins',
        'Dream without fear',
        'Love without limits'

    ];
    private $string = "";

    public function __construct($phrase = "", $selected = []) {

        if (!empty($phrase) && !empty($selected))  {

            $this->currentPhrase = $phrase;

        } else {

            shuffle($this->phrases);
            $this->currentPhrase = $this->phrases[0];
            
        }

        $this->selected = $selected;

    }

    /*Builds the HTML for the letters of the phrase. Each letter is presented by an empty box, one list item for each letter. 
    See the example_html/phrase.txt file for an example of what the render HTML for a phrase should look like when the game starts. 
    When the player correctly guesses a letter, the empty box is replaced with the matched letter. Use the class "hide" to hide a letter and "show" to show a letter. 
    Make sure the phrase displayed on the screen doesn't include boxes for spaces*/
    public function addPhraseToDisplay() {

        $characters = str_split(strtolower($this->currentPhrase));

        foreach ($characters as $character) {

            if ($character != " ") {

                if (in_array($character, $this->selected)) {

                    $this->string .=  "<li class='show letter h'>$character</li>";

                } else {

                    $this->string .=  "<li class='hide letter h'>$character</li>";

                }

            } else {

                $this->string .= "<li class='hide space'> </li>";
            }

        }

        return $this->string;
  
    }

    /*checks to see if a letter matches a letter in the phrase. 
    Accepts a single letter to check against the phrase. Returns true or false.*/
    public function checkLetter($letter) {

        $uniqueCharacters = array_unique(str_split(str_replace(' ', '', strtolower($this->currentPhrase))));

        return in_array($letter, $uniqueCharacters);

    }

    public function getLetterArray() {

        $uniqueCharacters = array_unique(str_split(str_replace(' ', '', strtolower($this->currentPhrase))));

        return $uniqueCharacters;
        
    }

    public function getSelected() {

        return $this->selected;

    }

    public function getCurrentPhrase() {

        return $this->currentPhrase;
    }

    public function numberLost() {

        $count = count(array_diff($this->selected, $this->getLetterArray()));

        return $count; 
        
    }
    


  
}



