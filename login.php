<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naka Living</title>
    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https:/" rel="stylesheet">
    <!-- Custom styles -->
    <style>
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

        .logo {
            width: 100px;
            margin-bottom: 20px;
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
    <div class="login-container">
        <div class="login-image" style="background-image: url('https://scontent.fkkc3-1.fna.fbcdn.net/v/t39.30808-6/449708260_999008082229696_4561447367963882751_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=833d8c&_nc_ohc=3D8RdLA2vjoQ7kNvgGpT_eC&_nc_ht=scontent.fkkc3-1.fna&oh=00_AYCpYcbv1qRc_16qvHiz5RGf2nJTjjIDfHfy4I2hnpSVgg&oe=66A6CC4C');">
        </div>
        <div class="login-form-container">
            <form class="form-signin" method="post" action="login_action.php">
                <img src="https://scontent.fkkc3-1.fna.fbcdn.net/v/t39.30808-6/308853979_519930673470775_2724454371434987371_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeE7kjDvAGdomOC-pnqIE_H__v4Ldi8XE-P-_gt2LxcT4zjJtuD2SvZLg1cGxb5Y4Hk-iI84MG2bgMX4S7R78HnC&_nc_ohc=qqdmIVbyFicQ7kNvgHR6vn4&_nc_ht=scontent.fkkc3-1.fna&oh=00_AYBivtyBSSW2PVDBTDJgkjyedqRHz-0kdiJCWLl-6qz7Nw&oe=66AA8371" alt="Logo" class="logo">
                <h1 class="h3 mb-3 font-weight-normal">เข้าสู่ระบบ</h1>
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" name="username" placeholder="ชื่อผู้ใช้" required>
                    <label for="floatingInput"></label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="รหัสผ่าน" required>
                    <label for="floatingPassword"></label>
                </div>
                <?php if (isset($_GET['error'])): ?>
                    <div class="error-message">username หรือ password ไม่ถูกต้อง!!</div>
                <?php endif; ?>
                <button class="btn btn-lg btn-success btn-block" type="submit">เข้าสู่ระบบ</button>
                <p class="mt-3">ยังไม่สมัครใช่ไหม <a href="register.php">สมัครสมาชิก</a></p>
            </form>
        </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>