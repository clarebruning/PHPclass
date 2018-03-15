<?php
session_start();
$errmsg = "";
$key = sprintf('%04X%04X%04X%04X%04X%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));

    if($_SESSION["Role"] != 1){
        header("location: index.php");
    }

    if(isset($_POST["submit"])) {

        if(empty($_POST["txtName"])){
            $errmsg = "Name is required";
        }
        else {
            $fullname = $_POST["txtName"];

            }

        if(empty($_POST["txtEmail"])){
            $errmsg = "Email is required";
        }
        else {
            $email = $_POST["txtEmail"];

        }

        if(empty($_POST["txtPassword"])){
            $errmsg = "Password is required";
        }
        else {
            $memberpassword = $_POST["txtPassword"];

        }

        if($memberpassword != $_POST["txtConfirm"]){
            $errmsg = "Password fields must match";
        }

        if(empty($_POST["txtRole"])){
            $errmsg = "Role is required";
        }
        else {
            $role = $_POST["txtRole"];

        }

        if($errmsg==""){
            // Do database work
            include'../includes/dbConnect.php';

            try {
                $db = new PDO($dsn, $username, $password, $options);

                $sql = $db->prepare("insert into memberLogin (memberName, memberEmail,memberPassword,roleID,memberKey) values (:membername, :email, :password,:roleID,:memberkey)");
                $sql->bindValue(":membername",$fullname);
                $sql->bindValue(":email",$email);
                $sql->bindValue(":password",md5($memberpassword . $key));
                $sql->bindValue(":roleID",$role);
                $sql->bindValue(":memberkey",$key);
                $sql->execute();

            }
            catch (PDOException $e) {
                $error = $e->getMessage();
                echo "Error: $error";
            }
            $errmsg = "Member added";
            $fullname="";
            $email="";
        }

    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="../css/base.css">
    <style>
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
    <h1>Admin Page</h1>
    <h3 id="error"><?=$errmsg?></h3>
    <form method="post">
        <table border="1" width="100%">
            <tr>
                <th colspan="2">Add New User</th>
            </tr>

            <tr>
                <th>Full Name:</th>
                <td align="left"><input name ="txtName"  id="txtName" value="<?=$fullname?>" type="text" size="50"></td>
            </tr>

            <tr>
                <th>Email:</th>
                <td align="left"><input name ="txtEmail"  id="txtEmail" value="<?=$email?>" type="email" size="50"></td>
            </tr>

            <tr>
                <th>Password:</th>
                <td align="left"><input name="txtPassword" id="txtPassword" type="password" size="50"></td>
            </tr>

            <tr>
                <th>Confirm Password:</th>
                <td align="left"><input name ="txtConfirm"  id="txtConfirm" type="password" size="50"></td>
            </tr>

            <tr>
                <th>Role:</th>
                <td align="left">
                    <select id="txtRole" name="txtRole">
                        <option value="1">Admin</option>
                        <option value="2">Operator</option>
                        <option value="3">Member</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td id="last" colspan="2"><input type="submit" value="Add" name="submit" style="margin-right:30px;"></td>
            </tr>
        </table>

    </form>
</main>

<footer><?php include '../includes/footer.php' ?></footer>

</body>

</html>