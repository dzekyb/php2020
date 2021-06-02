<?php  
    // delete option user selected
    // ## functions ##
    // selectOne - takes three arguments: connection, id, query, returns row from database table depending on query
    // delete - takes three arguments: connection, id, query, deletes row from database table

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
                //finding the options row to remove the images from images folder
                $query = "SELECT * FROM options WHERE id = ?";
                $row = selectOne($conn, $id, $query);
                if($row['optionImage']) {
                    unlink('../images/' . $row['optionImage']);
                }
                //deleting the step and options
                $query = "DELETE FROM options WHERE id = ?";
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