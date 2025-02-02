<?php
session_start();
require 'vendor/autoload.php';

$client = new \GuzzleHttp\Client();
$deck_id = $_SESSION['deck_id'];
$card_array = $_SESSION['card_array'];

// Draw one more card
$response = $client->request('GET', 'https://deckofcardsapi.com/api/deck/'.$deck_id.'/draw/?count=1');
$response_data = json_decode($response->getBody(), TRUE);

$card_array[] = $response_data['cards'][0];
$_SESSION['card_array'] = $card_array;

function calc_card_total($cards) {
    $values = ["KING"=>10, "QUEEN"=>10, "JACK"=>10, "ACE"=>11, "2"=>2, "3"=>3, "4"=>4, "5"=>5, "6"=>6, "7"=>7, "8"=>8, "9"=>9, "10"=>10];
    $total = 0;
    foreach ($cards as $card) {
        $total += $values[$card['value']];
    }
    return $total;
}

$card_total = calc_card_total($card_array);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Draw Again</title>
</head>
<body>
    <h1>Your Cards:</h1>
    <?php foreach ($card_array as $card) : ?>
        <img src="<?php echo $card['image']; ?>" alt="Card">
    <?php endforeach; ?>

    <h2>Your total is: <?php echo $card_total; ?></h2>

    <?php if ($card_total > 21): ?>
        <p>Sorry, you went over 21! Try again.</p>
        <a href="index.php">Play Again</a>
    <?php elseif ($card_total == 21): ?>
        <p>Congratulations! You hit 21!</p>
        <a href="index.php">Play Again</a>
    <?php else: ?>
        <a href="drawagain.php">Draw Again</a>
    <?php endif; ?>
</body>
</html>
