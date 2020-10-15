<?php

$playerPoints = 0;
$computerPoints = 0;
$url = "https://deckofcardsapi.com/api/deck/new/shuffle/?deck_count=1";
$winner = "";

$response = file_get_contents($url);
$response = json_decode($response,true);
$deck = $response["deck_id"];

$playerCards = file_get_contents("https://deckofcardsapi.com/api/deck/${deck}/draw/?count=2");
$playerCards = json_decode($playerCards,true);
$computerCards = file_get_contents("https://deckofcardsapi.com/api/deck/${deck}/draw/?count=2");
$computerCards = json_decode($computerCards,true);

foreach($playerCards["cards"] as $crd) {

    if(!is_numeric($crd["value"])) {
        if($crd["value"] === "ACE") {
            $playerPoints += 11;
        } else {
            $playerPoints += 10;
        }
    } else {
        $playerPoints += $crd["value"];
    }
}

foreach($computerCards["cards"] as $crd) {

    if(!is_numeric($crd["value"])) {
        if($crd["value"] === "ACE") {
            $computerPoints += 11;
        } else {
            $computerPoints += 10;
        }
    } else {
        $computerPoints += $crd["value"];
    }
}

if(($playerPoints > $computerPoints) && $playerPoints <= 21) {
    $winner = "The Player has won";
} else if(($computerPoints > $playerPoints) && $computerPoints <= 21) {
    $winner = "The Cashier has won";
}
?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BlackJack</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body class="body">

        <div class="winLose">
            <h2><?php echo($winner) ?></h2>
        </div>
        <div class="player">
            <h2>Player</h2>
            <img src="<?php echo($playerCards["cards"][0]["image"]) ?>" alt="Card" width="" height="">
            <img src="<?php echo($playerCards["cards"][1]["image"]) ?>" alt="Card" width="" height="">  
            <h3>Points: <?php echo($playerPoints) ?></h3>
            
        </div>


        <div class="cashier">

            <h2>Cashier</h2>
            <img src="<?php echo($computerCards["cards"][0]["image"]) ?>" alt="Card" width="" height="">
            <img src="<?php echo($computerCards["cards"][1]["image"]) ?>" alt="Card" width="" height="">
            <h3>Points: <?php echo($computerPoints) ?></h3>  

        </div>

        <div class="grid-container">
            <div class="grid-item">1</div> 
        </div>

    </body>

    <footer>

        <div class="hello">
            <button class="button button2 font" onclick="window.location.href='startpage.html';" value="BJ">Back to menu</button>
            <button class="button button3 font" onClick="window.location.reload();">Refresh Page</button>
        </div>

    </footer>
</html>