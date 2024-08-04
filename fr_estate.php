<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลอสังหาริมทรัพย์</title>
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/style.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลอสังหาริมทรัพย์</title>
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
        <h1 class="h3 mb-3 font-weight-normal">เพิ่มอสังหาริมทรัพย์</h1>
        <form class="form-register" method="post" action="insert_estate.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="e_name" class="form-label">ชื่ออสังหาริมทรัพย์</label>
                <input type="text" class="form-control" id="e_name" name="e_name" placeholder="ชื่ออสังหาริมทรัพย์" required>
            </div>
            <div class="form-inline-group">
                <div class="form-col">
                    <label for="t_id" class="form-label">ชนิดอสังหาริมทรัพย์</label>
                    <select class="form-control" id="t_id" name="t_id" required>
                        <option value="">เลือกชนิดอสังหาริมทรัพย์</option>
                        <?php
                        include_once('./function.php');
                        $objCon = connectDB();
                        $typeSQL = "SELECT * FROM typeestate";
                        $typeQuery = mysqli_query($objCon, $typeSQL) or die(mysqli_error($objCon));
                        while ($typeRow = mysqli_fetch_assoc($typeQuery)) {
                            echo '<option value="' . $typeRow['t_id'] . '">' . $typeRow['t_name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-col">
                    <label for="e_sales_type" class="form-label">ประเภทการขาย</label>
                    <select class="form-control" id="e_sales_type" name="e_sales_type" required>
                        <option value="">เลือกประเภทการขาย</option>
                        <option value="ขาย">ขาย</option>
                        <option value="เช่า">เช่า</option>
                    </select>
                </div>
            </div>
            <div class="form-row d-flex">
                <div class="form-col">
                    <label for="e_area" class="form-label">พื้นที่ (ตารางวา)</label>
                    <input type="text" class="form-control" id="e_area" name="e_area" placeholder="พื้นที่ (ตารางวา)" required>
                </div>
                <div class="form-col">
                    <label for="e_price" class="form-label">ราคา</label>
                    <input type="text" class="form-control" id="e_price" name="e_price" placeholder="ราคา" required>
                </div>
            </div>
            <div class="form-row d-flex">
                <div class="form-col">
                    <label for="e_subdistrict" class="form-label">ตำบล</label>
                    <input type="text" class="form-control" id="e_subdistrict" name="e_subdistrict" placeholder="ตำบล" required>
                </div>
                <div class="form-col">
                    <label for="e_district" class="form-label">อำเภอ</label>
                    <input type="text" class="form-control" id="e_district" name="e_district" placeholder="อำเภอ" required>
                </div>
                <div class="form-col">
                    <label for="e_province" class="form-label">จังหวัด</label>
                    <input type="text" class="form-control" id="e_province" name="e_province" placeholder="จังหวัด" required>
                </div>
            </div>
            <div class="form-group">
                <label for="e_details" class="form-label">คำอธิบาย</label>
                <input type="text" class="form-control" id="e_details" name="e_details" placeholder="คำอธิบาย" required>
            </div>
            <div class="form-group">
                <label for="e_insurance" class="form-label">ประกัน</label>
                <input type="text" class="form-control" id="e_insurance" name="e_insurance" placeholder="ประกัน" required>
            </div>
            <div class="form-group">
                <label for="e_owner" class="form-label">เจ้าของ</label>
                <input type="text" class="form-control" id="e_owner" name="e_owner" placeholder="เจ้าของ" required>
            </div>
            <div class="form-group">
                <label for="ei_paths[]" class="form-label">รูปภาพ</label>
                <input type="file" class="form-control" id="ei_paths" name="ei_paths[]" multiple required>
            </div>
             
        
        <form class="form-register" method="post" action="insert_estate.php" enctype="multipart/form-data">
            <!-- Form fields -->
            <!-- Your form fields here -->
            <div class="form-group">
                <label for="e_latitude" class="form-label">ละติจูด</label>
                <input type="text" class="form-control" id="e_latitude" name="e_latitude" placeholder="ละติจูด" required>
            </div>
            <div class="form-group">
                <label for="e_longitude" class="form-label">ลองจิจูด</label>
                <input type="text" class="form-control" id="e_longitude" name="e_longitude" placeholder="ลองจิจูด" required>
            </div>
            <div id="map" class="form-group">
                <!-- Google Maps Integration Here -->
            </div>
            
        
    
            <div class="button-group">
                <button class="btn btn-success" type="submit">เพิ่มข้อมูล</button>
                <a href="editestate.php" class="btn btn-danger">ยกเลิก</a>
            </div>
        </form>
    </div>

    <!-- Load the Google Maps API (Replace YOUR_API_KEY with your actual API key) -->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language=th" async defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var initialLatLng = { lat: 16.439755821668168, lng: 102.82750683593747 }; // Example initial position, replace with actual coordinates
            
            var map = new google.maps.Map(document.getElementById('map'), {
                center: initialLatLng,
                zoom: 12 // Adjust as appropriate
            });

            var marker = new google.maps.Marker({
                position: initialLatLng,
                map: map,
                draggable: true // Allow marker to be draggable
            });

            google.maps.event.addListener(marker, 'dragend', function(event) {
                document.getElementById('e_latitude').value = event.latLng.lat();
                document.getElementById('e_longitude').value = event.latLng.lng();
            });

            var salesTypeSelect = document.getElementById('e_sales_type');
            var insuranceInput = document.getElementById('e_insurance');
    
            salesTypeSelect.addEventListener('change', function() {
                if (this.value === 'ขาย') {
                    insuranceInput.value = '-';
                    insuranceInput.setAttribute('readonly', true);
                } else {
                    insuranceInput.removeAttribute('readonly');
                    insuranceInput.value = '';
                }
            });
        });
    </script>
</body>
</html>
