    <!-- หน้าแก้ไขข้อมูลบริษัท -->

<?php
session_start();
require("function.php");
$objCon = connectDB();

$isLoggedIn = isset($_SESSION['user_login']);
$fullname = $isLoggedIn ? $_SESSION['user_login']['fullname'] : '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $c_id = mysqli_real_escape_string($objCon, $_POST['c_id']);
    $c_name = mysqli_real_escape_string($objCon, $_POST['c_name']);
    $c_details = mysqli_real_escape_string($objCon, $_POST['c_details']);
    $c_phone = mysqli_real_escape_string($objCon, $_POST['c_phone']);
    $c_email = mysqli_real_escape_string($objCon, $_POST['c_email']);
    $c_facebook = mysqli_real_escape_string($objCon, $_POST['c_facebook']);

    $sql = "UPDATE company SET c_name='$c_name', c_details='$c_details', c_phone='$c_phone', c_email='$c_email', c_facebook='$c_facebook' WHERE c_id='$c_id'";
    if (mysqli_query($objCon, $sql)) {
        echo '<script>alert("แก้ไขข้อมูลสำเร็จ"); window.location.href="editcompany.php";</script>';
    } else {
        echo '<script>alert("เกิดข้อผิดพลาด: ' . mysqli_error($objCon) . '"); window.location.href="editcompany.php";</script>';
    }
}

// Fetch company data
$sql = "SELECT * FROM company";
$result = mysqli_query($objCon, $sql);
$count = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลบริษัท</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: -700px; /* ปรับลด margin-top ของ container */
        }
        .btn-custom {
            margin-bottom: 20px;
        }
        main {
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <?php include 'logobar.php'; ?>
    <?php include 'adminbar.html'; ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
            <h2>จัดการข้อมูลบริษัท</h2>
            <hr>
            <?php if ($count > 0) { ?>
                <div class="row">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">รหัสบริษัท: <?php echo htmlspecialchars($row["c_id"]); ?></h6>
                                    <form action="editcompany.php" method="POST" class="form-horizontal">
                                        <input type="hidden" name="c_id" value="<?php echo $row["c_id"]; ?>">
                                        <div class="form-group mb-2">
                                            <label for="c_name_<?php echo $row["c_id"]; ?>" class="form-label">ชื่อบริษัท</label>
                                            <input type="text" name="c_name" id="c_name_<?php echo $row["c_id"]; ?>" class="form-control readonly" value="<?php echo $row["c_name"]; ?>" readonly>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="c_details_<?php echo $row["c_id"]; ?>" class="form-label">รายละเอียด</label>
                                            <input type="text" name="c_details" id="c_details_<?php echo $row["c_id"]; ?>" class="form-control readonly" value="<?php echo $row["c_details"]; ?>" readonly>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="c_phone_<?php echo $row["c_id"]; ?>" class="form-label">เบอร์โทรศัพท์บริษัท</label>
                                            <input type="text" name="c_phone" id="c_phone_<?php echo $row["c_id"]; ?>" class="form-control readonly" value="<?php echo $row["c_phone"]; ?>" readonly>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="c_email_<?php echo $row["c_id"]; ?>" class="form-label">อีเมล์บริษัท</label>
                                            <input type="text" name="c_email" id="c_email_<?php echo $row["c_id"]; ?>" class="form-control readonly" value="<?php echo $row["c_email"]; ?>" readonly>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="c_facebook_<?php echo $row["c_id"]; ?>" class="form-label">เฟสบุ๊คบริษัท</label>
                                            <input type="text" name="c_facebook" id="c_facebook_<?php echo $row["c_id"]; ?>" class="form-control readonly" value="<?php echo $row["c_facebook"]; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-warning btn-custom edit-button" data-id="<?php echo $row["c_id"]; ?>">แก้ไขข้อมูล</button>
                                            <input type="submit" value="บันทึก" class="btn btn-primary btn-custom save-button" data-id="<?php echo $row["c_id"]; ?>" style="display: none;">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="alert alert-warning">
                    ไม่มีข้อมูลบริษัท !!!!
                </div>
            <?php } ?>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.edit-button').forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                var fields = document.querySelectorAll('#c_name_' + id + ', #c_details_' + id + ', #c_phone_' + id + ', #c_email_' + id + ', #c_facebook_' + id);
                fields.forEach(function(field) {
                    field.removeAttribute('readonly');
                    field.classList.remove('readonly');
                });
                document.querySelector('.save-button[data-id="' + id + '"]').style.display = 'inline-block';
                this.style.display = 'none';
            });
        });
    </script>
</body>
</html>
