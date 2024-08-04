<?php
include 'function.php';
$objCon = connectDB();

// ตรวจสอบว่ามีค่า 'e_id' ส่งมาหรือไม่
if (!isset($_POST['e_id']) || empty($_POST['e_id'])) {
    die('Error: No estate ID provided.');
}

$id = $_POST['e_id'];
$e_name = $_POST['e_name'];
$e_sales_type = $_POST['e_sales_type'];
$e_area = $_POST['e_area'];
$e_price = $_POST['e_price'];
$e_subdistrict = $_POST['e_subdistrict'];
$e_district = $_POST['e_district'];
$e_province = $_POST['e_province'];
$e_details = $_POST['e_details'];
$e_insurance = $_POST['e_insurance'];
$e_owner = $_POST['e_owner'];
$e_latitude = $_POST['e_latitude'];
$e_longitude = $_POST['e_longitude'];

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($objCon->connect_error) {
    die("Connection failed: " . $objCon->connect_error);
}

// ใช้ Prepared Statements เพื่อป้องกัน SQL Injection
$sql = "UPDATE estate SET e_name=?, e_sales_type=?, e_area=?, e_price=?, e_subdistrict=?, e_district=?, e_province=?, e_details=?, e_insurance=?, e_owner=?, e_latitude=?, e_longitude=? WHERE e_id=?";
$stmt = $objCon->prepare($sql);
$stmt->bind_param("ssssssssssddi", $e_name, $e_sales_type, $e_area, $e_price, $e_subdistrict, $e_district, $e_province, $e_details, $e_insurance, $e_owner, $e_latitude, $e_longitude, $id);

if ($stmt->execute()) {
    echo '<script>alert("แก้ไขเรียบร้อยแล้ว");window.location="editestate.php";</script>';
} else {
    echo "Error: " . $stmt->error;
    echo '<script>alert("พบข้อผิดพลาด");window.location="fr_estate.php";</script>';
}

$stmt->close();
mysqli_close($objCon);
?>
