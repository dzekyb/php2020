<?php
    // the file includes create_question for storing provided data and question_form for providing the data 


    session_start();
    if(!isset($_SESSION['fullName'])) {
        header('Location: login');
        exit();
    }
    if(!isset($_SESSION['calculator_id'])) {
        header('Location: create_calc');
        exit();
    }
    $errorMessage = '';
    $successMessage = '';
    require_once('include/db_connection.php');
    require_once('include/functions.inc.php');
    if(isset($_POST['finish'])) {
        unset($_SESSION['calculator_id']);
        header('Location: calculators');
        exit();
    }
    if(isset($_POST['submit'])) {
       require_once('include/create_question.inc.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once('include/head.php'); ?>
<body>
    <?php require_once('include/admin/admin_nav.php'); ?>
    <?php require_once('include/admin/admin_sidebar.php'); ?>
    <main>
    <div class="main__heading">
        <h1>Add questions</h1>
    </div>
    <form action="" method="POST" enctype="multipart/form-data" class="form">
        <?php require_once('include/question_form.php'); ?>
        <div class="message">
            <?php if($successMessage) { ?>
                <span class="success__message"><?php echo $successMessage ?? ''; ?></span>
            <?php } elseif ($errorMessage) { ?> 
                <span class="error__message"><?php echo $errorMessage ?? ''; ?></span>
            <?php } else {} ?>
        </div>
        <button name="submit">Save</button>
        <button name="finish">done</a>
    </form>
</main>
<script src="js/script2.js"></script>
<script src="js/error_message.js"></script>
<script src="js/sidebar.js"></script>
</body>
</html>