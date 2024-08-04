<?php
session_start();
include 'function.php';
$objCon = connectDB();

// ตรวจสอบว่ามีการส่งค่า level มาหรือไม่
$level = isset($_GET['level']) ? $_GET['level'] : '';

// สร้างคำสั่ง SQL ตาม level ที่เลือก
$sql = "SELECT * FROM user";
if (!empty($level) && $level !== 'all') {
    $sql .= " WHERE u_level = '" . mysqli_real_escape_string($objCon, $level) . "'";
}

// ดำเนินการ query และเก็บผลลัพธ์
$result = mysqli_query($objCon, $sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naka Living</title>
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/style.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .logout-button {
            color: white;
            background-color: red;
            border: none;
            padding: 10px 20px;
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .container {
            margin-top: -700px; /* ปรับลด margin-top ของ container */
        }
    </style>
    <script>
        function filterResults() {
            // Get the form element
            var form = document.getElementById('filterForm');
            // Submit the form
            form.submit();
        }
    </script>
</head>
<body> 
<?php include 'logobar.php'; ?>
    <!-- Sidebar -->
    <?php include 'adminbar.html'; ?>
    <!-- Main content -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
    <div><h3>แสดงข้อมูลผู้ใช้</div>
    <a href="registermanger.php" class="btn btn-success">เพิ่มผู้ใช้</a>

    <!-- Form for filtering -->
    <form id="filterForm" action="" method="get" class="form-inline mb-3">
    <div class="form-group">
        <label for="level" class="mr-2">เลือกประเภท:</label>
        <input type="radio" id="all" name="level" value="all" <?= $level == 'all' ? 'checked' : '' ?> onchange="filterResults()">
        <label for="all" class="mr-3">ผู้ใช้ทั้งหมด</label>
        <input type="radio" id="user" name="level" value="user" <?= $level == 'user' ? 'checked' : '' ?> onchange="filterResults()">
        <label for="user" class="mr-3">ผู้ใช้งานระบบ</label>
        <input type="radio" id="manager" name="level" value="manager" <?= $level == 'manager' ? 'checked' : '' ?> onchange="filterResults()">
        <label for="manager" class="mr-3">นายหน้า</label>
    </div>
</form>
    <!-- Table to display user data -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>รหัส</th>
                <th>ชื่อผู้ใช้</th>
                <th>ชื่อ - นามสกุล</th>
                <th>ที่อยู่</th>
                <th>เบอร์โทร</th>
                <th>สิทธิ์การใช้งาน</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result) {
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>
                    <td>{$row['u_id']}</td>
                    <td>{$row['u_username']}</td>
                    <td>{$row['u_fullname']}</td>
                    <td>{$row['u_address']}</td>
                    <td>{$row['u_phone']}</td>
                    <td>{$row['u_level']}</td>
                    <td><a href='ed_user.php?id={$row['u_id']}' class='btn btn-warning'>แก้ไข</a></td>
                    <td><a href='delete_user.php?id={$row['u_id']}' class='btn btn-danger' onclick='return confirmDeletion(this.href);'>ลบ</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>ไม่พบข้อมูล</td></tr>";
        }
        ?>
        </tbody>
    </table>
    <!-- JavaScript for confirmation dialog -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script language="JavaScript">
        function confirmDeletion(url) {
            return confirm("คุณต้องการจะลบข้อมูลหรือไม่");
        }
    </script>
    </main>
</body>
</html>

<?php
mysqli_close($objCon);
?> 
