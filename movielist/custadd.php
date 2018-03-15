<?php
$key = sprintf('%04X%04X%04X%04X%04X%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));

$firstName=$_POST["txtFirstName"];
$lastName=$_POST["txtLastName"];
$address=$_POST["txtAddress"];
$city=$_POST["txtCity"];
$state=$_POST["txtState"];
$zip=$_POST["txtZip"];
$phone=$_POST["txtPhone"];
$email=$_POST["txtEmail"];
if(isset($_POST["txtFirstName"], $_POST["txtLastName"], $_POST["txtAddress"], $_POST["txtCity"], $_POST["txtState"], $_POST["txtZip"], $_POST["txtPhone"], $_POST["txtEmail"])) {

    $firstName=$_POST["txtFirstName"];
    $lastName=$_POST["txtLastName"];
    $address=$_POST["txtAddress"];
    $city=$_POST["txtCity"];
    $state=$_POST["txtState"];
    $zip=$_POST["txtZip"];
    $phone=$_POST["txtPhone"];
    $email=$_POST["txtEmail"];
    $passwordEntered=$_POST["txtPassword"];

    //connect to database
    include'../includes/dbConnect.php';

    try {
        $db = new PDO($dsn, $username, $password, $options);

        $sql = $db->prepare("insert into customer (FirstName, LastName, Address, City, State, Zip, Phone, Email, Password) values (:firstName, :lastName, :address, :city, :state, :zip, :phone, :email, :password)");
        $sql->bindValue(":firstName",$firstName);
        $sql->bindValue(":lastName",$lastName);
        $sql->bindValue(":address",$address);
        $sql->bindValue(":city",$city);
        $sql->bindValue(":state",$state);
        $sql->bindValue(":zip",$zip);
        $sql->bindValue(":phone",$phone);
        $sql->bindValue(":email",$email);
        $sql->bindValue(":password",md5($passwordEntered . $key));
        $sql->execute();

    }
    catch (PDOException $e) {
        $error = $e->getMessage();
        echo "Error: $error";
    }

    header("location:customerlist.php");

}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Clare's Homepage</title>
    <link rel="stylesheet" type="text/css" href="../css/base.css">
    <style>
    label {
        position: relative;
        left: -100px;
    }
    input[type=text],input[type=tel],input[type=email],input[type=password]{
        position: relative;
        float: right;
        left: -200px;
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

    <fieldset><legend>Customer</legend>
        <label for="txtFirstName">First Name:</label>
        <input align="right" name ="txtFirstName"  id="txtFirstName" type="text"><br><br>

        <label for="txtLastName">Last Name:</label>
        <input name="txtLastName" id="txtLastName" type="text"><br><br>

        <label for="txtPhone">Phone:</label>
        <input name="txtPhone" id="txtPhone" type="tel"><br><br>

        <label for="txtEmail">Email:</label>
        <input name="txtEmail" id="txtEmail" type="email">
    </fieldset>

    <fieldset><legend>Address</legend>
        <label for="txtAddress">Address:</label>
        <input name="txtAddress" id="txtAddress" type="text"><br><br>

        <label for="txtCity">City:</label>
        <input name="txtCity" id="txtCity" type="text"><br><br>

        <label for="txtState">State:</label>
        <input name="txtState" id="txtState" type="text"><br><br>

        <label for="txtZip">Zip:</label>
        <input name="txtZip" id="txtZip" type="text">
    </fieldset>

    <fieldset><legend>Security</legend>
        <label for="txtPassword">Password:</label>
        <input name="txtPassword" id="txtPassword" type="password"><br><br>

        <label for="txtVerif">Verify Password:</label>
        <input name="txtVerif" id="txtVerif" type="password">
    </fieldset>

                <input type="submit" value="Add">

    </form>
</main>

<footer><?php include '../includes/footer.php' ?></footer>

</body>

</html>