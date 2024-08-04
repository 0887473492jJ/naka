<?php
include 'function.php';
$objCon = connectDB();

$u_id = $_POST['u_id'];
$u_fullname = $_POST['u_fullname'];
$u_address = $_POST['u_address'];
$u_phone = $_POST['u_phone'];
$u_username = $_POST['u_username'];
$u_password = isset($_POST['u_password']) ? $_POST['u_password'] : ''; // รหัสผ่านใหม่

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($objCon->connect_error) {
    die("Connection failed: " . $objCon->connect_error);
}

// ตรวจสอบว่ามีการป้อนรหัสผ่านใหม่หรือไม่
if (!empty($u_password)) {
    // ใช้ Prepared Statements เพื่อป้องกัน SQL Injection
    $sql = "UPDATE user SET u_fullname=?, u_address=?, u_phone=?, u_username=?, u_password=? WHERE u_id=?";
    $stmt = $objCon->prepare($sql);
    $stmt->bind_param("sssssi", $u_fullname, $u_address, $u_phone, $u_username, $u_password, $u_id);
} else {
    // ถ้าไม่เปลี่ยนรหัสผ่าน
    $sql = "UPDATE user SET u_fullname=?, u_address=?, u_phone=?, u_username=? WHERE u_id=?";
    $stmt = $objCon->prepare($sql);
    $stmt->bind_param("ssssi", $u_fullname, $u_address, $u_phone, $u_username, $u_id);
}

// ตรวจสอบการเตรียมคำสั่ง SQL
if ($stmt === false) {
    die("Error preparing statement: " . $objCon->error);
}

if ($stmt->execute()) {
    // ตรวจสอบระดับผู้ใช้เพื่อเปลี่ยนเส้นทางไปยังหน้าที่เหมาะสม
    $user_sql = "SELECT u_level FROM user WHERE u_id=?";
    $user_stmt = $objCon->prepare($user_sql);
    $user_stmt->bind_param("i", $u_id);
    $user_stmt->execute();
    $user_stmt->bind_result($level);
    $user_stmt->fetch();
    $user_stmt->close();

    // เปลี่ยนเส้นทางตามระดับผู้ใช้
    switch ($level) {
        case 'admin':
            echo '<script>alert("แก้ไขเรียบร้อยแล้ว");window.location="admin.php";</script>';
            break;
        case 'manager':
            echo '<script>alert("แก้ไขเรียบร้อยแล้ว");window.location="manager.php";</script>';
            break;
        case 'user':
            echo '<script>alert("แก้ไขเรียบร้อยแล้ว");window.location="user.php";</script>';
            break;
        default:
            echo '<script>alert("ระดับผู้ใช้ไม่ถูกต้อง");window.location="editformuser.php";</script>';
            break;
    }
} else {
    echo "Error: " . $stmt->error;
    echo '<script>alert("พบข้อผิดพลาด");window.location="editformuser.php";</script>';
}

$stmt->close();
mysqli_close($objCon);
?>
