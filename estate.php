<?php
session_start();
include 'function.php';

// Connect to the database
$objCon = connectDB();
if (!$objCon) {
    die("การเชื่อมต่อล้มเหลว: " . mysqli_connect_error());
}

// Process form submission for updating information
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_all'])) {
    $e_id = mysqli_real_escape_string($objCon, $_POST['e_id']);
    $a_id = isset($_POST['a_id']) ? mysqli_real_escape_string($objCon, $_POST['a_id']) : null;
    $discount = isset($_POST['discount']) ? mysqli_real_escape_string($objCon, $_POST['discount']) : null;
    $a_day = mysqli_real_escape_string($objCon, $_POST['a_day']);
    $a_status = mysqli_real_escape_string($objCon, $_POST['a_status']);
    $e_values = isset($_POST['e_values']) ? 1 : 0; // Toggle switch value

    // Fetch the original price
    $sqlFetchPrice = "SELECT e_price FROM estate WHERE e_id = '$e_id'";
    $resultFetchPrice = mysqli_query($objCon, $sqlFetchPrice);
    if ($resultFetchPrice) {
        $rowFetchPrice = mysqli_fetch_assoc($resultFetchPrice);
        $originalPrice = $rowFetchPrice['e_price'];

        // Calculate the new price after discount only if discount is provided
        $newPrice = $originalPrice;
        if ($discount !== null && $discount > 0) {
            $discountAmount = ($originalPrice * $discount) / 100;
            $newPrice = $originalPrice - $discountAmount;
        }

        // Update or insert the announce table
        if ($a_id) {
            $sqlUpdate = "UPDATE announce SET e_id='$e_id', a_discount='$discount', a_price='$newPrice', a_day='$a_day', a_status='$a_status', e_values='$e_values'
                          WHERE a_id='$a_id'";
        } else {
            $sqlUpdate = "INSERT INTO announce (e_id, a_discount, a_price, a_day, a_status, e_values)
                          VALUES ('$e_id', '$discount', '$newPrice', '$a_day', '$a_status', '$e_values')";
        }

        if (mysqli_query($objCon, $sqlUpdate)) {
            // Update successful
        } else {
            mysqli_error($objCon);
        }
    } else {
        mysqli_error($objCon);
    }
}

// SQL query to fetch estate data
$sql = "SELECT e.e_id, e.e_name, t.t_name, e.e_sales_type, e.e_area, e.e_price, 
               e.e_subdistrict, e.e_district, e.e_province, e.e_details, e.e_insurance, 
               e.e_owner, e.e_latitude, e.e_longitude, GROUP_CONCAT(ei.ei_path) AS image_paths, 
               a.a_id, a.a_discount, a.a_day, a.a_status, a.a_price, a.e_values
        FROM estate e
        LEFT JOIN estate_images ei ON e.e_id = ei.e_id
        LEFT JOIN typeestate t ON e.t_id = t.t_id
        LEFT JOIN announce a ON e.e_id = a.e_id
        GROUP BY e.e_id";
$result = mysqli_query($objCon, $sql);
if (!$result) {
    die("การดำเนินการคำสั่ง SQL ล้มเหลว: " . mysqli_error($objCon));
}
?>

<!DOCTYPE html>
<html lang="th">
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
    <!-- Custom styles for cards -->
    <style>
        .container {
            transform: scale(0.6); /* Adjust the scale to reduce size */
            transform-origin: 0 0;
        }
        .property-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            overflow: hidden;
        }
        .property-card img {
            width: 100%;
            height: auto;
        }
        .property-card-body {
            padding: 15px;
        }
        .property-card-title {
            font-size: 1.2em;
            margin-bottom: 10px;
        }
        .property-card-text {
            margin-bottom: 10px;
        }
        .property-card-price {
            font-size: 1.5em;
            color: #007bff;
        }
    </style>
