    <!-- หน้าลบข้อมูลผู้ใช้งานทั้งหมด -->

    <?php
    include 'function.php';
    $objCon = connectDB();

    // ตรวจสอบว่ามีค่า 'id' หรือไม่
    if (!isset($_GET['id'])) {
        die('Error: No user ID provided.');
    }

    $ids = $_GET['id'];
    // ตรวจสอบการเชื่อมต่อฐานข้อมูล
    if ($objCon->connect_error) {
        die("Connection failed: " . $objCon->connect_error);
    }

    // ตรวจสอบว่ามีข้อมูลในฐานข้อมูลหรือไม่
    $sql_check = "SELECT * FROM user WHERE u_id = ?";
    $stmt_check = $objCon->prepare($sql_check);
    $stmt_check->bind_param("i", $ids);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows === 0) {
        die('Error: No data found with this user ID.');
    }
    $stmt_check->close();
    // ลบข้อมูล
    $sql = "DELETE FROM user WHERE u_id = ?";
    $stmt = $objCon->prepare($sql);
    $stmt->bind_param("i", $ids);

    if ($stmt->execute()) {
        echo '<script>alert("ลบข้อมูลเรียบร้อย");window.location="edituser.php";</script>';
    } else {
        echo "Error: " . $stmt->error . "<br>";
        echo '<script>alert("ไม่สามารถลบข้อมูลได้");window.location="edituser.php";</script>';
    }
    $stmt->close();
    mysqli_close($objCon);
    ?>
