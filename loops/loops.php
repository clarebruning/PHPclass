<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Loops</title>
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

    echo "<style>
    * {
    text-align: center;
    }
    </style>";

    for($i = 1;$i<7;$i++){
        echo "<h$i>Hello world<h$i>";
    }

    echo "<br><hr><br>";

    $i = 6;
    while ($i > 0) {
        echo "<h$i>Goodbye world</h$i>";
        $i--;
    }

    echo "<br><hr><br>";

    $fullName = "Clare Bruning";
    echo $fullName;

    echo "<br><br><hr><br>";

    $split = explode(' ',$fullName);
    echo "First Name: ".$split[0];
    echo "<br>";
    echo "Last Name: ".$split[1];

    echo "<br><br><br>";

?>
</main>

<footer><?php include '../includes/footer.php' ?></footer>

</body>

</html>