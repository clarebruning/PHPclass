<?php
session_start();

if(isset($_POST["txtEmail"], $_POST["txtPassword"])) {
    $email = $_POST["txtEmail"];
    $passwordEntered = $_POST["txtPassword"];
    $errmsg = "";


    include "../includes/dbConnect.php";

    try {
        $db = new PDO($dsn, $username, $password, $options);

        $sql = $db->prepare("select memberID, memberPassword, memberKey, roleID from memberLogin where memberEmail = :Email");
        $sql->bindValue(":Email", $email);
        $sql->execute();
        $row = $sql->fetch();

        if ($row != null) {

            $hashedPassword = md5($passwordEntered . $row["memberKey"]);

            if ($hashedPassword == $row["memberPassword"]) {
                $_SESSION["UID"] = $row["memberID"];
                $_SESSION["Role"] = $row["roleID"];

                if ($row["roleID"] == 1) {
                    header("Location:admin.php");
                } else {
                    header("Location:member.php");
                }
            } else {
                $errmsg = "Incorrect credentials";
            }
        } else {
            $errmsg = "Incorrect credentials";
        }
    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo "Error: $error";
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Customer Login</title>
    <link rel="stylesheet" type="text/css" href="../css/base.css">
    <style>
        td {
            padding-top: 10px;

            padding-left: 10px;
        }
        th, td#last {
            padding: 20px;
        }
    #error {
        color: red;
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
        <h3 id="error"><?=$errmsg?></h3>
        <table border="1" width="100%">
            <tr>
                <th colspan="2">User Login</th>
            </tr>

            <tr>
                <th>Email:</th>
                <td align="left"><input name ="txtEmail"  id="txtEmail" type="email" size="50"></td>
            </tr>

            <tr>
                <th>Password:</th>
                <td align="left"><input name="txtPassword" id="txtPassword" type="password"></td>
            </tr>

            <tr>
                <td id="last" colspan="2"><input type="submit" value="Login" style="margin-right:30px;"></td>
            </tr>
        </table>

    </form>
</main>

<footer><?php include '../includes/footer.php' ?></footer>

</body>

</html>