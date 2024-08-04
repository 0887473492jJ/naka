<!-- บันทึกข้อมูลบริษัท -->
<?php
include 'function.php';
$objCon = connectDB();

if (isset($_POST['c_id']) &&isset($_POST['c_name']) && isset($_POST['c_details']) &&isset($_POST['c_detail']) && isset($_POST['c_phone']) && isset($_POST['c_email']) && isset($_POST['c_facebook'])) {
    $c_id = mysqli_real_escape_string($objCon, $_POST['c_id']);
    $c_name = mysqli_real_escape_string($objCon, $_POST['c_name']);
    $c_details = mysqli_real_escape_string($objCon, $_POST['c_details']);
    $c_phone = mysqli_real_escape_string($objCon, $_POST['c_phone']);
    $c_email = mysqli_real_escape_string($objCon, $_POST['c_email']);
    $c_facebook = mysqli_real_escape_string($objCon, $_POST['c_facebook']);

    // บันทึกข้อมูล
    $sql = "UPDATE company SET c_name='$c_name', c_details='$c_details', c_phone='$c_phone', c_email='$c_email', c_facebook='$c_facebook' WHERE c_id='$c_id'";
    $result = mysqli_query($objCon, $sql);

    if ($result) {
        echo '<script>alert("บันทึกข้อมูลเรียบร้อยแล้ว"); window.location.href="editcompany.php";</script>';
    } else {
        echo '<script>alert("บันทึกข้อมูลไม่สำเร็จ: ' . mysqli_error($objCon) . '"); window.location.href="editcompany.php";</script>';
    }
} else {
    echo '<script>alert("ไม่พบข้อมูลที่ต้องการแก้ไข"); window.location.href="editcompany.php";</script>';
}
?>