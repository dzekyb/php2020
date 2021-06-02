<?php
    // - sanitizing user input and finding user in database

    session_start();
    if(isset($_SESSION['id'])) {
        header('Location: index');
        exit();
    }
    require_once('include/db_connection.php');
    require_once('include/functions.inc.php');
    $errorMessage = '';
    if(isset($_POST['submit'])) {

        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessage = 'Please provide valid email';
        } else {
            $errorMessage = findUser($conn, $email, $password);
        }

    }
?>

<!DOCTYPE html>
<?php require_once('include/head.php'); ?>
<body>
    <?php require_once('include/nav.php'); ?>
    <main>
        
    <form action="" method="POST" class="form login">
        <div class="main__heading">
            <h1>Login</h1>
        </div>
        <div>
            <label for="email">Email address</label> <br>
            <input type="text" name="email" id="email" value="<?php echo isset($_POST['submit']) ? $email : '' ; ?>">
        </div>
        <div>
            <label for="password">Password</label> <br>
            <input type="password" name="password" id="password" value="<?php echo isset($_POST['submit']) ? $password : '' ; ?>">
        </div>
        <span class="error"> <?php echo $errorMessage ?? ''; ?> </span>
        <button type="submit" name="submit">Login</button>
        <p>New user? <a href="register.php" class="info">Create account</a>.</p>
    </form>
    
</main>
</body>
</html>