<?php
session_start();

$userId = $_POST['user_id'] ?? '';
$password = $_POST['password'] ?? '';

$csvPath = '../csv/users.csv';
$authSuccess = false;

if (file_exists($csvPath)) {
    $fp = fopen($csvPath, "r");
    while (($row = fgetcsv($fp)) !== FALSE) {
        // row[0]:ID,row[1]:パスワード, row[2]:権限
        if ($row[0] === $userId) {
            if (password_verify($password, trim($row[1]))) {
                $_SESSION['user_id'] = $row[0];
                $_SESSION['user_role'] = $row[2]; 
                $authSuccess = true;
                break;
            }
        }
    }
    fclose($fp);
}

if ($authSuccess) {
    header("Location: home.php"); 
} else {
    header("Location: login.php?error=1"); 
}
exit;