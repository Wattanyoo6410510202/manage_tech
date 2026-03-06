<?php
/**
 * update_script.php - ส่งข้อมูลไปบันทึกที่ Google Sheets
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. URL ของ Google Apps Script (อันเดิมของคุณ)
    $google_script_url = "https://script.google.com/macros/s/AKfycbwVL2QtRrLqYhSRrGgjoCy1zDbcjqwWApzYzCLQY3P0NqKDf2Rsvecn9WY0pkN3W_b0/exec";

    // 2. เตรียมข้อมูลที่รับมาจากฟอร์ม
    // ส่งค่าชื่อคอลัมน์ให้ตรงกับที่ Google Script รอรับ
    $post_data = [
        'action' => 'update', // ระบุ Action ว่าเป็นการอัปเดต
        'row_index' => $_POST['row_index'],
        'status' => $_POST['status'],
        'mechanic' => $_POST['mechanic'],
        'mechanic_note' => $_POST['mechanic_note']
    ];

    // 3. ส่งข้อมูลด้วย cURL
    $ch = curl_init($google_script_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

    $response = curl_exec($ch);
    curl_close($ch);

    // 4. เมื่อบันทึกเสร็จ ให้ลบไฟล์ Cache เดิมทิ้ง เพื่อให้หน้าแรกโหลดข้อมูลใหม่ทันที
    if (file_exists('data_cache.json')) {
        unlink('data_cache.json');
    }

    // 5. ส่งกลับไปหน้าแรกพร้อมข้อความแจ้งเตือน
    echo "<script>
            alert('บันทึกข้อมูลเรียบร้อยแล้ว');
            window.location.href = 'index.php';
          </script>";
}
?>