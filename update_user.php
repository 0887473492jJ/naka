<?php
include 'function.php';
$objCon = connectDB();

// ตรวจสอบว่ามีค่า 'u_id' ส่งมาหรือไม่
if (!isset($_POST['u_id']) || empty($_POST['u_id'])) {
    die('Error: No user ID provided.');
}

$id = $_POST['u_id'];
$fullname = $_POST['u_fullname'];
$u_address = $_POST['u_address'];
$phone = $_POST['u_phone'];
$username = $_POST['u_username'];
$u_password = $_POST['u_password'];

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($objCon->connect_error) {
    die("Connection failed: " . $objCon->connect_error);
}

// ใช้ Prepared Statements เพื่อป้องกัน SQL Injection
$sql = "UPDATE user SET u_fullname=?, u_address=?, u_phone=?, u_username=?, u_password=? WHERE u_id=?";
$stmt = $objCon->prepare($sql);
$stmt->bind_param("sssssi", $fullname, $u_address, $phone, $username, $u_password, $id);

if ($stmt->execute()) {
    echo '<script>alert("แก้ไขเรียบร้อยแล้ว");window.location="edituser.php";</script>';
} else {
    echo "Error: " . $stmt->error;
    echo '<script>alert("พบข้อผิดพลาด");window.location="fr_user.php";</script>';
}

$stmt->close();
mysqli_close($objCon);
?>
