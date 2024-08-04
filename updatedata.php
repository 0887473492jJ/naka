    <!-- หน้าบันทึกข้อมูลประเภท -->
<?php
require("function.php");
$objCon = connectDB();
if (isset($_POST['t_id']) && isset($_POST['t_name'])) {
    $t_id = mysqli_real_escape_string($objCon, $_POST['t_id']);
    $t_name = mysqli_real_escape_string($objCon, $_POST['t_name']);

    // บันทึกข้อมูล
    $sql = "UPDATE typeestate SET t_name='$t_name' WHERE t_id='$t_id'";
    $result = mysqli_query($objCon, $sql);

    if ($result) {
        echo '<script>alert("บันทึกข้อมูลเรียบร้อยแล้ว"); window.location.href="type.php";</script>';
    } else {
        echo '<script>alert("บันทึกข้อมูลไม่สำเร็จ: ' . mysqli_error($objCon) . '"); window.location.href="type.php";</script>';
    }
} else {
    echo '<script>alert("ไม่พบข้อมูลที่ต้องการแก้ไข"); window.location.href="index.php";</script>';
}
?>