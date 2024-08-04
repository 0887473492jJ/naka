<?php
session_start(); // เริ่มต้น session

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบแล้วหรือยัง
if (isset($_SESSION['user_login'])) {
    header("Location: index.php"); // เปลี่ยนเส้นทางไปยังหน้า index.php
    exit;
}
include_once("./function.php");
$objCon = connectDB(); // เชื่อมต่อฐานข้อมูล

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if (!$objCon) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . mysqli_connect_error());
}

// รับค่า username และ password จากการส่งข้อมูลแบบ POST
$username = $_POST['username'];
$password = $_POST['password'];

// ใช้ Prepared Statements เพื่อป้องกัน SQL Injection
$stmt = $objCon->prepare("SELECT * FROM user WHERE u_username = ? AND u_password = md5(?)");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

// ตรวจสอบผลลัพธ์
if ($result->num_rows > 0) {
    $res = $result->fetch_assoc();
    $_SESSION['user_login'] = array(
        'id' => $res['u_id'],
        'fullname' => $res['u_fullname'],
        'level' => $res['u_level']
    );

    // เปลี่ยนเส้นทางตามสิทธิ์ของผู้ใช้
    switch ($res['u_level']) {
        case 'administrator':
            header("Location: admin.php");
            break;
        case 'manager':
            header("Location: manager.php");
            break;
        case 'user':
            header("Location: index.php");
            break;
        default:
            header("Location: login.php?error=2");
            break;
    }
} else {
    header("Location: login.php?error=1"); // หากข้อมูลผู้ใช้ไม่ถูกต้อง
    exit;
}

// ปิดการเชื่อมต่อฐานข้อมูล
$stmt->close();
$objCon->close();
?>
