<?php
/**
 * header.php - ส่วนดึงข้อมูลกลาง (ธีมทองดำ Luxury)
 */

// 1. ตั้งค่าการเชื่อมต่อและ Cache
$google_script_url = "https://script.google.com/macros/s/AKfycbw5AfaeXO8dFG-WdxZnQh-elycNv2DUamgafOsm1jT-L46wbmvAHKUywNEDhPk7amKO/exec";
$cache_file = 'data_cache.json';
$cache_time = 300; // 5 นาที

// 2. ตรวจสอบระบบ Cache และดึงข้อมูล
if (file_exists($cache_file) && (time() - filemtime($cache_file) < $cache_time)) {
    $json_data = file_get_contents($cache_file);
    $all_data = json_decode($json_data, true);
} else {
    $response = @file_get_contents($google_script_url);
    if ($response) {
        file_put_contents($cache_file, $response);
        $all_data = json_decode($response, true);
    } else {
        $all_data = file_exists($cache_file) ? json_decode(file_get_contents($cache_file), true) : [];
    }
}

// 3. ฟังก์ชันจัดการสี Badge (ใช้ร่วมกันทุกหน้า)
function getStatusClass($status) {
    switch ($status) {
        case 'เสร็จสิ้น': return 'bg-success';
        case 'กำลังดำเนินการ': return 'bg-warning text-dark';
        case 'รอดำเนินการ': return 'bg-danger';
        default: return 'bg-secondary';
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHotel Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include('navbar.php'); ?>