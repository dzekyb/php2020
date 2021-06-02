<?php
if(isset($_POST['email']) && isset($_POST['password'])){
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        // Dobili smo podatke
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Trimujemo
        $email = trim($email);
        $password = trim($password);

        // XSS zaštita
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);

        // Pravljenje konekcije 
        $sql = new mysqli("localhost", "phproot", "phproot2021!", "aplikacija");
        // Provjera konekcije
        if($sql->connect_error){
            echo "Connection failed!";
        }
        // SQL Injection zaštita
        $email = $sql->real_escape_string($email);
        $password = $sql->real_escape_string($password);

        // Pravimo neki query ka bazi
        $password = md5($password);
        $query = "SELECT * FROM korisnik WHERE email = '{$email}' AND password = '{$password}'";
        $result = $sql->query($query);

        // Ispitujete rezultat
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                // U $row imamo asocijativni niz
                $id = $row['id'];
                $ime = $row['ime'];
                $prezime = $row['prezime'];
                $status = $row['status'];

                session_start();
                $_SESSION['id'] = $id;
                $_SESSION['ime'] = $ime;
                $_SESSION['prezime'] = $prezime;
                $_SESSION['status'] = $status;

                header("Location: index.php?success=true");
            }
        }else{
           header("Location: index.php?error=Pogrešni podaci!"); 
        }



    }else{
        // Vratiti grešku da je prazno
    }
}else{
    // Vratiti grešku da nije poslano
}