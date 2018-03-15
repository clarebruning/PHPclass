<?php
$key = sprintf('%04X%04X%04X%04X%04X%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
//connect to database
include'../includes/dbConnect.php';

if(isset($_POST["txtFirstName"], $_POST["txtLastName"], $_POST["txtAddress"], $_POST["txtCity"], $_POST["txtState"], $_POST["txtZip"], $_POST["txtPhone"], $_POST["txtEmail"], $_POST["txtPassword"])) {
    $id=$_POST["txtID"];
    $firstName=$_POST["txtFirstName"];
    $lastName=$_POST["txtLastName"];
    $address=$_POST["txtAddress"];
    $city=$_POST["txtCity"];
    $state=$_POST["txtState"];
    $zip=$_POST["txtZip"];
    $phone=$_POST["txtPhone"];
    $email=$_POST["txtEmail"];
    $custPassword=$_POST["txtPassword"];


    try {
        include'../includes/dbConnect.php';
        $db = new PDO($dsn, $username, $password, $options);

        $sql = $db->prepare("update customer set FirstName = :FirstName, LastName = :LastName, Address = :address, City = :city, State = :state, Zip = :zip, Phone = :phone, Email = :email, Password = :password where CustomerID = :ID");
        $sql->bindValue(":FirstName",$firstName);
        $sql->bindValue(":LastName",$lastName);
        $sql->bindValue(":address",$address);
        $sql->bindValue(":city",$city);
        $sql->bindValue(":state",$state);
        $sql->bindValue(":zip",$zip);
        $sql->bindValue(":phone",$phone);
        $sql->bindValue(":email",$email);
        $sql->bindValue(":password",md5($custPassword . $key));
        $sql->bindValue(":ID",$id);
        $sql->execute();

    }
    catch (PDOException $e) {
        $error = $e->getMessage();
        echo "Error: $error";
    }

    header("location:customerlist.php");

}

if(isset($_GET["id"])){
    $id = $_GET["id"];

    try {
        $db = new PDO($dsn, $username, $password, $options);

        $sql = $db->prepare("select * from customer where CustomerID = :id");
        $sql->bindValue(":id",$id);
        $sql->execute();
        $row = $sql->fetch();
        $firstName = $row["FirstName"];
        $lastName = $row["LastName"];
        $address = $row["Address"];
        $city = $row["City"];
        $state = $row["State"];
        $zip = $row["Zip"];
        $phone = $row["Phone"];
        $email = $row["Email"];
        $custPassword = $row["Password"];
    }
    catch (PDOException $e) {
        $error = $e->getMessage();
        echo "Error: $error";
    }
}
else{
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
    <script type="text/javascript">
        function DeleteCustomer(firstName,lastName,id) {
            if(confirm("Do you want to delete " + firstName + " " + lastName + "?")){

                document.location.href = "customerdelete.php?id=" + id;

            }
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

        <fieldset><legend>Customer</legend>
            <label for="txtFirstName">First Name:</label>
            <input align="right" name ="txtFirstName"  id="txtFirstName" type="text" value="<?=$firstName?>"><br><br>

            <label for="txtLastName">Last Name:</label>
            <input name="txtLastName" id="txtLastName" type="text" value="<?=$lastName?>"><br><br>

            <label for="txtPhone">Phone:</label>
            <input name="txtPhone" id="txtPhone" type="tel" value="<?=$phone?>"><br><br>

            <label for="txtEmail">Email:</label>
            <input name="txtEmail" id="txtEmail" type="email" value="<?=$email?>">
        </fieldset>

        <fieldset><legend>Address</legend>
            <label for="txtAddress">Address:</label>
            <input name="txtAddress" id="txtAddress" type="text" value="<?=$address?>"><br><br>

            <label for="txtCity">City:</label>
            <input name="txtCity" id="txtCity" type="text" value="<?=$city?>"><br><br>

            <label for="txtState">State:</label>
            <input name="txtState" id="txtState" type="text" value="<?=$state?>"><br><br>

            <label for="txtZip">Zip:</label>
            <input name="txtZip" id="txtZip" type="text" value="<?=$zip?>">
        </fieldset>

        <fieldset><legend>Security</legend>
            <label for="txtPassword">Password:</label>
            <input name="txtPassword" id="txtPassword" type="password" value="<?=$password?>"><br><br>

            <label for="txtVerif">Verify Password:</label>
            <input name="txtVerif" id="txtVerif" type="password" value="<?=$password?>">
        </fieldset>
        <input type="hidden" id="txtID" name="txtID" value="<?=$id?>">
        <input type="submit" value="Update" style="margin-right:30px;">
        <input type="button" onclick="DeleteCustomer('<?=$firstName?>','<?=$lastName?>','<?=$id?>')" value="Delete Customer" >


    </form>
</main>

<footer><?php include '../includes/footer.php' ?></footer>

</body>

</html>