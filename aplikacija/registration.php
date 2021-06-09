<?php
if(isset($_POST['ime']) && isset($_POST['prezime']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordPotvrda'])){
    if(!empty($_POST['ime']) && !empty($_POST['prezime']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['passwordPotvrda'])){
        // Preuzimanje parametara za daljnju obradu
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordPotvrda = $_POST['passwordPotvrda'];

        // Trimovanje
        $ime = trim($ime);
        $prezime = trim($prezime);
        $email = trim($email);
        $password = trim($password);
        $passwordPotvrda = trim($passwordPotvrda);

        // XSS zaštita
        $ime = htmlspecialchars($ime);
        $prezime = htmlspecialchars($prezime);
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);
        $passwordPotvrda = htmlspecialchars($passwordPotvrda);

        // Provjera passworda
        if($password !== $passwordPotvrda){
            header("Location: registracija.php?error=Passwordi se ne poklapaju!");
            return;
        }

        // Pravimo konekciju
        $sql = new mysqli("localhost", "phproot", "phproot2021!", "aplikacija");
        if($sql->connect_error){
            header("Location: registracija.php?error=Nemoguće se konektovati na bazu!");
        }

        // Pravimo query
        $query = "INSERT INTO korisnik (ime, prezime, email, password,status) VALUES ('{$ime}', '{$prezime}', '{$email}', '{$password}', '1')";
        // Ubacujemo podatke
        if($sql->query($query) === TRUE){
            // Ako su podaci tačno unešeni
            $query2 = "SELECT * FROM korisnik WHERE email = '{$email}'";
            $result = $sql->query($query2);
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
            header("Location: registracija.php?error=Ne mogu unijeti podatke u bazu!");
        }
        
        // Uzeli bi trenutni datum i vrijeme i to stavili u md5
        // Taj token bi stavili u neku tabelu zajedno id-jem korisnika ili emailom
        // Napravili bi neki email gdje korisnika šaljemo recimo potvrdi-registraciju.php?token=xyz
        // Tu bi preuzeli token, otišli u bazu, pronašli token, provjerili da li se poklapaju, te ako se poklapaju korisnika bi definitivno registrovali, odnosno promijenili bi mu status npr. iz 0 u 1, ili iz 1 u 2
        // Nakon toga možete ili vratiti povratnu poruku ili korisnika ulogovati u sistem odmah
        

        // Zatvaranje konekcije
        $sql->close();



    }else{
        // Vratili grešku jer je neki parametar prazan
    }
}else{
    // Vratili grešku da nije poslan parametar 
}