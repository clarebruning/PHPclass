<?php
if(isset($_GET["id"])){
    $id = $_GET["id"];

    try {
        //connect to database
        include'../includes/dbConnect.php';

        $db = new PDO($dsn, $username, $password, $options);

        $sql = $db->prepare("delete from customer where CustomerID = :id");
        $sql->bindValue(":id",$id);
        $sql->execute();

    }
    catch (PDOException $e) {
        $error = $e->getMessage();
        echo "Error: $error";
    }
}
header("location:customerlist.php");
?>