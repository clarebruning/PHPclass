<?php
//connect to database
include'../includes/dbConnect.php';

if(isset($_POST["txtTitle"], $_POST["txtRating"])) {
    $id = $_POST["txtID"];
    $title= $_POST["txtTitle"];
    $rating= $_POST["txtRating"];

    try {
        $db = new PDO($dsn, $username, $password, $options);

        $sql = $db->prepare("update movielist set movieTitle = :Title, movieRating = :Rating where movieID = :ID");
        $sql->bindValue(":Title",$title);
        $sql->bindValue(":Rating",$rating);
        $sql->bindValue(":ID",$id);
        $sql->execute();

    }
    catch (PDOException $e) {
        $error = $e->getMessage();
        echo "Error: $error";
    }

    header("location:movielist.php");

}

if(isset($_GET["id"])){
    $id = $_GET["id"];

    try {
        $db = new PDO($dsn, $username, $password, $options);

        $sql = $db->prepare("select * from movielist where movieID = :id");
        $sql->bindValue(":id",$id);
        $sql->execute();
        $row = $sql->fetch();
        $title = $row["movieTitle"];
        $rating = $row["movieRating"];


    }
    catch (PDOException $e) {
        $error = $e->getMessage();
        echo "Error: $error";
    }
}
else{
    header("location:movielist.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Movie</title>
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
    <script type="text/javascript">
        function DeleteMovie(title, id) {
            if(confirm("Do you want to delete " + title + "?")){

                document.location.href = "moviedelete.php?id="+ id;

            };
        }
    </script>
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
                <th colspan="2">Update Movie</th>
            </tr>

            <tr>
                <th>Movie Title:</th>
                <td align="left"><input value="<?=$title?>" name ="txtTitle"  id="txtTitle" type="text" size="50"></td>
            </tr>

            <tr>
                <th>Movie Rating:</th>
                <td align="left"><input value="<?=$rating?>" name="txtRating" id="txtRating" type="text"></td>
            </tr>

            <tr>
                <td id="last" colspan="2"><input type="submit" value="Update" style="margin-right:30px;"><input type="button" onclick="DeleteMovie('<?=$title?>', '<?=$id?>')" value="Delete Movie"></td>
            </tr>
        </table>
        <input type="hidden" id="txtID" name="txtID" value="<?=$id?>">
    </form>
</main>

<footer><?php include '../includes/footer.php' ?></footer>

</body>

</html>