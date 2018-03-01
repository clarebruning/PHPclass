
<?php
session_start();

// Check that the user entered a question.
if(isset($_POST["txtQuestion"])) {
    $question = $_POST["txtQuestion"];
}
else {
    $question = "";
}

// Check if a previous question remains.
if(isset($_SESSION["prevQuest"])){
    $prevQuest = $_SESSION["prevQuest"];
}
else {
    $prevQuest = "";
}

// Create array and fill it with potential responses.
$responses = array();
$responses[0]="Ask again later.";
$responses[1]="Yes.";
$responses[2]="No.";
$responses[3]="It appears to be so.";
$responses[4]="Reply is hazy. Please try again.";
$responses[5]="Yes, definitely.";
$responses[6]="What is it you really want to know?";
$responses[7]="Outlook is good.";
$responses[8]="My sources say no.";
$responses[9]="Signs point to yes.";
$responses[10]="Don't count on it.";
$responses[11]="Cannot predict now.";
$responses[12]="As I see it, yes.";
$responses[13]="Better not tell you now.";
$responses[14]="Concentrate and ask again.";

if($question=="") {
    $answer = "Ask me a question...";
}
elseif(substr($question,-1)!="?") {
    $answer = "Punctuation is important! Ask me with a question mark.";
}
elseif($prevQuest==$question){
    $answer = "Don't like my answer? Too bad! Ask a new question.";
}
else {
    $iResponse = mt_rand(0,14);
    $answer=$responses[$iResponse];
    $_SESSION["prevQuest"] = $question;
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Magic 8 Ball</title>
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

    <h2>Magic 8 Ball</h2>

    <marquee><?=$answer?></marquee>
    <br>
    <p>Your question:</p>
    <form method="post" action="magic8.php">
        <input type="text" name="txtQuestion" id="txtQuestion" value="<?=$question?>"><br><br>
        <input type="submit" value="Ask the 8 Ball">
    </form>

</main>

<footer><?php include '../includes/footer.php' ?></footer>

</body>

</html>
