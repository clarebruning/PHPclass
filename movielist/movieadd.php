<?php
$title=$_POST["txtTitle"];
$rating=$_POST["txtRating"];
if(isset($_POST["txtTitle"], $_POST["txtRating"])) {

        $title=$_POST["txtTitle"];
        $rating=$_POST["txtRating"];

        //connect to database
        include'../includes/dbConnect.php';

        try {
            $db = new PDO($dsn, $username, $password, $options);

            $sql = $db->prepare("insert into movielist (movieTitle, movieRating) values (:title, :rating)");
            $sql->bindValue(":title",$title);
            $sql->bindValue(":rating",$rating);
            $sql->execute();

        }
        catch (PDOException $e) {
            $error = $e->getMessage();
            echo "Error: $error";
        }

        header("location:movielist.php");

}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Clare's Homepage</title>
    <link rel="stylesheet" type="text/css" href="../css/base.css">
    <style>
        td {
            padding-top: 10px;

            padding-left: 10px;
        }
        th, td#last {
            padding: 20px;
        }


    </style>
</head>

<body>

<header>
    <?php include '../includes/header.php' ?>
</header>

<nav>
    <?php include '../includes/nav.php' ?>
</nav>

<main>

    <form method="post">
        <table border="1" width="100%">
            <tr>
                <th colspan="2">Add New Movie</th>
            </tr>

            <tr>
                <th>Movie Title:</th>
                <td align="left"><input name ="txtTitle"  id="txtTitle" type="text" size="50"></td>
            </tr>

            <tr>
                <th>Movie Rating:</th>
                <td align="left"><input name="txtRating" id="txtRating" type="text"></td>
            </tr>

            <tr>
                <td id="last" colspan="2"><input type="submit" value="Add"></td>
            </tr>
        </table>
    </form>
</main>

<footer><?php include '../includes/footer.php' ?></footer>

</body>

</html>