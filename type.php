    <!-- หน้าจัดการข้อมูลประเภท  -->
<?php
session_start(); // เริ่มต้นเซสชัน
include 'function.php';
$objCon = connectDB();
// SQL เพื่อดึงข้อมูลทั้งหมดจากตาราง typeestate
$sql = "SELECT * FROM typeestate";
$result = mysqli_query($objCon, $sql);
$count = mysqli_num_rows($result); //นับข้อมูลในตารางว่ามีกี่เลคอร์ด

$user = $_SESSION['user_login'];
$userName = $user['fullname']; // ดึงชื่อผู้ใช้จากเซสชัน
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลประเภท</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        {
            margin-top: 20px;
            text-align: center;
        }
        .container {
            margin-top: -700px; /* ปรับลด margin-top ของ container */
        }
        .table {
            margin-top: 0px;
        }
        .btn-custom {
            margin-bottom: 20px;
        }
        main {
            padding-top: 10px; /* เพิ่ม padding-top ให้กับ main */
        }
    </style>
</head>
<body>
    <?php include 'logobar.php'; ?>
    <!-- Sidebar -->
    <?php include 'adminbar.html'; ?>
    <!-- Main content -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="container">
            <h2>จัดการข้อมูลประเภท</h2>
            <hr>
            <a href="insertformtype.php" class="btn btn-primary btn-custom">เพิ่มข้อมูลประเภท</a> <!--ลิงค์หน้ากรอกฟอร์ม -->
            <?php if ($count > 0) { ?>
                <div class="alert alert-info">
                    <?php echo "จำนวนประเภท " . $count . " ประเภท"; //แสดงจำนวนประเภท ?>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-primary">
                            <th>รหัสประเภท</th>
                            <th>ชื่อประเภท</th>
                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row["t_id"]); ?></td>
                                <td><?php echo htmlspecialchars($row["t_name"]); ?></td>
                                <td>
                                    <a href="editformtype.php?t_id=<?php echo urlencode($row["t_id"]); ?>" class="btn btn-warning">แก้ไข</a>
                                </td>
                                <td>
                                    <a href="deletetypeestate.php?t_id=<?php echo urlencode($row["t_id"]); ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่')">ลบ</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <div class="alert alert-warning">
                    ไม่มีข้อมูลประเภท !!!!
                </div>
            <?php } ?>
        </div>
    </main>
    <!-- Include Bootstrap JS (Optional for Bootstrap components functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>