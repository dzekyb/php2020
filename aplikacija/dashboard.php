<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>
    <?php
        $sql = new mysqli('localhost','phproot', 'phproot2021!','aplikacija');
        if($sql->connect_error){
            header("Location: index.php?error=Ne mogu se konektovati na bazu!");
        }
        $id = $_SESSION['id'];
        $query = "SELECT * FROM telefon_korisnik JOIN telefon ON telefon_korisnik.telefon_id = telefon_id WHERE telefon_korisnik.korisnik_id = '{$id}'";

        $result = $sql->query($query);

        if($result->num_rows > 0){
            echo "<table class='telefoni'>";
            while($row = $result->fetch_assoc()){
                echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['proizvodac'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                    echo "<td>" . $row['cijena'] . "</td>";
                    echo "<td><a href='edit.php?telefon=" . $row['id'] . "'>Edit</a></td>";
                    echo "<td><a href='delete.php?telefon=" . $row['id'] . "'>Delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        }

    ?>
</body>
</html>