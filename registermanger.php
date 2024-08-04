    <!-- หน้าฟอร์มเพิ่มนายหน้า -->
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
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }
        .register-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }.form-group {
            margin-bottom: 15px;
        }
        .form-control {
            font-size: 0.9em;
            padding: 5px 10px;
        }
        .logout-button {
            color: white;
            background-color: red;
            border: none;
            padding: 10px 20px;
            position: absolute;
            top: 10px;
            right: 10px;
        }  .button-group {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="register-container">
       <div class="register-form-container">
            <form class="form-register" method="post" action="insert_user.php">
                <h1 class="h3 mb-3 font-weight-normal">เพิ่มนายหน้า</h1>
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
                <div class="button-group">
                <input type="hidden" id="u_level" name="u_level" value="manager">
                <button class="btn btn-success" name="signup" type="submit">เพิ่มข้อมูล</button>
                <a href="edituser.php" class="btn btn-danger">ยกเลิก</a>
                </div>
    </div>    
</body>
</html>