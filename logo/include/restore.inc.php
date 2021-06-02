<?php
    // restore calculator

    session_start();
    if(!$_SESSION['fullName']) {
        header('Location: ../login');
        exit();
    }
    if(isset($_GET['id'])) {
        require_once('db_connection.php');
        require_once('functions.inc.php');
        $id = htmlspecialchars($_GET['id']);
        if(!validateCalculator($id)) {
            $query = "SELECT * FROM calculator WHERE id = ?";
            $calculator = selectOne($conn, $id, $query);
            if($calculator['user_id'] == $_SESSION['id']) {
                $archived = '0';
                $query = "UPDATE calculator SET archived = ? WHERE id = ?";
                $stmt = $conn->stmt_init();
                if(!$stmt->prepare($query)) {
                    die($stmt->error);
                }

                $stmt->bind_param('si', $archived, $id);
                $stmt->execute();
                $stmt->close();
                $conn->close();
                header('Location: ../archived');
                exit();
            }
        } else {
            header('Location: ../index');
        }
    } else {
        header('Location: ../index');
    }
?>