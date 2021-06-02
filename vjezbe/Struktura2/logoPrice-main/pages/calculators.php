<?php  

    // rendering user calculators

    session_start();
    if(!isset($_SESSION['fullName'])) {
        session_unset();
        header('Location: login');
        exit();
    }
    require_once('include/db_connection.php');
    require_once('include/functions.inc.php');
    $http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $iframeLink = $http . '://' . $_SERVER['HTTP_HOST'];
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once('include/head.php'); ?>
<body>
    <?php require_once('include/admin/admin_nav.php'); ?>
    <?php require_once('include/admin/admin_sidebar.php'); ?>
    <main>
    <div class="main__heading">
        <h1>Dashboard</h1>
    </div>
    <?php 
        $archived = 0;
        $query = "SELECT * FROM calculator WHERE user_id = ? AND archived = ? ORDER BY id DESC";
        $stmt = $conn->stmt_init();
        if(!$stmt->prepare($query)) {
            die($stmt->error);
        }
        $stmt->bind_param('is', $_SESSION['id'], $archived);
        $stmt->execute();
        $calculators = $stmt->get_result();
        $stmt->close();
        if($calculators->num_rows > 0) { ?>
            <div class="calculator__wrapper">
            <?php while($row = $calculators->fetch_assoc()) { ?>
                <div class="calculator">
                    <img src="images/calculator.svg" alt="calculator" class="calculator__image">
                    <h3 class="calculator__heading">
                        <a href="<?php echo 'calculator_redirect/' .  $row['id']; ?>">
                            <?php echo $row['calculatorName']; ?>
                        </a>
                        <span class="calculator__span">(Click on calculator name to preview)</span>
                    </h3>
                    <span class="calculator__date"><?php $time = strtotime($row['date']); echo date('d-m-Y H:i', $time) ; ?></span>
                    <a href="edit/<?php echo $row['id']; ?>" class="calculator__btn edit">Edit</a>
                    <span class="calculator__btn delete">Archive</span>
                    <?php if($row['defaultCalculators'] == 0) { ?>
                        <a href="include/set_example.inc.php?id=<?php echo $row['id']; ?>" class="calculator__btn primary-btn">Set as example</a>
                    <?php } else { ?>
                        <a href="include/remove_example.inc.php?id=<?php echo $row['id']; ?>" class="calculator__btn primary-btn">Remove from examples</a>
                    <?php } ?>
                <div class="iframe">
                    <input type="text" class="iframe__text" value="<iframe src='<?php echo $iframeLink; base(); echo 'calculator_redirect/' .  $row['id']; ?>' width='100%' height='500px' title='Calculator iframe'></iframe>">
                    <button class="iframe__copy">Copy iframe</button>
                </div>
                <div class="modal-overlay">
                    <div class="modal">
                        <div class="modal__heading">
                            <h3>ARCHIVE CONFIRMATION</h3>
                        </div>
                        <div class="modal__warning">
                            <p>Are you sure you want to delete calculator?</p>
                        </div>
                        <div class="modal__button">
                            <a href="include/delete.inc.php?id=<?php echo $row['id']; ?>" class="calculator__btn delete">Archive</a>
                            <span class="calculator__btn cancel">Cancel</span>
                        </div>
                    </div>
                </div>
                </div>
        <?php } ?>
            </div>
        <?php } else { ?>
            <p>You haven't created any calculators yet...</p>
        <?php } ?>
        
    </div>
    </main>
    <script src="js/sidebar.js"></script>
    <script src="js/copy.js"></script>
    <script src="js/modal.js"></script>
</body>
</html>