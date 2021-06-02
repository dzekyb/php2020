<?php 
 
    // including the create_question to save user input to matching table in database, and we include the question_form 

    session_start();
    if(!isset($_SESSION['fullName'])) {
        header('Location: login');
        exit();
    }
    $errorMessage = '';
    $successMessage = '';
    $calculatorId = '';
    //getting the calculator ID so we can return to the same calculator
    if(isset($_GET['id'])) {
        $calculatorId = htmlspecialchars($_GET['id']);
        $_SESSION['calculator_id'] = $calculatorId;
    }
    require_once('include/db_connection.php');
    require_once('include/functions.inc.php');

    // return to calculator
    if(isset($_POST['finish'])) {
        $base = str_replace('index.php', '',$_SERVER['PHP_SELF']);
        unset($_SESSION['calculator_id']);
        header('Location: ' . $base . 'edit/' . $calculatorId);
        exit();
    }

    // including file where the questions and options are handled
    if(isset($_POST['submit'])) {
        require_once('include/create_question.inc.php');
     }
?>
<!DOCTYPE html>
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
        <div id="message">
        <?php if($successMessage) { ?>
            <span class="success__message"><?php echo $successMessage ?? ''; ?></span>
        <?php } elseif ($errorMessage) { ?> 
            <span class="error__message"><?php echo $errorMessage ?? ''; ?></span>
        <?php } else {} ?>
        </div>
        <button name="submit">save</button>
        <button name="finish">done</a>
    </form>
</main>
<script src="<?php base(); ?>js/script2.js"></script>
<script src="<?php base(); ?>js/sidebar.js"></script>
</body>
</html>