<!-- แบบฟอร์มบันทึกประเภท -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บันทึกข้อมูลประเภท</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .btn-custom {
            margin-right: 10px;
        }
        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>แบบฟอร์มบันทึกข้อมูล</h2>
        <form action="insertdata.php" method="POST" class="form-horizontal"> <!-- ส่งค่าไปไฟล์ insertData.php -->
            <div class="form-group">
                <label for="t_name" class="form-label">ชื่อประเภท</label>
                <input type="text" name="t_name" id="t_name" class="form-control">   
            </div>

            <!-- <div class="form-group">
                <label for="gender">เพศ</label>
                <input type="radio" name="gender" value="male"> ชาย       ประเภท  type="radio" เลือกได้1ตัวเลือกเท่านั้น 
                <input type="radio" name="gender" value="female"> หญิง   
                <input type="radio" name="gender" value="other"> อื่นๆ  
            </div> -->

            <!-- <div class="form-group">
                <label for="skill">ทักษะ ความสามารถ</label>
                <input type="checkbox" name="skill[]" id="skill" value="Java"> Java
                <input type="checkbox" name="skill[]" id="skill" value="Php"> Php            ประเภท  type="checkbox" เลือกได้หลายตัวเลือก 
                <input type="checkbox" name="skill[]" id="skill" value="Python"> Python
                <input type="checkbox" name="skill[]" id="skill" value="HTML"> HTML
            </div> -->

            <div class="form-group">
                <input type="submit" value="บันทึกข้อมูล" class="btn btn-primary btn-custom">

            </div>
        </form>

        <a href="type.php" class="btn btn-link back-link">ย้อนกลับ</a>
    </div>

    <!-- Include Bootstrap JS (Optional for Bootstrap components functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
