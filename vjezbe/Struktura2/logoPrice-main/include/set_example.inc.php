<?php 
    // selecting calculator to render on examples page
    
    session_start();
    if(!isset($_SESSION['id'])) {
        header('Location: ../login');
        exit();
    }

    if(isset($_GET['id'])) {
        require_once('db_connection.php');
        require_once('functions.inc.php');

        $id = htmlspecialchars($_GET['id']);
        $error = validateCalculator($id);
        if($error) {
            header('Location: ../calculators');
            exit();
        }
        $query = "SELECT * FROM calculator WHERE id = ?";
        $calculator = selectOne($conn, $id, $query);
        if($calculator['user_id'] !== $_SESSION['id']) {
            header('Location: ../calculators');
            exit();
        }
        $update = '1';
        $stmt = $conn->stmt_init();
        if(!$stmt->prepare("UPDATE calculator SET defaultCalculators = ? WHERE id = ?")) {
            header('Location: ../calculators');
            exit();
        }
        $stmt->bind_param('si', $update, $id);
        $stmt->execute();
        $stmt->close();
        header('Location: ../calculators');
        exit();
    } else {
        header('Location: ../index');
        exit();
    }