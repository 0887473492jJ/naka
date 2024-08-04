<?php
include 'function.php';
$objCon = connectDB();

$id = $_GET['id']; // ใช้ 'id' แทน 'u_id'

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($objCon->connect_error) {
    die("Connection failed: " . $objCon->connect_error);
}

// ใช้ Prepared Statements เพื่อป้องกัน SQL Injection
$sql = "SELECT * FROM user WHERE u_id = ?";
$stmt = $objCon->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die('Error: No data found with this user ID.');
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
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
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-image" style="background-image: url('https://scontent.fkkc3-1.fna.fbcdn.net/v/t39.30808-6/449708260_999008082229696_4561447367963882751_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=833d8c&_nc_ohc=3D8RdLA2vjoQ7kNvgGpT_eC&_nc_ht=scontent.fkkc3-1.fna&oh=00_AYCpYcbv1qRc_16qvHiz5RGf2nJTjjIDfHfy4I2hnpSVgg&oe=66A6CC4C');"></div>
        <div class="register-form-container">
            <form class="form-register" method="post" action="update_user.php">
                <h1 class="h3 mb-3 font-weight-normal">แก้ไขข้อมูลผู้ใช้</h1>
                <div class="form-group">
                    <label for="u_id" class="form-label">ไอดี:</label>
                    <input type="text" class="form-control" id="u_id" name="u_id" placeholder="ไอดี" readonly value="<?=$row['u_id'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="u_fullname" class="form-label">ชื่อ - นามสกุล:</label>
                    <input type="text" class="form-control" id="u_fullname" name="u_fullname" placeholder="ชื่อ - นามสกุล" value="<?=$row['u_fullname'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="u_address" class="form-label">ที่อยู่:</label>
                    <input type="text" class="form-control" id="u_address" name="u_address" placeholder="ที่อยู่" value="<?= $row['u_address'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="u_phone" class="form-label">เบอร์โทร:</label>
                    <input type="text" class="form-control" id="u_phone" name="u_phone" placeholder="เบอร์โทร" value="<?= $row['u_phone'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="u_username" class="form-label">ชื่อผู้ใช้:</label>
                    <input type="text" class="form-control" id="u_username" name="u_username" placeholder="ชื่อผู้ใช้" value="<?= $row['u_username'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="u_password" class="form-label">รหัสผ่าน:</label>
                    <input type="password" class="form-control" id="u_password" name="u_password" placeholder="รหัสผ่าน" value="<?= $row['u_password'] ?>"required>
                </div>
                <button class="btn btn-primary btn-lg btn-block" name="update" type="submit">แก้ไข</button>
                <a href="edituser.php" class="btn btn-danger btn-lg btn-block">ยกเลิก</a>
            </form>
        </div>  
    </div>
</body>
</html>
