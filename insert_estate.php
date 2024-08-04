<?php
include_once('./function.php');
$objCon = connectDB();

// รับข้อมูลจากฟอร์ม
$data = $_POST;
$e_name = mysqli_real_escape_string($objCon, $data['e_name']);
$t_id = mysqli_real_escape_string($objCon, $data['t_id']);
$e_sales_type = mysqli_real_escape_string($objCon, $data['e_sales_type']);
$e_area = mysqli_real_escape_string($objCon, $data['e_area']);
$e_price = mysqli_real_escape_string($objCon, $data['e_price']);
$e_subdistrict = mysqli_real_escape_string($objCon, $data['e_subdistrict']);
$e_district = mysqli_real_escape_string($objCon, $data['e_district']);
$e_province = mysqli_real_escape_string($objCon, $data['e_province']);
$e_details = mysqli_real_escape_string($objCon, $data['e_details']);
$e_insurance = mysqli_real_escape_string($objCon, $data['e_insurance']);
$e_owner = mysqli_real_escape_string($objCon, $data['e_owner']);
$e_latitude = mysqli_real_escape_string($objCon, $data['e_latitude']);
$e_longitude = mysqli_real_escape_string($objCon, $data['e_longitude']);

// จัดการการอัปโหลดไฟล์
$target_dir = "uploads/";

// ตรวจสอบว่าโฟลเดอร์ uploads มีอยู่หรือไม่ ถ้าไม่ให้สร้าง
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$upload_success = true;
$image_paths = [];

// Loop through each file
foreach ($_FILES['ei_paths']['tmp_name'] as $key => $tmp_name) {
    $file_name = basename($_FILES['ei_paths']['name'][$key]);
    $target_file = $target_dir . $file_name;

    if ($_FILES['ei_paths']['error'][$key] === UPLOAD_ERR_OK) {
        if (move_uploaded_file($tmp_name, $target_file)) {
            $image_paths[] = $file_name;
        } else {
            $upload_success = false;
            break;
        }
    } else {
        $upload_success = false;
        break;
    }
}

if ($upload_success) {
    // ตรวจสอบว่า e_name มีอยู่ในฐานข้อมูลหรือไม่
    $checkSQL = "SELECT * FROM estate WHERE e_name = '$e_name'";
    $checkQuery = mysqli_query($objCon, $checkSQL);

    if (!$checkQuery) {
        die('Query Error: ' . mysqli_error($objCon));
    }

    if (mysqli_num_rows($checkQuery) > 0) {
        // ถ้า e_name มีอยู่แล้ว
        echo '<script>alert("ชื่ออสังหาริมทรัพย์นี้มีอยู่แล้ว กรุณาใช้ชื่ออื่น");window.location="fr_estate.php";</script>';
    } else {
        // ตรวจสอบว่า t_id มีอยู่ในตาราง typeestate หรือไม่
        $checkTypeSQL = "SELECT * FROM typeestate WHERE t_id = '$t_id'";
        $checkTypeQuery = mysqli_query($objCon, $checkTypeSQL);

        if (!$checkTypeQuery) {
            die('Query Error: ' . mysqli_error($objCon));
        }

        if (mysqli_num_rows($checkTypeQuery) == 0) {
            echo '<script>alert("ชนิดอสังหาริมทรัพย์นี้ไม่มีอยู่ในระบบ กรุณาเลือกชนิดอสังหาริมทรัพย์ที่ถูกต้อง");window.location="fr_estate.php";</script>';
        } else {
            // ถ้า e_name และ t_id ถูกต้อง
            $strSQL = "INSERT INTO estate (
                e_name,
                t_id,
                e_sales_type, 
                e_area, 
                e_price, 
                e_subdistrict,
                e_district, 
                e_province,
                e_details, 
                e_insurance,
                e_owner, 
                e_latitude,
                e_longitude
            ) VALUES (
                '$e_name', 
                '$t_id', 
                '$e_sales_type', 
                '$e_area',
                '$e_price',
                '$e_subdistrict',
                '$e_district',
                '$e_province',
                '$e_details',
                '$e_insurance',
                '$e_owner',
                '$e_latitude',
                '$e_longitude'
            )";

            $objQuery = mysqli_query($objCon, $strSQL);

            if (!$objQuery) {
                die('Query Error: ' . mysqli_error($objCon));
            }

            // รับ ID ของอสังหาริมทรัพย์ที่เพิ่มเข้าไป
            $estate_id = mysqli_insert_id($objCon);

            // เก็บข้อมูลรูปภาพลงตาราง estate_images
            foreach ($image_paths as $path) {
                $imgSQL = "INSERT INTO estate_images (e_id, ei_path) VALUES ('$estate_id', '$path')";
                $imgQuery = mysqli_query($objCon, $imgSQL);

                if (!$imgQuery) {
                    die('Query Error: ' . mysqli_error($objCon));
                }
            }

            echo '<script>alert("ลงทะเบียนเรียบร้อยแล้ว");window.location="editestate.php";</script>';
        }
    }
} else {
    die("File upload error.");
}

mysqli_close($objCon);
?>
