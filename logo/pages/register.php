<?php
//    creating the user and redirecting to login page
//     ## functions ##
//     * validateUserInput - takes five arguments: connection, user name, user email, user password, user retype password
//     returns error message if:
//     - one of the provided arguments is empty
//     - user name contains special characters
//     - user email isn't a valid email
//     - user email exists in database
//     - user password and user retype password don't match

    if(isset($_SESSION['id'])) {
        header('Location: index');
        exit();
    }
    require_once('include/db_connection.php');
    require_once('include/functions.inc.php');
    $errorMessage = '';
    if(isset($_POST['submit'])) {
        
        $fullName = htmlspecialchars($_POST['fullName']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars( $_POST['password']);
        $confirmPassword = htmlspecialchars( $_POST['confirmPassword']);

        if(!validateUserInput($conn, $fullName, $email, $password, $confirmPassword)) {
            createUser($conn, $fullName, $email, $password);
            header('Location: login');
        } else {
            $errorMessage = validateUserInput($conn, $fullName, $email, $password, $confirmPassword);
        }

    }
?>

<!DOCTYPE html>
<html>
<?php require_once('include/head.php'); ?>
<body>
    <?php require_once('include/nav.php'); ?>
    <main>
        
            <form action="" method="POST" class="form login">
            <div class="main__heading">
                <h1>Register</h1>
            </div>
            <div>
                <label for="name">Full Name</label> <br>
                <input type="text" name="fullName" id="fullName" value="<?php echo isset($_POST['submit']) ? $fullName : '' ; ?>">
            </div>
            <div>
                <label for="name">Email Address</label> <br>
                <input type="text" name="email" id="email" value="<?php echo isset($_POST['submit']) ? $email : '' ; ?>">
            </div>
            <div>
                <label for="password">Password</label> <br>
                <input type="password" name="password" id="password" value="<?php echo isset($_POST['submit']) ? $password : '' ; ?>">
            </div>
            <div>
                <label for="confirm-password">Confirm Password</label> <br>
                <input type="password" name="confirmPassword" id="confirm-password" value="<?php echo isset($_POST['submit']) ? $confirmPassword : '' ; ?>">
            </div>
            <span class="error"><?php echo $errorMessage; ?></span>
            <button type="submit" name="submit">Register</button>
        </form>
</main>
</body>
</html>