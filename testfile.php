<?php
$url = "https://deckofcardsapi.com/api/deck/new/shuffle/?deck_count=1";
$response = file_get_contents($url);
$response = json_decode($response,true);
$deck = $response["deck_id"];
$card = file_get_contents("https://deckofcardsapi.com/api/deck/${deck}/draw/?count=2");
$card = json_decode($card,true);
//var_dump($card["cards"][0]["image"]);
?>


<!DOCTYPE html>

<html lang="en" class="wrap">

    <head>
    <title>BlackJack</title>
    <link rel="stylesheet" href="style.css">
    
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>



    <body>

        <div class="contaienr">
            <nav>

            </nav>
        </div>    
        <div class="headerer">
        aaaaaaaaaaa
    
        </div>

        <img src="images\logo.jpg" alt="logo" class="logo">
        <img src="<?php echo($card["cards"][0]["image"]) ?>" alt="Card" width="" height="">
        <img src="<?php echo($card["cards"][1]["image"]) ?>" alt="Card" width="" height="">
        <button class="button button1">Shuffle Cards</button>
    </body>

    <footer>
    </footer>
</html>