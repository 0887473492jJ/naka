<?php
include_once('./function.php');
$objCon = connectDB();

$data = $_POST;
$u_fullname = $data['u_fullname'];
$u_username = $data['u_username'];
$u_password = $data['u_password'];
$confirm_password = $data['confirm_password'];
$u_address = $data['u_address'];
$u_phone = $data['u_phone'];
$u_level = $data['u_level'];

// ตรวจสอบว่ารหัสผ่านและการยืนยันรหัสผ่านตรงกันหรือไม่
if ($u_password != $confirm_password) {
    echo '<script>alert("รหัสผ่านและการยืนยันรหัสผ่านไม่ตรงกัน");window.location="register.html";</script>';
    exit();
}

// เข้ารหัสรหัสผ่านด้วย md5
$u_password = md5($u_password);

// ตรวจสอบว่า u_username มีอยู่ในฐานข้อมูลหรือไม่
$checkSQL = "SELECT * FROM user WHERE u_username = '$u_username'";
$checkQuery = mysqli_query($objCon, $checkSQL) or die(mysqli_error($objCon));

if (mysqli_num_rows($checkQuery) > 0) {
    // ถ้า u_username มีอยู่แล้ว
    echo '<script>alert("ชื่อผู้ใช้นี้มีอยู่แล้ว กรุณาใช้ชื่อผู้ใช้อื่น");window.location="register.php";</script>';
} else {
    // ถ้า u_username ยังไม่มีในฐานข้อมูล
    $strSQL = "INSERT INTO user(
        u_fullname,
        u_username,
        u_password, 
        u_address, 
        u_phone, 
        u_level
    ) VALUES (
        '$u_fullname', 
        '$u_username', 
        '$u_password', 
        '$u_address',
        '$u_phone',
        '$u_level'
    )";

    $objQuery = mysqli_query($objCon, $strSQL) or die(mysqli_error($objCon));

    if ($objQuery) {
        echo '<script>alert("ลงทะเบียนเรียบร้อยแล้ว");window.location="login.php";</script>';
    } else {
        echo '<script>alert("พบข้อผิดพลาด");window.location="register.php";</script>';
    }
}
?>