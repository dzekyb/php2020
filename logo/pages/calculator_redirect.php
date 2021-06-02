<?php 
    //  getting calculator id and rendering calculator content, including steps and options 
  
    session_start();
    if(isset($_GET['id'])) {
        require_once('include/db_connection.php');
        require_once('include/functions.inc.php');
        $id = htmlspecialchars($_GET['id']);
        $errorMessage = '';
        if(!validateCalculator($id)) {
            // select calculator with matching id
            $query = "SELECT * FROM calculator WHERE id = ?";
            $calculator = selectOne($conn, $id, $query);
            if(!$calculator) {
                header('Location: ../index');
                exit();
            }
        }
    } else {
        header('Location: calculators');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<?php 
    require_once('include/head.php'); 
    if($calculator['archived'] == '0') {    
?>

<body style="background-color: #<?php echo $calculator['backgroundColor']; ?>; color: #<?php echo $calculator['color']; ?> ">
    <?php require_once('include/nav.php'); ?>
    <main>
        <div class="intro">
            <h1 class="intro__heading"><?php echo $calculator['heading']; ?></h1>
            <p class="intro__paragraph"><?php echo $calculator['calculatorText']; ?></p>
            <button class="intro__button"><?php echo $calculator['button']; ?></button>
            <?php if($calculator['logo']) { ?>
                <div class="intro__logo">
                    <img src="<?php base();?>images/calculator_logo/<?php echo $calculator['logo']?>" alt="calculator logo">
                </div>
            <?php } ?>
        </div>
        
            <?php
                $query = "SELECT * FROM step WHERE calculator_id = ?";
                $stepResult = select($conn, $calculator['id'], $query);
                if($stepResult->num_rows > 0) { ?>
                <form action="<?php base(); ?>estimate" method="POST">
                <?php while($stepRow = $stepResult->fetch_assoc()) { ?>

                    <div class="input-wrapper step-<?php echo $stepRow['id']; ?>">
                        <h2><?php echo $stepRow['stepName']; ?></h2>
                        <div class="input-wrapper__options">
                            <?php  
                                $query = "SELECT * FROM options WHERE step_id = ?";
                                $optionResult = select($conn, $stepRow['id'], $query);
                                while($optionRow = $optionResult->fetch_assoc()) { ?>

                                <div>
                                    <input type="radio" name="<?php echo $stepRow['id'] . '-answer'; ?>" id="<?php echo $optionRow['optionName']  . '-' . $stepRow['id']; ?> " value="<?php echo $stepRow['id'] . '-answer-' . $optionRow['id']; ?> ">
                                    <label for="<?php echo $optionRow['optionName'] . '-' . $stepRow['id']; ?> " class="option__label d-flex fd-c ai-c jc-c">
                                            <?php if($optionRow['optionImage']) { ?>
                                                <img src="<?php base(); ?>images/<?php echo $optionRow['optionImage'] ?>" alt="<?php echo $optionRow['optionName']; ?>" class="option-image">
                                            <?php } ?>
                                        <span class="option-span-text"><?php echo $optionRow['optionName'] ?></span>
                                    </label>
                                </div>
                                <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="input-wrapper">
                    <button name="submit" class="intro__button">Get your price estimate</button>                     
                </div>
                </form>
                
            <?php } else { ?>
                <div class="input-wrapper">
                    <p>No default calculator or no questions added to current calculator...</p>
                </div>
            <?php } ?>
    </main>
    <script src="<?php base(); ?>js/script.js"></script>
    <script src="<?php base(); ?>js/check_iframe.js"></script>
</body>
<?php } else { ?>
<body>
<?php require_once('include/nav.php'); ?>
    <main>
        <div class="intro form">
            <h1 class="intro__heading mb-s">Calculator no longer in use...</h1>
            <a href="../examples" class="intro__button">Check out another calculator</a>
        </div>
    </main>
</body>
<?php } ?>
</html>