</head>
<body>
<?php include 'logobar.php'; ?>
    <div class="container">
        <div class="row">
            <!-- Main content -->
            <div class="col-md-12">
                <div class="row">
                    <?php
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
<<<<<<< HEAD
                            // ตรวจสอบค่า e_values
                            if ($row['e_values'] == 1) {
                                $imagePaths = explode(',', $row['image_paths']);
                                $imageHtml = $imagePaths[0] ? "<img src='uploads/{$imagePaths[0]}' class='img-fluid' alt='Property Image'>" : "";
                                $a_day = $row['a_day'] ? date('Y-m-d', strtotime($row['a_day'])) : '';
                                $a_status = $row['a_status'] ?? 0; // Default to 0 if not found
                                $statusOptions = [
                                    0 => 'ว่าง',
                                    1 => 'ติดจอง',
                                    2 => 'ปิดการขาย'
                                ];
                                $statusHtml = '';
                                foreach ($statusOptions as $value => $label) {
                                    $selected = ($a_status == $value) ? 'selected' : '';
                                    $statusHtml .= "<option value='{$value}' {$selected}>{$label}</option>";
                                }

                                // Format price with currency and discount
                                $formattedPrice = number_format($row['a_price'], 2) . " บาท";
                                $discountHtml = $row['a_discount'] ? "{$row['a_discount']}%" : '';

                                echo "<div class='col-md-4'>
                                        <div class='property-card'>
                                            <form method='POST'>
                                                <div class='property-card-image'>
                                                    {$imageHtml}
                                                </div>
                                                <div class='property-card-body'>
                                                    <h5 class='property-card-title'>{$row['e_name']}</h5>
                                                    <p class='property-card-text'>ประเภท: {$row['t_name']}</p>
                                                    <p class='property-card-text'>พื้นที่: {$row['e_area']} ตร.ม.</p>
                                                    <p class='property-card-text'>สถานะ: " . $statusOptions[$a_status] . "</p>
                                                    <p class='property-card-text'>ส่วนลด: {$discountHtml}</p>
                                                    <p class='property-card-price'>ราคา: ฿{$row['e_price']}</p>
                                                    <p class='property-card-price'>ราคาส่วนลด: {$formattedPrice}</p>
                                                    <input type='hidden' name='e_id' value='{$row['e_id']}'>
                                                    <input type='hidden' name='a_id' value='{$row['a_id']}'>
                                                </div>
                                            </form>
                                        </div>
                                    </div>";
                            }
=======
                            $imagePaths = explode(',', $row['image_paths']);
                            $imageHtml = $imagePaths[0] ? "<img src='uploads/{$imagePaths[0]}' class='img-fluid' alt='Property Image'>" : "";
                            $a_day = $row['a_day'] ? date('Y-m-d', strtotime($row['a_day'])) : '';
                            $a_status = $row['a_status'] ?? 0; // Default to 0 if not found
                            $statusOptions = [
                                0 => 'ว่าง',
                                1 => 'ติดจอง',
                                2 => 'ปิดการขาย'
                            ];
                            $statusHtml = '';
                            foreach ($statusOptions as $value => $label) {
                                $selected = ($a_status == $value) ? 'selected' : '';
                                $statusHtml .= "<option value='{$value}' {$selected}>{$label}</option>";
                            }

                            // Format price with currency and discount
                            $formattedPrice = number_format($row['a_price'], 2) . " บาท";
                            $discountHtml = $row['a_discount'] ? "{$row['a_discount']}%" : '';

                            echo "<div class='col-md-4'>
                                    <div class='property-card'>
                                        <form method='POST'>
                                            <div class='property-card-image'>
                                                {$imageHtml}
                                            </div>
                                            <div class='property-card-body'>
                                                <h5 class='property-card-title'>{$row['e_name']}</h5>
                                                <p class='property-card-text'>ประเภท: {$row['t_name']}</p>
                                                <p class='property-card-text'>พื้นที่: {$row['e_area']} ตร.ม.</p>
                                                <p class='property-card-text'>สถานะ: " . $statusOptions[$a_status] . "</p>
                                                <p class='property-card-text'>ส่วนลด: {$discountHtml}</p>
                                                <p class='property-card-price'>ราคา: ฿{$row['e_price']}</p>
                                                <p class='property-card-price'>ราคาส่วนลด: {$formattedPrice}</p>
                                                <input type='hidden' name='e_id' value='{$row['e_id']}'>
                                                <input type='hidden' name='a_id' value='{$row['a_id']}'>
                                            </div>
                                        </form>
                                    </div>
                                </div>";
>>>>>>> e6660e165532a3d1c7f7ce7b3692b0085f0eb4c6
                        }
                    } else {
                        echo "<div class='col-12'><p>ไม่พบข้อมูล</p></div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
<<<<<<< HEAD

</html>
=======
</html>
>>>>>>> e6660e165532a3d1c7f7ce7b3692b0085f0eb4c6
