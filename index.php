    <!-- หน้าหลัก -->
<?php
session_start();
$isLoggedIn = isset($_SESSION['user_login']);
$fullname = $isLoggedIn ? $_SESSION['user_login']['fullname'] : '';
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naka Living</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }
        .relative {
            position: relative;
        }
        .flex {
            display: flex;
        }
        .flex-col {
            flex-direction: column;
        }
        .flex-1 {
            flex: 1;
        }
        .h-screen {
            height: 100vh;
        }
        .max-h-screen {
            max-height: 100vh;
        }
        .overflow-hidden {
            overflow: hidden;
        }
        .bg-cover {
            background-size: cover;
        }
        .bg-center {
            background-position: center;
        }
        .p-4 {
            padding: 1rem;
        }
        .rounded-xl {
            border-radius: 1rem;
        }
        .text-white {
            color: white;
        }
        .text-lg {
            font-size: 1.125rem;
        }
        .text-5xl {
            font-size: 3rem;
        }
        .font-semibold {
            font-weight: 600;
        }
        .backdrop-opacity-75 {
            backdrop-filter: opacity(0.75);
        }
        .backdrop-blur-lg {
            backdrop-filter: blur(1rem);
        }
        .hover\:drop-shadow-md:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .hover\:bg-white:hover {
            background-color: white;
        }
        .hover\:text-black:hover {
            color: black;
        }
        .transition-all {
            transition: all 0.7s;
        }
        .border-2 {
            border-width: 2px;
        }
        .border-white {
            border-color: white;
        }
        .rounded-md {
            border-radius: 0.375rem;
        }
        .p-2 {
            padding: 0.5rem;
        }
        .w-fit {
            width: fit-content;
        }
        .hover\:underline:hover {
            text-decoration: underline;
        }
        .gap-y-2 > * + * {
            margin-top: 0.5rem;
        }
        .gap-x-3 > * + * {
            margin-left: 0.75rem;
        }
        .space-y-4 > * + * {
            margin-top: 1rem;
        }
        .items-center {
            align-items: center;
        }
        .justify-center {
            justify-content: center;
        }
        .justify-around {
            justify-content: space-around;
        }
        .footer-reduced {
            padding-bottom: 0.6rem; /* Reduced to 60% of the original value (1rem) */
        }
        .logo {
            height: 40px;
            margin-right: 10px;
        }
        .btn-black {
            background-color: black;
            color: white;
            border: none;
        }
        .btn-black:hover {
            background-color: white;
            color: black;
            border: 1px solid black;
        }
        .btn-outline-white {
            background-color: transparent;
            color: white;
            border: 2px solid white;
            transition: all 0.7s;
        }
        .btn-outline-white:hover {
            background-color: white;
            color: black;
        }
        .btn-login {
            background-color: transparent;
            border: none;
            color: black;
        }
        .btn-white {
            background-color: transparent;
            border: none;
            color: white;
        }
        .btn-login:hover {
            text-decoration: underline;
        }
        /* Media Queries */
        @media (max-width: 768px) {
            .text-5xl {
                font-size: 2rem;
            }
            .text-lg {
                font-size: 1rem;
            }
            .p-4 {
                padding: 0.5rem;
            }
        }
        @media (max-width: 480px) {
            .text-5xl {
                font-size: 1.5rem;
            }
            .text-lg {
                font-size: 0.875rem;
            }
            .p-4 {
                padding: 0.25rem;
            }
            .logo {
                height: 30px;
            }
        }
    </style>
</head>
<body class="d-flex flex-column h-100">
    <?php include 'logobar.php'; ?>
    <div class="relative flex flex-1 flex-col overflow-hidden">
        <main class="flex flex-1 items-center justify-around bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1714317559964-498c611e2c0c?q=80&w=1995&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
            <div class="flex flex-col gap-y-2 justify-center items-center text-white p-4 rounded-xl backdrop-opacity-75 backdrop-blur-lg">
                <div class="flex flex-col text-5xl font-semibold space-y-4 items-center">
                    <div>ปล่อยให้เรื่องเช่า...ให้เป็นเรื่องง่าย</div>
                </div>
                <div class="text-lg">บริการบริหารดูแลอสังหาริมทรัพย์ให้เช่า</div>
                <div class="flex flex-row gap-x-3">
                    <a href="estate.php" class="w-fit">
                        <button  class="btn btn-light">
                            เข้าชม
                        </button>
                    </a>
                </div>
            </div>
        </main>
    </div>
    <footer class="bg-neutral-200 p-5 footer-reduced">
        <div class="container flex justify-around">
            <div class="font-semibold">Contact</div>
            <div>Tel. 098-691-5592</div>
            <div>Email: NakaLivinggroup@gmail.com</div>
            <div>FB: Naka Living</div>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
