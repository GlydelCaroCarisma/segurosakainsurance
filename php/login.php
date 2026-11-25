<?php
session_start();
include 'conn.php'; // Make sure this connects to db_seguro

$Uname = $_POST['xUname'] ?? '';
$pass  = $_POST['xpass'] ?? '';

if (!$Uname || !$pass) {
    echo "Please fill in all fields.";
    exit;
}

$sql = "SELECT * FROM tb_admin WHERE username = ? and password=";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $Uname);
$stmt->execute();
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if ($admin && password_verify($pass, $admin['password'])) {
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['admin_username'] = $admin['username'];
    echo "success";
} else {
    echo "Invalid username or password.";
}
?>
