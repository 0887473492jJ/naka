<!-- หน้าลบข้อมูลประเภท -->
 
<?php
include_once("./function.php");
$objCon = connectDB(); // เชื่อมต่อฐานข้อมูล

$t_id=$_GET["t_id"];


$sql = "DELETE FROM typeestate WHERE t_id=$t_id";

$result=mysqli_query($objCon,$sql);

if ($result) {
    echo '<script>
            alert("ลบข้อมูลเรียบร้อยแล้ว");
            window.location.href = "type.php";
          </script>'; // เรียกใช้ popup และเปลี่ยนเส้นทางไปที่หน้า index.php เมื่อบันทึกข้อมูลสำเร็จ
} else {
    echo '<script>
            alert("ลบข้อมูลไม่สำเร็จ: ' . mysqli_error($connect) . '");
            window.location.href = "type.php";
          </script>'; // เรียกใช้ popup และเปลี่ยนเส้นทางไปที่หน้า index.php เมื่อบันทึกข้อมูลไม่สำเร็จ พร้อมแสดงข้อความผิดพลาด
}
?>