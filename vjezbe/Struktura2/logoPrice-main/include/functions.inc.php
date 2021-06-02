<?php

    //validating user registration input
    function validateUserInput($conn, $fullName, $email, $password, $confirmPassword) {
        $error = false;
        if(empty($fullName) || empty($email) || empty($password) || empty($confirmPassword)) {
            $error = 'Fields can\'t be empty';
            return $error;
        }
        if(!preg_match('/^[a-žA-Ž0-9\s]*$/', $fullName)) {
            $error = 'Please provide valid full name';
            return $error;
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please provide valid email';
            return $error;
        }
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);

        if(!$uppercase || !$lowercase || !$number || strlen($password) < 6 || strlen($password) > 10) {
            $error = 'Password must be a minimum of 6 characters, must contain 1 number, 1 uppercase and 1 lowercase character';
            return $error;
        }
        if($password !== $confirmPassword) {
            $error = 'Passwords must match';
            return $error;
        }
        if(userExists($conn, $email)) {
            $error = 'Email already taken';
        }
        return $error;
        
    }

    // validating other user inputs
    function validateCalculator($calculatorName) { 
        $error = false;
        if(empty($calculatorName)) {
            $error = 'Question and option fields can\'t be empty';
            return $error;
        }
        if(!preg_match('/^[a-z0-9A-Z\s\?]*$/', $calculatorName)) {
            $error = 'Please provide valid input, no special characters allowed in option and question fields';
            return $error;
        }
        return $error;
    }

    //validate price input
    function validateNumber($num) {
        if(!preg_match('/^[0-9]+$/', $num)) {
            $error = 'Please provide valid price';
            return $error;
        }
        return false;
    }

    //validate image upload
    function validateFileUpload($k) {
        require_once('file_upload_error_array.php');
        $allowed = array('jpg', 'jpeg', 'png');
        $extension = pathinfo($_FILES[$k]["name"], PATHINFO_EXTENSION);
        if(!in_array($extension, $allowed) && !empty($extension)) {
            $errorMessage = 'Sorry, only JPG, JPEG, PNG files are allowed.';
            return $errorMessage;
        } 
        if($_FILES[$k]['error'] != 4 && $_FILES[$k]['error'] != 0) {
            $errorMessage = $fileUploadError[ $_FILES[$k]['error']];
            return $errorMessage;
        }
        if (($_FILES[$k]["size"] > 2000000)) {
            $errorMessage = "Image size exceeds 2MB";
            return $errorMessage;
        }
        return false;
    }

    // checking if user exists
    function userExists($conn, $email) {
        $error = false;

        if(!$stmt = $conn->prepare("SELECT * FROM user WHERE userEmail = ?")) {
            $error = 'Error';
            return $error;
        }

        $stmt -> bind_param('s', $email);
        $stmt -> execute();
        $res = $stmt -> get_result();
        if($row = $res -> fetch_assoc()) {
            return $row;
        }
        $stmt -> close();
        return $error;

    }
    // creating a user
    function createUser($conn, $fullName, $email, $password) {
        $stmt = $conn->stmt_init();
        if(!$stmt->prepare("INSERT INTO user (fullName, userEmail, userPassword) VALUES (?,?,?)")) {
            $error = 'Error';
            return $error;
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param('sss', $fullName, $email, $hashedPassword);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
    // finding user on login
    function findUser($conn, $email, $password) {
        $error = false;
        $user = userExists($conn, $email);
        
        if(!$user) {
            $error = 'Wrong email or password.';
            return $error;
        }
        if(password_verify($password, $user['userPassword'])) {
            session_start();
            $_SESSION['fullName'] = $user['fullName'];
            $_SESSION['id'] = $user['id'];
            header('Location: calculators');
            exit();
        } else {
            $error = 'Wrong email or password.';
            return $error;
        }
    }
    //creating calculator
    function createCalculator($conn, $name, $estimate, $heading, $text, $button, $currency, $logo, $backgroundColor, $color, $id) {
        $stmt = $conn->stmt_init();
        if(!$stmt->prepare("INSERT INTO calculator (calculatorName, estimateText, heading, calculatorText, button, logo, currency, backgroundColor, color, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
            $error = 'Error';
            return $error;
        }
        $stmt->bind_param('ssssssssss', $name, $estimate, $heading, $text, $button, $currency, $logo, $backgroundColor, $color ,$id);
        $stmt->execute();
        return $stmt->insert_id;
    }
    // selecting one row from database
    function selectOne($conn,$name, $query) {
        $error = false;

        if(!$stmt = $conn->prepare("{$query}")) {
            $error = 'Error';
            return $error;
        }

        $stmt -> bind_param('s', $name);
        $stmt -> execute();
        $res = $stmt -> get_result();
        if($row = $res -> fetch_assoc()) {
            return $row;
        }
        $stmt -> close();
        return $error;
    }
    
    // inserting data into step table
    function createStep($conn, $name, $id) {
        $stmt = $conn->stmt_init();
        if(!$stmt->prepare("INSERT INTO step (stepName, calculator_id) VALUES (?, ?)")) {
            $error = 'Error';
            return $error;
        }
        $stmt->bind_param('ss', $name, $id);
        $stmt->execute();
        $stmt->close();
        return false;
    }

    //selecting step when calculator is created
    function selectStep($conn, $name, $id) {
        $error = false;

        if(!$stmt = $conn->prepare("SELECT * FROM step WHERE stepName = ? AND calculator_id = ?")) {
            $error = 'Error';
            return $error;
        }

        $stmt -> bind_param('ss', $name, $id);
        $stmt -> execute();
        $res = $stmt -> get_result();
        if($row = $res -> fetch_assoc()) {
            return $row;
        }
        $stmt -> close();
        return $error;
    }

    function createOptions($conn, $name, $price, $url, $id) {
        $stmt = $conn->stmt_init();
        if(!$stmt->prepare("INSERT INTO options (optionName, optionPrice, optionImage, step_id) VALUES (?, ?, ?, ?)")) {
            $error = 'Error';
            return $error;
        }
        $stmt->bind_param('ssss', $name, $price, $url, $id);
        $stmt->execute();
        $stmt->close();
        return false;
    }
    //select all rows affected by query
    function select($conn,$name, $query) {
        $error = false;

        if(!$stmt = $conn->prepare("{$query}")) {
            $error = 'Error';
            return $error;
        }

        $stmt -> bind_param('s', $name);
        $stmt -> execute();
        $res = $stmt -> get_result();
        return $res;
    }

    function delete($conn, $name, $query) {
        if(!$stmt = $conn->prepare("{$query}")) {
            $error = 'Error';
            return $error;
        }

        $stmt -> bind_param('s', $name);
        $stmt -> execute();
        $stmt -> close();
    }
    
?>