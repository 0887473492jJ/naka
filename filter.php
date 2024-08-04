    <!-- หน้าจัดการตัวกรองผู้ใช้งานระบบ -->
<?php
session_start();
include 'function.php';
$objCon = connectDB();

// ตรวจสอบว่ามีการส่งค่า level มาหรือไม่
$level = isset($_GET['level']) ? $_GET['level'] : '';

// สร้างคำสั่ง SQL ตาม level ที่เลือก
$sql = "SELECT * FROM user";
if (!empty($level)) {
    $sql .= " WHERE u_level = '" . mysqli_real_escape_string($objCon, $level) . "'";
}

// ดำเนินการ query และแสดงข้อมูล
$result = mysqli_query($objCon, $sql);
if ($result) {
    echo "<table class='table table-bordered'>";
    echo "<thead><tr>
        <th>ไอดี</th>
        <th>ชื่อผู้ใช้</th>
        <th>รหัสผ่าน</th>
        <th>ชื่อ - นามสกุล</th>
        <th>ที่อยู่</th>
        <th>เบอร์โทร</th>
        <th>ระดับ</th>
        <th>แก้ไข</th>
        <th>ลบ</th>
    </tr></thead><tbody>";

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>
            <td>{$row['u_id']}</td>
            <td>{$row['u_username']}</td>
            <td>{$row['u_password']}</td>
            <td>{$row['u_fullname']}</td>
            <td>{$row['u_address']}</td>
            <td>{$row['u_phone']}</td>
            <td>{$row['u_level']}</td>
            <td><a href='ed_user.php?id={$row['u_id']}' class='btn btn-warning'>แก้ไข</a></td>
            <td><a href='delete_user.php?id={$row['u_id']}' class='btn btn-danger' onclick='Del(this.href);return false;'>ลบ</a></td>
        </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "ไม่พบข้อมูล";
}
mysqli_close($objCon);
?>
<script language="JavaScript">
 function Del(mypage){
    var agree=confirm("คุณต้องการจะลบข้อมูลหรือไม่");
    if(agree){
        window.location=mypage;
    }
 }
</script>
