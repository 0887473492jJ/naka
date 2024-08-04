<?php
include 'function.php';
$objCon = connectDB();

$id = isset($_GET['id']) ? $_GET['id'] : null;

// ตรวจสอบค่า 'id'
if ($id === null) {
    die('ข้อผิดพลาด: ไม่มีรหัสทรัพย์สิน (e_id) ถูกส่งมา.');
}

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($objCon->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $objCon->connect_error);
}

// ใช้ Prepared Statements เพื่อป้องกัน SQL Injection
$sql = "SELECT * FROM estate WHERE e_id = ?";
$stmt = $objCon->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die('ข้อผิดพลาด: ไม่มีข้อมูลสำหรับรหัสทรัพย์สินนี้.');
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Estate</title>
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
            width: 90%;
            max-width: 1360px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            font-size: 0.9em;
            padding: 5px 10px;
        }
        .button-group {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .form-label {
            display: block;
            margin-bottom: 5px;
        }
        #map {
            height: 400px;
            width: 100%;
        }
        .form-row {
            margin-bottom: 15px;
        }
        .form-col {
            flex: 1;
            margin-right: 10px;
        }
        .form-col:last-child {
            margin-right: 0;
        }
        .form-inline-group {
            display: flex;
            gap: 10px;
        }
        .form-inline-group .form-control {
            flex: 1;
        }
    </style>
</head>
<body>
<div class="register-container">
    <h1 class="h3 mb-3 font-weight-normal">แก้ไขอสังหาริมทรัพย์</h1>
    <form class="form-register" method="post" action="update_estate.php" enctype="multipart/form-data">
        <input type="hidden" name="e_id" value="<?php echo htmlspecialchars($row['e_id']); ?>">
        
        <div class="form-group">
            <label for="e_name" class="form-label">ชื่ออสังหาริมทรัพย์</label>
            <input type="text" class="form-control" id="e_name" name="e_name" placeholder="ชื่ออสังหาริมทรัพย์" value="<?php echo htmlspecialchars($row['e_name']); ?>" required>
        </div>
        
        <div class="form-inline-group">
            <div class="form-col">
                <label for="t_id" class="form-label">ชนิดอสังหาริมทรัพย์</label>
                <select class="form-control" id="t_id" name="t_id" required>
                    <option value="">เลือกชนิดอสังหาริมทรัพย์</option>
                    <?php
                    $typeSQL = "SELECT * FROM typeestate";
                    $typeQuery = mysqli_query($objCon, $typeSQL) or die(mysqli_error($objCon));
                    while ($typeRow = mysqli_fetch_assoc($typeQuery)) {
                        $selected = ($typeRow['t_id'] == $row['t_id']) ? 'selected' : '';
                        echo '<option value="' . $typeRow['t_id'] . '" ' . $selected . '>' . $typeRow['t_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-col">
                <label for="e_sales_type" class="form-label">ประเภทการขาย</label>
                <select class="form-control" id="e_sales_type" name="e_sales_type" required>
                    <option value="ขาย" <?php echo ($row['e_sales_type'] == 'ขาย') ? 'selected' : ''; ?>>ขาย</option>
                    <option value="เช่า" <?php echo ($row['e_sales_type'] == 'เช่า') ? 'selected' : ''; ?>>เช่า</option>
                </select>
            </div>
        </div>
        
        <div class="form-row d-flex">
            <div class="form-col">
                <label for="e_area" class="form-label">พื้นที่ (ตารางวา)</label>
                <input type="text" class="form-control" id="e_area" name="e_area" placeholder="พื้นที่ (ตารางวา)" value="<?php echo htmlspecialchars($row['e_area']); ?>" required>
            </div>
            <div class="form-col">
                <label for="e_price" class="form-label">ราคา</label>
                <input type="text" class="form-control" id="e_price" name="e_price" placeholder="ราคา" value="<?php echo htmlspecialchars($row['e_price']); ?>" required>
            </div>
        </div>
        
        <div class="form-row d-flex">
            <div class="form-col">
                <label for="e_subdistrict" class="form-label">ตำบล</label>
                <input type="text" class="form-control" id="e_subdistrict" name="e_subdistrict" placeholder="ตำบล" value="<?php echo htmlspecialchars($row['e_subdistrict']); ?>" required>
            </div>
            <div class="form-col">
                <label for="e_district" class="form-label">อำเภอ</label>
                <input type="text" class="form-control" id="e_district" name="e_district" placeholder="อำเภอ" value="<?php echo htmlspecialchars($row['e_district']); ?>" required>
            </div>
            <div class="form-col">
                <label for="e_province" class="form-label">จังหวัด</label>
                <input type="text" class="form-control" id="e_province" name="e_province" placeholder="จังหวัด" value="<?php echo htmlspecialchars($row['e_province']); ?>" required>
            </div>
        </div>
        
        <div class="form-group">
            <label for="e_details" class="form-label">คำอธิบาย</label>
            <input type="text" class="form-control" id="e_details" name="e_details" placeholder="คำอธิบาย" value="<?php echo htmlspecialchars($row['e_details']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="e_insurance" class="form-label">ประกัน</label>
            <input type="text" class="form-control" id="e_insurance" name="e_insurance" placeholder="ประกัน" value="<?php echo htmlspecialchars($row['e_insurance']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="e_owner" class="form-label">เจ้าของ</label>
            <input type="text" class="form-control" id="e_owner" name="e_owner" placeholder="เจ้าของ" value="<?php echo htmlspecialchars($row['e_owner']); ?>" required>
        </div>
        <div class="form-group">
            <label for="e_latitude" class="form-label">ละติจูด</label>
            <input type="text" class="form-control" id="e_latitude" name="e_latitude" placeholder="ละติจูด" value="<?php echo htmlspecialchars($row['e_latitude']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="e_longitude" class="form-label">ลองจิจูด</label>
            <input type="text" class="form-control" id="e_longitude" name="e_longitude" placeholder="ลองจิจูด" value="<?php echo htmlspecialchars($row['e_longitude']); ?>" required>
        </div>
        
        <div id="map" class="form-group">
            <!-- Google Maps Integration Here -->
        </div>
        
        <div class="button-group">
            <button class="btn btn-success" type="submit">แก้ไขข้อมูล</button>
            <a href="editestate.php" class="btn btn-danger">ยกเลิก</a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const salesTypeSelect = document.getElementById('e_sales_type');
        const insuranceInput = document.getElementById('e_insurance');

        function updateInsuranceField() {
            if (salesTypeSelect.value === 'ขาย') {
                insuranceInput.value = '-';
                insuranceInput.readOnly = true;
            } else if (salesTypeSelect.value === 'เช่า') {
                insuranceInput.readOnly = false;
            }
        }

        // Initialize the field based on current value
        updateInsuranceField();

        // Update the field on change
        salesTypeSelect.addEventListener('change', updateInsuranceField);
    });
</script>

</body>
</html>
