<?php

    // create calculator

    session_start();
    if(!isset($_SESSION['fullName'])) {
        session_unset();
        header('Location: login');
        exit();
    }
    $errorMessage = '';
    require_once('include/db_connection.php');
    require_once('include/functions.inc.php');

    if(isset($_POST['submit'])) {

        foreach($_POST as $key => $value) {
            if(empty($_POST[$key]) && $key !== 'submit') {
                $errorMessage = 'Fields can\'t be empty';
            }
        }

        $calculatorName = htmlspecialchars($_POST['calculatorName']);
        $estimateText = htmlspecialchars($_POST['estimateText']);
        $calculatorText = htmlspecialchars($_POST['calculatorText']);
        $calculatorHeading = htmlspecialchars($_POST['calculatorHeading']);
        $calculatorButton = htmlspecialchars($_POST['calculatorButton']);
        $calculatorCurrency = htmlspecialchars($_POST['calculatorCurrency']);
        $backgroundColor = substr($_POST['backgroundColor'], 1);
        $backgroundColor = htmlspecialchars($backgroundColor);
        $color = substr($_POST['color'], 1);
        $color = htmlspecialchars($color);
        //performing check of user input and storing the calculator id in SESSION
        $tempName = $_FILES['calculatorLogo']['tmp_name'];
        $fileName = $_FILES['calculatorLogo']['name'];
        $error = $_FILES['calculatorLogo']['error'];
        $directory = 'images/calculator_logo/';
        $path = file_exists($directory . $fileName) ? $directory . '/' . mt_rand(100, 999) . $fileName : $directory . $fileName;
        if(move_uploaded_file($tempName, $path) || $error == 4) {
            $calculatorLogo = $error == 4 ? '' : explode('/', $path)[2];
        }
        if(!$errorMessage) {
            if( $id = createCalculator($conn, $calculatorName,$estimateText, $calculatorHeading, $calculatorText, $calculatorButton, $calculatorLogo, $calculatorCurrency, $backgroundColor, $color,$_SESSION['id'])) {
                $_SESSION['calculator_id'] = $id;
                header('Location: questions');
                exit();
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('include/head.php'); ?>
<body>
    <?php require_once('include/admin/admin_nav.php'); ?>
    <?php require_once('include/admin/admin_sidebar.php'); ?>
    <main>
        <form action="" method="POST" enctype="multipart/form-data" class="form login">
        <div class="main__heading">
            <h1>Create Caltulator</h1>
        </div>
        <div>
            <label for="calculator-name">Calculator Name</label><br>
            <input type="text" name="calculatorName" id="calculator-name" value="<?php echo $_POST['calculatorName'] ?? ''; ?>">
        </div>
        <div>
            <label for="estimate-text">Estimate Text</label>
            <textarea name="estimateText" id="estimate-text" cols="30" rows="5" placeholder="What text to display the user on price estimate..." value="<?php echo $_POST['estimateText'] ?? ''; ?>"></textarea>
        </div>
        <div>
            <label for="calculator-heading">Calculator Heading</label>
            <input type="text" name="calculatorHeading" id="calculator-heading" value="<?php echo $_POST['calculatorHeading'] ?? ''; ?>">
        </div>
        <div>
            <label for="calculator-text">Calculator Text</label>
            <textarea name="calculatorText" id="calculator-text" cols="30" rows="5" placeholder="Calculator text..." value="<?php echo $_POST['calculatorText'] ?? ''; ?>"></textarea>
        </div>
        <div>
            <label for="calculator-button">Calculator Button Text</label>
            <input type="text" name="calculatorButton" id="calculator-button" value="<?php echo $_POST['calculatorButton'] ?? ''; ?>">
        </div>
        <div>
            <label for="calculator-logo" class="file__label calculator__label">Add logo</label>
            <input type="file" name="calculatorLogo" id="calculator-logo">
            <img src="" alt="" class="calculator__logo">
        </div>
        <div>
            <label for="background-color">Choose background color</label>
            <input type="color" name="backgroundColor" id="background-color" value="#f4f6f9">
        </div>
        <div>
            <label for="color">Choose text color</label>
            <input type="color" name="color" id="color" value="#212529">
        </div>
        <div>
            <?php require_once('include/currency_select.php'); ?>
        </div>
        <button type="submit" name="submit">Submit</button>
        <div class="message">
            <?php if($errorMessage) { ?>
                <span class="error__message"><?php echo $errorMessage ?? ''; ?></span>
            <?php } ?>
        </div>
    </form>
</main>
<script src="js/file_upload.js"></script>
<script src="js/sidebar.js"></script>
<script src="js/error_message.js"></script>
</body>
</html>

