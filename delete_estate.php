<?php
include 'function.php';
$objCon = connectDB();

// ตรวจสอบว่ามีค่า 'id' หรือไม่
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('Error: No estate ID provided.');
}

$ids = intval($_GET['id']); // Convert to integer to ensure it's a number

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($objCon->connect_error) {
    die("Connection failed: " . $objCon->connect_error);
}

// Start a transaction
$objCon->begin_transaction();

try {
    // ลบข้อมูลจาก estate_images ก่อน
    $sql_delete_images = "DELETE FROM estate_images WHERE e_id = ?";
    $stmt_delete_images = $objCon->prepare($sql_delete_images);
    if (!$stmt_delete_images) {
        throw new Exception("Prepare failed: " . $objCon->error);
    }
    $stmt_delete_images->bind_param("i", $ids);
    if (!$stmt_delete_images->execute()) {
        throw new Exception("Error: " . $stmt_delete_images->error);
    }
    $stmt_delete_images->close();

    // ลบข้อมูลจาก estate
    $sql_delete_estate = "DELETE FROM estate WHERE e_id = ?";
    $stmt_delete_estate = $objCon->prepare($sql_delete_estate);
    if (!$stmt_delete_estate) {
        throw new Exception("Prepare failed: " . $objCon->error);
    }
    $stmt_delete_estate->bind_param("i", $ids);
    if (!$stmt_delete_estate->execute()) {
        throw new Exception("Error: " . $stmt_delete_estate->error);
    }
    $stmt_delete_estate->close();

    // Commit the transaction
    $objCon->commit();
    echo '<script>alert("ลบข้อมูลเรียบร้อย");window.location="editestate.php";</script>';
} catch (Exception $e) {
    // Rollback the transaction if an error occurs
    $objCon->rollback();
    echo "Error: " . $e->getMessage() . "<br>";
    echo '<script>alert("ไม่สามารถลบข้อมูลได้");window.location="editestate.php";</script>';
}

mysqli_close($objCon);
?>
