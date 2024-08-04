<?php
function connectDB() {
    $serverName = "127.0.0.1";
    $userName = "root";
    $userPassword = "";
    $dbName = "nakaliving";
    
// สร้างการเชื่อมต่อ
    $objCon = new mysqli($serverName, $userName, $userPassword, $dbName);

    // ตรวจสอบการเชื่อมต่อ
    if ($objCon->connect_error) {
        die("การเชื่อมต่อล้มเหลว: " . $objCon->connect_error);
    }

    // ตั้งค่าชุดอักขระให้เป็น UTF-8
    $objCon->set_charset("utf8");

    return $objCon;
}
?>