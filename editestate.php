<?php
session_start();
include 'function.php';

$objCon = connectDB();
if (!$objCon) {
    die("การเชื่อมต่อล้มเหลว: " . mysqli_connect_error());
}

// คำสั่ง SQL เพื่อดึงข้อมูลอสังหาริมทรัพย์พร้อมกับรูปภาพและประเภท
$sql = "SELECT e.e_id, e.e_name, t.t_name, e.e_sales_type, e.e_area, e.e_price, 
               e.e_subdistrict, e.e_district, e.e_province, e.e_details, e.e_insurance, 
               e.e_owner, e.e_latitude, e.e_longitude, GROUP_CONCAT(ei.ei_path) AS image_paths
        FROM estate e
        LEFT JOIN estate_images ei ON e.e_id = ei.e_id
        LEFT JOIN typeestate t ON e.t_id = t.t_id
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
    <style>
        .logout-button {
            color: white;
            background-color: red;
            border: none;
            padding: 10px 20px;
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .table thead th {
            text-align: center;
            background-color: #f8f9fa;
            color: #333;
            font-weight: bold;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .table tbody tr:hover {
            background-color: #e9ecef;
        }
        .table td, .table th {
            padding: 12px;
            vertical-align: middle;
            text-align: center;
        }
        .table .btn {
            margin: 0 5px;
        }
        .d-flex-center {
            display: flex;
            align-items: center;
        }
        .form-group {
            margin-bottom: 0;
        }
        .img-thumbnail {
            max-width: 100px;
            height: auto;
        }
    </style>
    <script>
        function confirmDeletion(url) {
            return confirm("คุณต้องการจะลบข้อมูลหรือไม่");
        }
    </script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <?php include 'adminbar.html'; ?>
                <?php include 'logobar.php'; ?>
            </div>
            <!-- Main content -->
            <div class="col-md-9">
                <!-- Form for filtering and Add Estate button -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>แสดงข้อมูลอสังหาริมทรัพย์</div>
                    <div class="d-flex-center">
                        <a href="fr_estate.php" class="btn btn-success ml-3">เพิ่มอสังหาริมทรัพย์</a>
                    </div>
                </div>
                <!-- Table to display estate data -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ชื่ออสังหาริมทรัพย์</th>
                                <th>ประเภท</th>
                                <th>ประเภทการขาย</th>
                                <th>พื้นที่ (ตร.ม.)</th>
                                <th>ราคา</th>
                                <th>ตำบล</th>
                                <th>อำเภอ</th>
                                <th>จังหวัด</th>
                                <th>รายละเอียด</th>
                                <th>ประกัน</th>
                                <th>เจ้าของ</th>
                                <th>ละติจูด</th>
                                <th>ลองจิจูด</th>
                                <th>รูปภาพ</th>
                                <th>แก้ไข</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $imagePaths = explode(',', $row['image_paths']);
                                $imagesHtml = '';
                                foreach ($imagePaths as $path) {
                                    if ($path) {
                                        $imagesHtml .= "<img src='uploads/$path' class='img-thumbnail' alt='Image' width='100'>";
                                    }
                                }
                                echo "<tr>
                                    <td>{$row['e_name']}</td>
                                    <td>{$row['t_name']}</td>
                                    <td>{$row['e_sales_type']}</td>
                                    <td>{$row['e_area']}</td>
                                    <td>{$row['e_price']}</td>
                                    <td>{$row['e_subdistrict']}</td>
                                    <td>{$row['e_district']}</td>
                                    <td>{$row['e_province']}</td>
                                    <td>{$row['e_details']}</td>
                                    <td>{$row['e_insurance']}</td>
                                    <td>{$row['e_owner']}</td>
                                    <td>{$row['e_latitude']}</td>
                                    <td>{$row['e_longitude']}</td>
                                    <td>{$imagesHtml}</td>
                                    <td class='text-center'><a href='ed_estate.php?id={$row['e_id']}' class='btn btn-warning'>แก้ไข</a></td>
                                    <td class='text-center'><a href='delete_estate.php?id={$row['e_id']}' class='btn btn-danger' onclick='return confirmDeletion(this.href);'>ลบ</a></td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='16'>ไม่พบข้อมูล</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript for confirmation dialog -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>

<?php
mysqli_close($objCon);
?>
