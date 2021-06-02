<!-- 
    - updating and adding steps and options for a specific calculator
    - check the POST array for saveOptions, submit or saveQuestion keys
    ### saveOption ###
    - updating options table with updated data
    ### submit ###
    - adding new option to options table
    ### saveQuestion ###
    - updating question table with updated data
 -->
<?php 
    session_start();
    if(!isset($_SESSION['fullName'])) {
        session_unset();
        header('Location: index');
        exit();
    }
    

    // update option
    if(isset($_POST['saveOptions'])) {
        require_once('db_connection.php');
        require_once('functions.inc.php');
        $errorMessage = '';
        foreach($_POST as $k => $v) {
            if (strpos($k, 'optionName')) {
                $errorMessage = validateCalculator($v);
                if($errorMessage) {
                    break;
                }
                $optionName = htmlspecialchars($v);
                $id = htmlspecialchars(explode('-', $k)[1]);
                $calc_id = htmlspecialchars(explode('-', $k)[0]);
            }
            if(strpos($k, 'optionPrice')) {
                $errorMessage = validateNumber($v);
                if($errorMessage) {
                    break;
                }
                $optionPrice = htmlspecialchars($v);
            }
        }

        if(array_key_exists($id . '-optionImage', $_FILES) && $_FILES[$id . '-optionImage']['error'] != 4) {
            $errorMessage = validateFileUpload($id . '-optionImage');
            $tempName = $_FILES[$id . '-optionImage']['tmp_name'];
            $fileName = $_FILES[$id . '-optionImage']['name'];
            $directory = 'images';
            $path = file_exists('../images/' . $fileName) ? 'images/' . mt_rand(100, 999) . $fileName : 'images/' . $fileName;
            $error = $_FILES[$id . '-optionImage']['error'];
            $optionImage = $error == 4 ? '' : explode('/', $path)[1];
            if(!$errorMessage) {
                if($optionImage) {
                    move_uploaded_file($tempName, '../' . $path);
                }
                $query = "SELECT * FROM options WHERE id = ?";
                $row = selectOne($conn, $id, $query);
                if($row['optionImage']) {
                    unlink('../images/' . $row['optionImage']);
                }
                $query = "UPDATE options SET optionName=?, optionPrice=?, optionImage=? WHERE id = ?";
                $stmt = $conn->stmt_init();
                if(!$stmt -> prepare($query)) {
                    header('Location: ../edit/' . $calc_id . '&error=stmtError');
                    exit();
                } else {
                    $stmt->bind_param('ssss', $optionName, $optionPrice, $optionImage, $id);
                    $stmt->execute();
                    $stmt->close();
                    header('Location: ../edit/' . $calc_id);
                    exit();
                }

        } else {
            header('Location: ../edit/' . $calc_id);
            exit();
        }
    } else {
        if(!$errorMessage) {

            $query = "UPDATE options SET optionName=?, optionPrice=? WHERE id = ?";
            $stmt = $conn->stmt_init();
            if(!$stmt -> prepare($query)) {
                header('Location: ../edit/' . $calc_id . '&error=stmtError');
                exit();
            } else {
                $stmt->bind_param('sss', $optionName, $optionPrice, $id);
                $stmt->execute();
                $stmt->close();
                header('Location: ../edit/' . $calc_id);
                exit();
            }
        }
    }
    }

    // add one more option to options table 
    if(isset($_POST['submit'])) {
        require_once('db_connection.php');
        require_once('functions.inc.php');
        $errorMessage = '';
        foreach($_POST as $k => $v) {
            if (strpos($k, 'name')) {
                $errorMessage = validateCalculator($v);
                if($errorMessage) {
                    break;
                }
                $optionName = htmlspecialchars($v);
                $step_id = htmlspecialchars(explode('-', $k)[1]);
                $calc_id = htmlspecialchars(explode('-', $k)[0]);
            }
            if(strpos($k, 'price')) {
                $errorMessage = validateNumber($v);
                if($errorMessage) {
                    break;
                }
                $optionPrice = htmlspecialchars($v);
            }
        }
        if(array_key_exists($calc_id . '-' . $step_id . '-url', $_FILES)) {
            $errorMessage = validateFileUpload($calc_id . '-' . $step_id . '-url');
            $tempName = $_FILES[$calc_id . '-' . $step_id . '-url']['tmp_name'];
            $fileName = $_FILES[$calc_id . '-' . $step_id . '-url']['name'];
            $directory = 'images';
            $path = file_exists('../' . $directory . '/' . $fileName) ? $directory . '/' . mt_rand(100,999) . $fileName : $directory . '/' . $fileName;
            $error = $_FILES[$calc_id . '-' . $step_id . '-url']['error'];
            $optionImage = $error == 4 ? '' : explode('/', $path)[1];
        }
        if(!$errorMessage) {
            if($optionImage) {
                move_uploaded_file($tempName, '../' . $path);
            }
            $query = "SELECT * FROM step WHERE id = ?";
            $step = selectOne($conn, $step_id, $query);
            createOptions($conn, $optionName, $optionPrice, $optionImage, $step['id']);
            header('Location: ../edit/' . $calc_id);
            exit();
        }
        else {
            header('Location: ../edit/' . $calc_id);
            exit();
        }
    }

    //update question field
    if(isset($_POST['saveQuestion'])) {
        require_once('db_connection.php');
        require_once('functions.inc.php');
        foreach($_POST as $k => $v) {
            if(strpos($k, 'question')) {
                $question = htmlspecialchars($v);
                $calc_id = htmlspecialchars(explode('-', $k)[0]);
                $id = htmlspecialchars(explode('-', $k)[1]);
            }
        }
        $query = "UPDATE step SET stepName = ? WHERE id = ?";
        $stmt = $conn->stmt_init();
        if(!$stmt -> prepare($query)) {
            header('Location: ../edit/' . $calc_id . '&error=stmtError');
            exit();
        } else {
            $stmt->bind_param('ss', $question, $id);
            $stmt->execute();
            $stmt->close();
            header('Location: ../edit/' . $calc_id);
            exit();
        }
    }

    // update calculator fields
    if(isset($_POST['saveCalculator'])) {
        require_once('db_connection.php');
        require_once('functions.inc.php');
        $errorMessage = '';
        foreach($_POST as $key => $value) {
            if(empty($_POST[$key]) && $key !== 'saveCalculator') {
                $errorMessage = 'Fields can\'t be empty';
            }
            if(strpos($key, 'calculatorName')) {
                $calculatorId = htmlspecialchars(explode('-', $key)[0]);
                $calculatorName = htmlspecialchars($_POST[$key]);
            }
        }
        $estimateText = htmlspecialchars($_POST['estimateText']);
        $calculatorText = htmlspecialchars($_POST['calculatorText']);
        $calculatorHeading = htmlspecialchars($_POST['calculatorHeading']);
        $calculatorButton = htmlspecialchars($_POST['calculatorButton']);
        $calculatorCurrency = htmlspecialchars($_POST['calculatorCurrency']);
        $backgroundColor = substr($_POST['backgroundColor'], 1);
        $backgroundColor = htmlspecialchars($backgroundColor);
        $color = substr($_POST['color'], 1);
        $color = htmlspecialchars($color);
        if($_FILES['calculatorLogo']['error'] != 4 ) {
            $errorMessage = validateFileUpload('calculatorLogo');
        }
        if(!$errorMessage) {
            if($_FILES['calculatorLogo']['error'] != 4 ) {
                $query = "SELECT * FROM calculator WHERE id = ?";
                $calculator = selectOne($conn, $calculatorId, $query);
                if($calculator['logo']) {
                    unlink('../images/calculator_logo/' . $calculator['logo']);
                }
                $tempName = $_FILES['calculatorLogo']['tmp_name'];
                $fileName = $_FILES['calculatorLogo']['name'];
                $error = $_FILES['calculatorLogo']['error'];
                $directory = '../images/calculator_logo/';
                $path = file_exists($directory . $fileName) ? $directory . '/' . mt_rand(100, 999) . $fileName : $directory . $fileName;
                if(move_uploaded_file($tempName, $path) || $error == 4) {
                    $calculatorLogo = $error == 4 ? '' : explode('/', $path)[3];
                }
                
            }
            $calculatorLogo = $calculatorLogo ?? '';
            $query = "UPDATE calculator SET calculatorName = ?, estimateText = ?, heading = ?, calculatorText = ?, button = ?, logo = ?, currency = ?, backgroundColor = ?, color = ?, user_id = ? WHERE id = ?";
            $stmt = $conn->stmt_init();
            if(!$stmt->prepare($query)) {
                die($stmt->error);
            }
            $stmt->bind_param('sssssssssss', $calculatorName, $estimateText, $calculatorHeading, $calculatorText, $calculatorButton, $calculatorLogo, $calculatorCurrency, $backgroundColor, $color, $_SESSION['id'], $calculatorId);
            $stmt->execute();
            $stmt->close();
            $conn->close();
            header('Location: ../edit/' . $calculatorId);
            exit();
        }
    }
    if(!isset($_POST['submit']) || !isset($_POST['saveOption']) || !isset($_POST['saveCalculator']) || !isset($_POST['saveQuestion'])) {
        header('Location: ../calculators');
        exit();
    }
?>