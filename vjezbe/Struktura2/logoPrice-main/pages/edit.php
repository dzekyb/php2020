<?php
    // getting the id of the calculator to render the steps and options

    session_start();
    if(!isset($_SESSION['fullName'])) {
        header('Location: ../login');
        exit();
    }
    if(isset($_GET['id'])){
        require_once('include/db_connection.php');
        require_once('include/functions.inc.php');
        $id = htmlspecialchars($_GET['id']);
        $query = "SELECT * FROM calculator WHERE id = ?";
        $calculator = selectOne($conn, $id, $query);
        if($calculator['user_id'] !== $_SESSION['id'] || $calculator['archived'] === '1') {
            header('Location: ../calculators');
            exit();
        }
        $_SESSION['calculator_id'] = $calculator['id'];
    } else {
        header('Location: ../calculators');
    }
?>

<!DOCTYPE html>
<?php require_once('include/head.php'); ?>
<body>
    <?php require_once('include/admin/admin_nav.php'); ?>
    <?php require_once('include/admin/admin_sidebar.php'); ?>
    <main>
    <div class="main__heading"><h1><?php echo $calculator['calculatorName']; ?></h1></div>
    <?php
    $query = "SELECT * FROM step WHERE calculator_id = ?";
    $stepResult = select($conn, $id, $query);
    if($stepResult) { 
    ?>
    <form action="<?php base(); ?>include/edit.inc.php" enctype="multipart/form-data" method="POST">
        <div class="form calculator-form">
            <p class="error-message"></p>
            <div class="d-flex jc-sb gap-m">
                <div>
                    <div class="mb-s">
                        <label for="calculator-name">Calculator Name</label><br>
                        <input type="text" name="<?php echo $calculator['id']; ?>-calculatorName" id="calculator-name" disabled value="<?php echo $calculator['calculatorName']; ?>" >
                    </div>
                    <div>
                        <label for="estimate-text">Estimate Text</label>
                        <textarea name="estimateText" id="estimate-text" cols="30" rows="5" disabled value="<?php echo $calculator['estimateText']; ?>"><?php echo $calculator['estimateText']; ?></textarea>
                    </div>
                </div>
                <div>
                    <div class="mb-s">
                        <label for="calculator-heading">Calculator Heading</label>
                        <input type="text" name="calculatorHeading" id="calculator-heading" disabled value="<?php echo $calculator['heading']; ?>">
                    </div>
                    <div>
                        <label for="calculator-text">Calculator Text</label>
                        <textarea name="calculatorText" id="calculator-text" cols="30" rows="5" disabled value="<?php echo $calculator['calculatorText']; ?>"><?php echo $calculator['calculatorText']; ?></textarea>
                    </div>
                </div>
            </div>
            
            <div class="d-flex jc-sb gap-m">
                <div>
                    <label for="calculator-button">Calculator Button Text</label>
                    <input type="text" name="calculatorButton" id="calculator-button" disabled value="<?php echo $calculator['button']; ?>">
                </div>
                <div>
                    <label for="calculator-logo">Add logo</label>
                    <label for="calculator-logo" class="file__label calculator__label d-block">Upload Image</label>
                    <input type="file" name="calculatorLogo" id="calculator-logo" disabled >
                    <?php if($calculator['logo']) { ?>
                        <img src="<?php base(); echo 'images/calculator_logo/' . $calculator['logo']; ?>" alt="" class="calculator__logo">
                    <?php } else { ?>
                        <img src="" alt="" class="calculator__logo">
                    <?php } ?>
                </div>
            </div>
            <div class="d-flex jc-sb gap-m">
                <div>
                    <label for="background-color">Choose background color</label>
                    <input type="color" name="backgroundColor" id="background-color" disabled value="#<?php echo $calculator['backgroundColor']; ?>">
                </div>
                <div>
                    <label for="color">Choose text color</label>
                    <input type="color" name="color" id="color" disabled value="#<?php echo $calculator['color']; ?>">
                </div>
            </div>
            <div class="w-50">
                <?php require_once('include/currency_select.php'); ?>
            </div>
            <div class="edit-form__icons">
                <span class="edit-icon">
                    <i class="fas fa-edit"></i>
                </span>
            </div>
            <button class="save save__calc" name="saveCalculator">Save</button>
            <button class="cancel">Cancel</button>  
        </div>
        <?php
            while($stepRow = $stepResult->fetch_assoc()) { ?>
            <div class="form" data-id="<?php echo $calculator['id'] . '-' . $stepRow['id']; ?>">
                <div class="edit-form__question-container" >
                    <h3>Question</h3>
                    <p class="error-message"></p>
                    <input type="text" name="<?php echo $calculator['id'] . '-' . $stepRow['id'] . '-question'; ?>" disabled value="<?php echo $stepRow['stepName']; ?>">
                    <div class="edit-form__icons">  
                        <span class="edit-icon">
                            <i class="fas fa-edit"></i>
                        </span>
                        <a href="../include/delete_step.inc.php?calc_id=<?php echo $calculator['id'] . '&id=' . $stepRow['id']; ?>"" class="delete-icon">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div>
                    <button name="saveQuestion" class="save save__calc">Save</button>
                    <button class="cancel">Cancel</button>
                </div>
                <div class="calculator-option">
                    <?php
                        $i = 0;  
                        $query = "SELECT * FROM options WHERE step_id = ?";
                        $optionResult = select($conn, $stepRow['id'], $query);
                        while($optionRow = $optionResult->fetch_assoc()) { ?>
                        <div class="edit-form__option">
                            <h3>Option <?php echo ++$i; ?></h3>
                            <p class="error-message"></p>
                            <div>
                                <label for="<?php echo $optionRow['id'] . '-optionName'; ?>">Name</label>
                                <input type="text" disabled name="<?php echo $calculator['id'] . '-' . $optionRow['id'] . '-optionName'; ?>" id="<?php echo $optionRow['id'] . '-optionName'; ?>" value="<?php echo $optionRow['optionName']; ?>">
                            </div>
                            <div>
                                <label for="<?php echo $optionRow['id'] . '-' . $optionRow['optionPrice']; ?>">Price</label>
                                <input type="text" disabled name="<?php echo $optionRow['id'] . '-optionPrice'; ?>" id="<?php echo $optionRow['id'] . '-optionPrice'; ?>" value="<?php echo $optionRow['optionPrice']; ?>">
                            </div>
                            <div>
                                <label for="<?php echo $optionRow['id'] . '-optionImage'; ?>" class="file__label">Upload Image</label>
                                <input type="file" disabled name="<?php echo $optionRow['id'] . '-optionImage'; ?>" id="<?php echo $optionRow['id'] . '-optionImage'; ?>" value="<?php echo $optionRow['optionImage']; ?>">
                                <img src="<?php base(); echo 'images/' . $optionRow['optionImage']; ?>" class="option__image">
                            </div>
                            <div class="edit-form__icons">
                                <span class="edit-icon">
                                    <i class="fas fa-edit"></i>
                                </span>
                                <a href="../include/delete_option.inc.php?calc_id=<?php echo $calculator['id'] . '&id=' . $optionRow['id']; ?>" class="delete-icon">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                            <div class="edit-buttons">
                                <button class="save save__option" name="saveOptions">Save</button>
                                <button class="cancel">Cancel</button>    
                            </div>
                        </div>
                        <?php } ?>
                </div>
                <button class="add-option">Add option</button>
            </div>
            <?php } ?>
    </form>
    <?php } else { ?>
    <div>
        <p>Sorry, you don't have any questions in your calculator.</p>
    </div>
    <?php } ?>
    <a href="<?php base(); ?>add_question/<?php echo $id; ?>" id="redirect-link">Add question</a>
    </main>
    <script src="<?php base(); ?>js/sidebar.js"></script>
    <script src="<?php base(); ?>js/edit.js"></script>
    <script src="<?php base(); ?>js/preventSubmit.js"></script>
</body>
</html>