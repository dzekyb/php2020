<?php 
//     delete step and options selected from user from database
//     ## functions ##
//     * select - takes three arguments: connection, id, query. Returns every matching row from table provided by query

    session_start();
    if(!$_SESSION['fullName']) {
        header('Location: ../login');
        exit();
    }
    if(isset($_GET['id']) && isset($_GET['calc_id'])) {
        require_once('db_connection.php');
        require_once('functions.inc.php');
        $id = htmlspecialchars($_GET['id']);
        $calculatorId = htmlspecialchars($_GET['calc_id']);
        if(!validateCalculator($id) && !validateCalculator($calculatorId)) {

            // verifying that the step belongs to the current user
            $query = "SELECT * FROM calculator WHERE id = ?";
            $calculator = selectOne($conn, $calculatorId, $query);
            if($calculator['user_id'] == $_SESSION['id']) {

                //deleting the step and options
                $query = "SELECT * FROM step WHERE id = ?";
                $step = select($conn, $id, $query);
                if($step->num_rows > 0) {
                    while($row = $step->fetch_assoc()) {
                        $query = "SELECT * FROM options WHERE step_id = ?";
                        $result = select($conn, $row['id'], $query);
                        if($result->num_rows > 0) {
                            while($optionRow = $result->fetch_assoc()) {
                                if($optionRow['optionImage']) {
                                    unlink('../images/' . $optionRow['optionImage']);
                                }
                            }
                        }
                        $query = "DELETE FROM options WHERE step_id = ?";
                        delete($conn, $row['id'], $query);
                    }
                }
                $query = "DELETE FROM step WHERE id = ?";
                delete($conn, $id, $query);
                header('Location: ../edit/' . $calculatorId);
                exit();
            }
        } else {
            header('Location: ../index');
        }
    } else {
        header('Location: ../index');
    }

?>