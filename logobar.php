<?php
// ตรวจสอบการเข้าสู่ระบบ
$isLoggedIn = isset($_SESSION['user_login']);
$fullname = $isLoggedIn ? $_SESSION['user_login']['fullname'] : '';
$level = $isLoggedIn ? $_SESSION['user_login']['level'] : '';
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naka Living</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .fixed-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000; /* Ensure it appears above other content */
            background-color: #fff; /* Background color to ensure readability */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional: add shadow for better separation */
        }

        body {
            margin-top: 60px; /* Adjust this value based on the height of your header */
        }

        .logo {
            height: 40px;
            margin-right: 10px;
        }

        .btn-black {
            color: #fff; /* White text color */
            background-color: #000; /* Black background color */
            border-color: #000; /* Black border color */
        }

        .btn-black:hover {
            background-color: #333; /* Darker black on hover */
            border-color: #333; /* Darker black border on hover */
        }

        .btn-logout {
            color: #fff; /* White text color */
            background-color: #dc3545; /* Red background color */
            border-color: #dc3545; /* Red border color */
        }

        .btn-logout i {
            margin-right: 5px; /* Space between icon and text */
        }

        .btn-logout:hover {
            background-color: #c82333; /* Darker red on hover */
            border-color: #bd2130; /* Darker red border on hover */
        }

        .user-icon {
            margin-right: 5px; /* Space between icon and text */
        }
    </style>
    <!-- Include Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<header class="fixed-header d-flex justify-content-between align-items-center p-3 border-bottom">
    <div class="d-flex align-items-center">
        <img src="https://scontent.fkkc3-1.fna.fbcdn.net/v/t39.30808-6/308853979_519930673470775_2724454371434987371_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=3jTT1aVIPgMQ7kNvgE8gbvk&_nc_ht=scontent.fkkc3-1.fna&oh=00_AYA85MSHfhd9qaf9xigEv_3LxWt31FakSSvMJ4qZ-jmzAg&oe=66A6C731" height="40" alt="Logo" style="margin-right: 10px;">
        <a href="index.php" class="btn btn-link">Naka Living</a>
        <a href="estate.php" class="btn btn-link">อสังหาริมทรัพย์</a>
    </div>
    <div>
        <?php if ($isLoggedIn): ?>
            <!-- หากผู้ใช้ล็อกอิน -->
            <a href="<?php 
                // ตรวจสอบระดับ (level) และกำหนดเส้นทาง
                switch ($level) {
                    case 'admin':
                        echo 'admin.php'; // ลิงก์สำหรับผู้ดูแลระบบ
                        break;
                    case 'manager':
                        echo 'manager.php'; // ลิงก์สำหรับผู้จัดการ
                        break;
                    case 'user':
                        echo 'user.php'; // ลิงก์สำหรับผู้ใช้ทั่วไป
                        break;
                }
            ?>" class="btn btn-outline-secondary">
                <?php echo htmlspecialchars($fullname); // แสดงชื่อเต็มของผู้ใช้ ?>
            </a>
            <a href="logout_action.php" class="btn btn-danger">
                <i class="fas fa-sign-out-alt"></i> ออกจากระบบ
            </a>
        <?php else: ?>
            <a href="login.php" class="btn btn-primary">เข้าสู่ระบบ</a>
            <a href="register.php" class="btn btn-black">สมัครสมาชิก</a>
        <?php endif; ?>
    </div>
</header>

<!-- Include Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
