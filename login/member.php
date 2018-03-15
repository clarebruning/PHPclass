<?php
session_start();
if(!isset($_SESSION["UID"])){
    header("location: index.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Member Page</title>
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
<h1>Member Page</h1>
</main>

<footer><?php include '../includes/footer.php' ?></footer>

</body>

</html>