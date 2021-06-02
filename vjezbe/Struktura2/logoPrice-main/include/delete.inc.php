<?php 
    //  archive calculator
    // ## functions ##
    // * select - takes three arguments: connection, id, query. Returns every matching row from table provided by query
    // * unlink - removes image file from images folder

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
                $archived = '1';
                $query = "UPDATE calculator SET archived = ? WHERE id = ?";
                $stmt = $conn->stmt_init();
                if(!$stmt->prepare($query)) {
                    die($stmt->error);
                }

                $stmt->bind_param('si', $archived, $id);
                $stmt->execute();
                $stmt->close();
                $conn->close();
            //     $query = "SELECT * FROM step WHERE calculator_id = ?";
            //     $step = select($conn, $calculator['id'], $query);
            //     if($step->num_rows > 0) {
            //         while($row = $step->fetch_assoc()) {
            //             $query = "SELECT * FROM options WHERE step_id = ?";
            //             $result = select($conn, $row['id'], $query);
            //             if($result->num_rows > 0) {
            //                 while($optionRow = $result->fetch_assoc()) {
            //                     if($optionRow['optionImage']) {
            //                         unlink('../images/' . $optionRow['optionImage']);
            //                     }
            //                 }
            //             }
            //             $query = "DELETE FROM options WHERE step_id = ?";
            //             delete($conn, $row['id'], $query);
            //         }
            //     }
            //     $query = "DELETE FROM step WHERE calculator_id = ?";
            //     delete($conn, $calculator['id'], $query);
            //     $query = "DELETE FROM calculator WHERE id = ?";
            //     if($calculator['logo']) {
            //         unlink('../images/calculator_logo/' . $calculator['logo']);
            //     }
            //     $error = delete($conn, $id, $query);
                header('Location: ../calculators');
                exit();
            }
        } else {
            header('Location: ../index');
        }
    } else {
        header('Location: ../index');
    }