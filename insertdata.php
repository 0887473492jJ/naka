    <!-- หน้าเพิ่มข้อมูลประเภท -->

<!-- หน้าส่งข้อมูลไปยังdata bass -->
<?php
//เชื่อมฐานข้อมูล
include_once("./function.php");
$objCon = connectDB(); // เชื่อมต่อฐานข้อมูล // เชื่อมฐานข้อมูล  import ฐานข้อมูลจากไฟล์ function.php

// if($connect){
//     echo "เชื่อมต่อสำเร็จ";
// } 

 //รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
$t_name= $_POST["t_name"];



//บันทึกข้อมูล
$sql = "INSERT INTO typeestate(t_name) VALUES ('$t_name')";   // คำสั่ง  INSERT"เพิ่มฐานข้อมูล"   UPDATE"แก้ไขข้อมูล"  DELET"ลบ"  ****ตามด้วย INTO "ชื่อตาราง(ชื่อคอล์ม)"

$result = mysqli_query($objCon,$sql); //สั่งคำสั่ง  sql

if ($result) {
    echo '<script>
            alert("บันทึกข้อมูลเรียบร้อยแล้ว");
            window.location.href = "type.php";
          </script>'; // เรียกใช้ popup และเปลี่ยนเส้นทางไปที่หน้า index.php เมื่อบันทึกข้อมูลสำเร็จ
} else {
    echo '<script>
            alert("บันทึกข้อมูลไม่สำเร็จ: ' . mysqli_error($connect) . '");
            window.location.href = "type.php";
          </script>'; // เรียกใช้ popup และเปลี่ยนเส้นทางไปที่หน้า index.php เมื่อบันทึกข้อมูลไม่สำเร็จ พร้อมแสดงข้อความผิดพลาด
}

?>