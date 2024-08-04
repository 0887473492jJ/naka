    <!-- หน้าข้อมูลส่วนตัวนายหน้า -->
<?php
session_start(); // เริ่มต้นเซสชั่น
require("function.php");
$objCon = connectDB();

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['user_login'])) {
    // หากไม่มีการล็อกอิน ให้เปลี่ยนเส้นทางไปที่หน้าเข้าสู่ระบบ
    header("Location: login.php");
    exit();
}
// ข้อมูลผู้ใช้ที่ล็อกอิน
$user = $_SESSION['user_login'];
$fullname = $user['fullname'];
$level = $user['id']; // หากใช้เป็นชื่อระดับของผู้ใช้ควรตรวจสอบโครงสร้างนี้

// ตรวจสอบว่ามีการส่งฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ตรวจสอบสิทธิ์ในการแก้ไขข้อมูล
    if ($_POST['u_id'] !== $user['id']) {
        // หากไม่ใช่ข้อมูลของผู้ใช้ที่ล็อกอิน ไม่อนุญาตให้แก้ไข
        echo '<script>alert("คุณไม่มีสิทธิ์แก้ไขข้อมูลนี้"); window.location.href="editformuser.php";</script>';
        exit();
    }
    $u_id = mysqli_real_escape_string($objCon, $_POST['u_id']);
    $u_fullname = mysqli_real_escape_string($objCon, $_POST['u_fullname']);
    $u_username = mysqli_real_escape_string($objCon, $_POST['u_username']);
    $u_address = mysqli_real_escape_string($objCon, $_POST['u_address']);
    $u_phone = mysqli_real_escape_string($objCon, $_POST['u_phone']);
    $u_leval = mysqli_real_escape_string($objCon, $_POST['u_level']);
    // ตรวจสอบว่า $u_id ถูกต้องและไม่มีการโจมตี SQL Injection
    $sql = "UPDATE user SET u_fullname='$u_fullname', u_username='$u_username', u_password='$u_password', u_address='$u_address', u_phone='$u_phone', u_leval='$u_leval' WHERE u_id='$u_id'";
    if (mysqli_query($objCon, $sql)) {
        echo '<script>alert("แก้ไขข้อมูลสำเร็จ"); window.location.href="ed_formuser.php";</script>';
    } else {
        echo '<script>alert("เกิดข้อผิดพลาด: ' . mysqli_error($objCon) . '"); window.location.href="editformuser.php";</script>';
    }
}
// SQL เพื่อดึงข้อมูลของผู้ใช้ที่ล็อกอินอยู่
$sql = "SELECT * FROM user WHERE u_id = '{$user['id']}'";
$result = mysqli_query($objCon, $sql);

// ตรวจสอบว่าการดึงข้อมูลสำเร็จ
if (!$result) {
    die('เกิดข้อผิดพลาดในการดึงข้อมูล: ' . mysqli_error($objCon));
}
$count = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลส่วนตัว</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        h2 {
            margin-top: 20px;
            text-align: center;
        }
        .container {
            margin-top: -600px; /* ปรับลด margin-top ของ container */
        }
        .table {
            margin-top: 20px;
        }
        .btn-custom {
            margin-bottom: 20px;
        }
        .readonly {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    <!-- logobar -->
    <?php include 'logobar.php'?>
    <!-- Sidebar -->
    <?php include 'managerbar.html'; ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="container">
                <h2>จัดการข้อมูลส่วนตัว</h2>
                <hr>
                <?php if ($count > 0) { ?>
                    <div class="row">
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">รหัสสมาชิก: <?php echo htmlspecialchars($row["u_id"]); ?></h6>
                                        <form action="editformuser.php" method="POST" class="form-horizontal">
                                            <input type="hidden" value="<?php echo $row["u_id"]; ?>" name="u_id">
                                            <div class="form-group mb-2">
                                                <label for="u_fullname_<?php echo $row["u_id"]; ?>" class="form-label">ชื่อ-นามสกุล:</label>
                                                <input type="text" name="u_fullname" id="u_fullname_<?php echo $row["u_id"]; ?>" class="form-control readonly" value="<?php echo htmlspecialchars($row["u_fullname"]); ?>" readonly>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="u_username_<?php echo $row["u_id"]; ?>" class="form-label">ชื่อผู้ใช้:</label>
                                                <input type="text" name="u_username" id="u_username_<?php echo $row["u_id"]; ?>" class="form-control readonly" value="<?php echo htmlspecialchars($row["u_username"]); ?>" readonly>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="u_address_<?php echo $row["u_id"]; ?>" class="form-label">ที่อยู่:</label>
                                                <input type="text" name="u_address" id="u_address_<?php echo $row["u_id"]; ?>" class="form-control readonly" value="<?php echo htmlspecialchars($row["u_address"]); ?>" readonly>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="u_phone_<?php echo $row["u_id"]; ?>" class="form-label">เบอร์โทร:</label>
                                                <input type="text" name="u_phone" id="u_phone_<?php echo $row["u_id"]; ?>" class="form-control readonly" value="<?php echo htmlspecialchars($row["u_phone"]); ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <button type="button" class="btn btn-warning btn-custom edit-button" data-id="<?php echo $row["u_id"]; ?>">แก้ไขข้อมูล</button>
                                                <input type="submit" value="บันทึก" class="btn btn-primary btn-custom save-button" data-id="<?php echo $row["u_id"]; ?>" style="display: none;">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-warning">
                        ไม่มีข้อมูลผู้ใช้!
                    </div>
                <?php } ?>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.edit-button').forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                var fields = document.querySelectorAll('#u_fullname_' + id + ', #u_username_' + id + ', #u_password_' + id + ', #u_address_' + id + ', #u_phone_' + id);
                fields.forEach(function(field) {
                    field.removeAttribute('readonly');
                    field.classList.remove('readonly');
                });
                document.querySelector('.save-button[data-id="' + id + '"]').style.display = 'inline-block';
                this.style.display = 'none';
            });
        });
    </script>
</body>
</html>
