<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <form action="registration.php" method="POST">
                <label for="ime">Unesi svoje ime:</label>
                <input type="text" name="ime">
                <br>
                <label for="prezime">Unesi svoje prezime:</label>
                <input type="text" name="prezime">
                <br>
                <label for="email">Unesi svoje email:</label>
                <input type="email" name="email">
                <br>
                <label for="password">Unesi svoje password</label>
                <input type="password" name="password">
                <br>
                <label for="passwordPotvrda">Ponovi password</label>
                <input type="password" name="passwordPotvrda">
                <br>
                <input type="submit" value="Registruj se">
            </form>
        </div>
    </div>
</body>
</html>