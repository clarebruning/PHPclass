<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Movie List</title>
    <link rel="stylesheet" type="text/css" href="../css/base.css">
    <style>
        td a {

            color: black;
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
<h3>My Movie List 2018</h3>
    <table border="1" width="100%">
        <tr>
            <th>Key</th>
            <th>Title</th>
            <th>Rating</th>
        </tr>
            <?php
               include'../includes/dbConnect.php';

        try {
            $db = new PDO($dsn, $username, $password, $options);

            $sql = $db->prepare("select * from movielist;");
            $sql->execute();
            //$row = $sql->fetch();

            while($row=$sql->fetch()){

                echo "<tr>";
                    echo "<td>".$row["movieID"]."</td>";
                    echo "<td><a href=movieupdate.php?id=" . $row["movieID"] . ">".$row["movieTitle"]."</a></td>";
                    echo "<td>".$row["movieRating"]."</td>";
                echo "</tr>";
            }

        }
        catch (PDOException $e) {
            $error = $e->getMessage();
            echo "Error: $error";
        }
            ?>

</table>
<a href="movieadd.php">Add New Movie</a>

</main>

<footer><?php include '../includes/footer.php' ?></footer>

</body>

</html>