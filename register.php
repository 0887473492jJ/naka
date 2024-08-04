<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Naka Living</title>
    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
        .register-container {
            display: flex;
            height: 100vh;
        }

        .register-image {
            width: 50%;
            background-size: cover;
            background-position: center;
        }

        .register-form-container {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-register {
            width: 100%;
            max-width: 400px;
            padding: 15px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .logo {
            width: 64px; /* ลดลง 20% จาก 80px */
            margin-bottom: 20px;
            border-radius: 50%;
        }

        .form-control {
            margin-bottom: 15px;
            font-size: 0.9rem;
        }

        .btn-primary {
            background-color: #28a745;
            border: none;
            font-size: 0.9rem;
            padding: 5px 15px;
        }

        .form-label {
            float: left;
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .login-container {
            display: flex;
            height: 100vh;
        }

        .login-image {
            width: 50%;
            background-size: cover;
            background-position: center;
        }

        .login-form-container {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            text-align: center;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }

        .btn-login {
            background-color: transparent;
            border: none;
            color: black;
        }
    </style>
</head>
<body>
<header class="d-flex justify-content-between align-items-center p-3 border-bottom">
        <div class="d-flex align-items-center">
        <img src="https://scontent.fkkc3-1.fna.fbcdn.net/v/t39.30808-6/308853979_519930673470775_2724454371434987371_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=3jTT1aVIPgMQ7kNvgE8gbvk&_nc_ht=scontent.fkkc3-1.fna&oh=00_AYA85MSHfhd9qaf9xigEv_3LxWt31FakSSvMJ4qZ-jmzAg&oe=66A6C731" height="40" style="margin-right: 10px;">
            <a href="index.php" class="btn">Naka Living</a>
            <a href="estate.php" class="btn ">อสังหาริมทรัพย์</a>
        </div>
    </header>
    </header>
    <div class="register-container">
        <div class="register-image" style="background-image: url('https://scontent.fkkc3-1.fna.fbcdn.net/v/t39.30808-6/449708260_999008082229696_4561447367963882751_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=833d8c&_nc_ohc=3D8RdLA2vjoQ7kNvgGpT_eC&_nc_ht=scontent.fkkc3-1.fna&oh=00_AYCpYcbv1qRc_16qvHiz5RGf2nJTjjIDfHfy4I2hnpSVgg&oe=66A6CC4C');"></div>
        <div class="register-form-container">
            <form class="form-register" method="post" action="register_action.php">
                <img src="https://scontent.fkkc3-1.fna.fbcdn.net/v/t39.30808-6/308853979_519930673470775_2724454371434987371_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeE7kjDvAGdomOC-pnqIE_H__v4Ldi8XE-P-_gt2LxcT4zjJtuD2SvZLg1cGxb5Y4Hk-iI84MG2bgMX4S7R78HnC&_nc_ohc=qqdmIVbyFicQ7kNvgHR6vn4&_nc_ht=scontent.fkkc3-1.fna&oh=00_AYBivtyBSSW2PVDBTDJgkjyedqRHz-0kdiJCWLl-6qz7Nw&oe=66AA8371" alt="Logo" class="logo">
                <h1 class="h3 mb-3 font-weight-normal">สมัครสมาชิก</h1>
                <div class="form-group">
                    <label for="u_fullname" class="form-label">ชื่อ - นามสกุล:</label>
                    <input type="text" class="form-control" id="u_fullname" name="u_fullname" placeholder="ชื่อ - นามสกุล" required>
                </div>
                <div class="form-group">
                    <label for="u_address" class="form-label">ที่อยู่:</label>
                    <input type="text" class="form-control" id="u_address" name="u_address" placeholder="ที่อยู่" required>
                </div>
                <div class="form-group">
                    <label for="u_phone" class="form-label">เบอร์โทร:</label>
                    <input type="text" class="form-control" id="u_phone" name="u_phone" placeholder="เบอร์โทร" required>
                </div>
                <div class="form-group">
                    <label for="u_username" class="form-label">ชื่อผู้ใช้:</label>
                    <input type="text" class="form-control" id="u_username" name="u_username" placeholder="ชื่อผู้ใช้" required>
                </div>
                <div class="form-group">
                    <label for="u_password" class="form-label">รหัสผ่าน:</label>
                    <input type="password" class="form-control" id="u_password" name="u_password" placeholder="รหัสผ่าน" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password" class="form-label">ยืนยันรหัสผ่าน:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="ยืนยันรหัสผ่าน" required>
                </div>
                <input type="hidden" id="u_level" name="u_level" value="user">
                <button class="btn btn-primary btn-lg btn-block" name="signup" type="submit">สมัครสมาชิก</button>
                <p class="mt-3">เป็นสมาชิกแล้วใช่หรือไม่ <a href="login.php">เข้าสู่ระบบ</a></p>
            </form>
        </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>