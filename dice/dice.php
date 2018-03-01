

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dice</title>
    <link rel="stylesheet" type="text/css" href="../css/base.css">
</head>

<body>

<header>
    <?php include '../includes/header.php' ?>
</header>

<nav>
    <?php include '../includes/nav.php' ?>
</nav>

<main>

    <?php
    // Create and fill array with dice images.
    $dice = array();
    $dice[0]= '<img src="dice(1)/dice_1.png">';
    $dice[1]= '<img src="dice(1)/dice_2.png">';
    $dice[2]='<img src="dice(1)/dice_3.png">';
    $dice[3]='<img src="dice(1)/dice_4.png">';
    $dice[4]='<img src="dice(1)/dice_5.png">';
    $dice[5]='<img src="dice(1)/dice_6.png">';

    // Randomize 6 dice, 3 each for you and the computer.
    $randDie1 = mt_rand(0,5);
    $randDie2 = mt_rand(0,5);
    $randDie3 = mt_rand(0,5);
    $randDie4 = mt_rand(0,5);
    $randDie5 = mt_rand(0,5);
    $randDie6 = mt_rand(0,5);

    // Add the first two dice to find your score (add 1 to randomized number so variable equals image on die, not position in array.
    $yourScore = ($randDie1+1)+($randDie2+1)+($randDie3+1);
    // Add dice 3-5 to find the computer's score.
    $compScore = ($randDie4+1)+($randDie5+1)+($randDie6+1);

    // Display your dice and score.
    echo "Your score: ".$yourScore;
    echo "<br>";
    echo $dice[$randDie1];
    echo $dice[$randDie2];
    echo $dice[$randDie3];

    echo "<br>";
    echo "<br>";

    // Display computer's dice and score.
    echo "Computer's score: ".$compScore;
    echo "<br>";
    echo $dice[$randDie4];
    echo $dice[$randDie5];
    echo $dice[$randDie6];

    // Determine and display winner of this round.
    echo "<br>";
    if($yourScore>$compScore){
        echo "You win!";
    }
    elseif($yourScore<$compScore){
        echo "Computer wins!";
    }
    elseif($yourScore==$compScore){
        echo "It's a tie!";
    }
    ?>

</main>

<footer><?php include '../includes/footer.php' ?></footer>

</body>

</html>
