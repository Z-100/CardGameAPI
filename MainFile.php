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

    <body; class = "body">

        <div>
        <button class="button button2" onclick="window.location.href='index.html';" value="BJ">Play BlackJack!</button>
        </div>

        <div>
            <h2><?php echo($winner) ?></h2>
        </div>
        <div>
            <h2>Player</h2>
            <h3>Points: <?php echo($playerPoints) ?></h3>
            <img src="<?php echo($playerCards["cards"][0]["image"]) ?>" alt="Card" width="" height="">
            <img src="<?php echo($playerCards["cards"][1]["image"]) ?>" alt="Card" width="" height="">  

        </div>


        <div class = "cashier">

            <h2>Cashier</h2>
            <h3>Points: <?php echo($computerPoints) ?></h3>
            <img src="<?php echo($computerCards["cards"][0]["image"]) ?>" alt="Card" width="" height="">
            <img src="<?php echo($computerCards["cards"][1]["image"]) ?>" alt="Card" width="" height="">  

        </div>

    </body>

</html>