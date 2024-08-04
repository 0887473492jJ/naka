<!-- ฟอร์มแก้ไขประเภท -->
<?php
include_once("./function.php");
$objCon = connectDB(); // เชื่อมต่อฐานข้อมูล
$t_id=$_GET["t_id"];
$sql="SELECT * FROM typeestate WHERE t_id = $t_id";
$result=mysqli_query($objCon,$sql);

$row=mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลประเภท</title>
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
        <h2>แบบฟอร์มแก้ไขข้อมูลประเภท</h2>
        <form action="updatedata.php" method="POST" class="form-horizontal"> <!-- ส่งค่าไปไฟล์ updatadata.php -->
            <input type="hidden" value="<?php echo $row["t_id"]; ?>" name="t_id">
            <div class="form-group">
                <label for="t_name" class="form-label">ชื่อประเภท</label>
                <input type="text" name="t_name" id="t_name" class="form-control" value="<?php echo $row["t_name"]; ?>">   
            </div>
            <div class="form-group">
                <input type="submit" value="แก้ไขข้อมูล" class="btn btn-primary btn-custom">
                <a href="deletetypeestate.php?t_id=<?php echo $row["t_id"]; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่')">ลบ</a>
            </div>
        </form>
        <a href="type.php" class="btn btn-link back-link">ย้อนกลับ</a>
    </div>

    <!-- Include Bootstrap JS (Optional for Bootstrap components functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
