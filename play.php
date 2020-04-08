<?php
session_start();

if (isset($_POST['start']) || isset($_POST['restart'])) {

    $_SESSION['phrase'] = "";
    $_SESSION['selected'] = [];

}

include "inc/header.php";
include "inc/phrase.php";
include "inc/game.php";

if (isset($_POST['key'])) {

    $_SESSION['selected'][] = $_POST['key'];

}

$phrase = new Phrase($_SESSION['phrase'], $_SESSION['selected']);
$_SESSION['phrase'] = $phrase->getCurrentPhrase();

$game   = new Game($phrase);

?>

<body>
<div class="main-container">
    <div id="banner" class="section">
        <h2 class="header">Phrase Hunter</h2>
       <?php 

       if ($game->checkforLose() || $game->checkForWin()) {

        echo $game->gameOver();
        return;
           
        }

        echo $phrase->addPhraseToDisplay();
        echo $game->displayKeyboard();
     
        ?>

        <div id='scoreboard' class='section'>
            <ol>
                <?php
                echo $game->displayScore();
                ?>
            </ol>
        </div>
        
    </div>
</div>

</body>
</html>
