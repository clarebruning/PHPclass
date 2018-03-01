<?php
// end of semester: 5-19-2018

$secPerMin = 60;
$secPerHour = $secPerMin * 60;
$secPerDay = $secPerHour * 24;
$secPerWeek = $secPerDay * 7;

// current time
$now = time();

// end of semester time

$semesterEnd = mktime(12,0,0,5,19,2018);

// seconds between now and end of semester

$seconds = ($semesterEnd-$now);

// Weeks, Days, Hours and Seconds between now and end of semester

$weeks = floor($seconds/$secPerWeek);
$seconds = $seconds - ($weeks*$secPerWeek);
$days = floor($seconds/$secPerDay);
$seconds = $seconds -($days*$secPerDay);
$hours = floor($seconds/$secPerHour);
$seconds = $seconds - ($hours*$secPerHour);
$minutes = floor($seconds/$secPerMin);
$seconds = floor($seconds-($minutes*$secPerMin));

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Countdown</title>
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
    <h3>End of Semester Countdown</h3>
   <p>
       <?=$weeks ?> Weeks  |
       <?=$days ?> Days  |
       <?=$hours ?> Hours  |
       <?=$minutes ?> Minutes  |
       <?=$seconds ?> Seconds
   </p>
</main>

<footer><?php include '../includes/footer.php' ?></footer>

</body>

</html>
