<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
    
</head>
<body>
    
    <?php
        if(isset($_POST['username']) && !empty($_POST['username'])){
            if(isset($_POST['password']) && !empty($_POST['password'])){
                $username = $_POST['username'];
                $password = $_POST['password'];

                echo $username . " " . $password;

                $text = $_POST['text'];
                $age = $_POST['age'];

                echo "<br>";
                echo $text;
                echo "<br>";
                echo $age;
            }
        }

    ?>

    <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" >
        <br>
        <div class="input-field">
            <label for="password">Password:</label>
            <input type="password" name="password" >
        </div>
        <textarea name="text"></textarea>
        <br>
        <select name="age">
            <option value="" selected disabled>Odaberi opciju</option>
            <option value="25">25 Godina</option>
            <option value="26">26 Godina</option>

        </select>
        <br><br>
        <input type="reset" value="Reset Form">
        <input type="submit" value="Login">
    </form>
    <script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
</body>
</html>