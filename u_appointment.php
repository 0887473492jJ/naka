    <!-- หน้านัดหมายของลูกค้า -->
<?php
session_start();
if (!isset($_SESSION['user_login'])) {
    header("Location: login.html");
    exit;
}
$user = $_SESSION['user_login'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager</title>
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/style.css" rel="stylesheet">
    <!-- Font Awesome CSS for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<?php include 'logobar.php'; ?>
<?php include 'userbar.html'; ?>
    <header class="d-flex justify-content-between align-items-center p-3 border-bottom">
        <a href="index.php" class="navbar-brand">Naka Living</a>
        <div>
            <span>สวัสดี, <?php echo htmlspecialchars($user['fullname']); ?></span>
            <a href="logout_action.php" class="btn btn-outline-secondary">ออกจากระบบ</a>
        </div>
    </header>
    <!-- logobar -->
    <?php include 'logobar.php'?>
    <!-- Sidebar -->
    <?php include 'userbar.html'; ?>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="bg-light p-5 rounded mt-3">
                    <h1>ข้อมูลการนัดหมาย</h1>
                </div>
            </main>
        </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
