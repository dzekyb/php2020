<?php
    // rendering archived calculators

    session_start();
    if(!isset($_SESSION['fullName'])) {
        session_unset();
        header('Location: login');
        exit();
    }
    require_once('include/db_connection.php');
    require_once('include/functions.inc.php');

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
        $archived = 1;
        $query = "SELECT * FROM calculator WHERE user_id = ? AND archived = ?";
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
                        <span class="calculator__span">Click on calculator name to preview</span>
                    </h3>
                    <span class="calculator__date">Created: <?php $time = strtotime($row['date']); echo date('d-m-Y H:i', $time) ; ?></span>
                    <a href="include/restore.inc.php?id=<?php echo $row['id']; ?>" class="calculator__btn edit m-width">Restore</a>
                </div>
        <?php } ?>
            </div>
        <?php } else { ?>
            <p>You don't have any calculators in archive...</p>
        <?php } ?>
        
    </div>
    </main>
    <script src="js/sidebar.js"></script>
</body>
</html>