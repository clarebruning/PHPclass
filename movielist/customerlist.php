<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Customer List</title>
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
    <h3>My Customer List 2018</h3>
    <table border="1" width="100%">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Zip</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Password</th>
        </tr>
        <?php
        include'../includes/dbConnect.php';

        try {
            $db = new PDO($dsn, $username, $password, $options);

            $sql = $db->prepare("select * from customer;");
            $sql->execute();
            //$row = $sql->fetch();

            while($row=$sql->fetch()){

                echo "<tr>";
                echo "<td><a href=customerupdate.php?id=" . $row["CustomerID"] . ">".$row["CustomerID"]."</a></td>";
                echo "<td><a href=customerupdate.php?id=" . $row["CustomerID"] . ">".$row["FirstName"]."</a></td>";
                echo "<td><a href=customerupdate.php?id=" . $row["CustomerID"] . ">".$row["LastName"]."</a></td>";
                echo "<td>".$row["Address"]."</td>";
                echo "<td>".$row["City"]."</td>";
                echo "<td>".$row["State"]."</td>";
                echo "<td>".$row["Zip"]."</td>";
                echo "<td>".$row["Phone"]."</td>";
                echo "<td>".$row["Email"]."</td>";
                echo "<td>Secret</td>";
                echo "</tr>";
            }

        }
        catch (PDOException $e) {
            $error = $e->getMessage();
            echo "Error: $error";
        }
        ?>

    </table>
    <a href="custadd.php">Add New Customer</a>

</main>

<footer><?php include '../includes/footer.php' ?></footer>

</body>

</html>