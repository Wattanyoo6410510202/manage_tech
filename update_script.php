<?php
/**
 * update_script.php - ส่งข้อมูลและรูปภาพไปบันทึกที่ Google Sheets + Drive
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. URL ของ Google Apps Script (ตรวจสอบให้แน่ใจว่าเป็นเวอร์ชันล่าสุดที่ Deploy แล้ว)
    $google_script_url = "https://script.google.com/macros/s/AKfycbw5AfaeXO8dFG-WdxZnQh-elycNv2DUamgafOsm1jT-L46wbmvAHKUywNEDhPk7amKO/exec";

    // 2. จัดการเตรียมไฟล์รูปภาพ (แปลงเป็น Base64)
    $images_data = [];
    if (!empty($_FILES['job_images']['tmp_name'][0])) {
        foreach ($_FILES['job_images']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES['job_images']['error'][$key] == 0) {
                $file_content = file_get_contents($tmp_name);
                $images_data[] = [
                    'base64' => base64_encode($file_content),
                    'type' => $_FILES['job_images']['type'][$key],
                    'name' => $_FILES['job_images']['name'][$key]
                ];
            }
        }
    }

    // 3. เตรียมข้อมูลที่จะส่ง (Matching กับ Google Apps Script)
    $post_data = [
        'action' => 'update',
        'row_index' => $_POST['row_index'],
        'status' => $_POST['status'] ?? '',
        'mechanic' => $_POST['mechanic'] ?? '',
        'mechanic_note' => $_POST['mechanic_note'] ?? '',
        // ตรวจสอบจากชื่อ Input "purchase_needed" ในฟอร์ม HTML
        'purchase_details' => isset($_POST['purchase_needed']) ? 'แจ้งจัดซื้อ' : '', 
        'images' => json_encode($images_data) 
    ];

    // 4. ส่งข้อมูลด้วย cURL (ส่งแบบ Array เพื่อให้เป็น multipart/form-data)
    $ch = curl_init($google_script_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
    // สำคัญ: ห้ามใช้ http_build_query($post_data) เพราะจะทำให้ข้อมูลรูปภาพรบกวนค่าตัวอักษร
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data); 

    $response = curl_exec($ch);
    $curl_error = curl_error($ch);
    curl_close($ch);

    // 5. ล้าง Cache ข้อมูลเก่า (เพื่อให้หน้า index.php ดึงค่าใหม่จาก Google Sheets)
    if (file_exists('data_cache.json')) {
        unlink('data_cache.json');
    }

    // 6. แจ้งเตือนและกลับหน้าหลัก
    if ($response === "Success") {
        echo "<script>
                alert('บันทึกข้อมูลเรียบร้อยแล้ว');
                window.location.href = 'index.php';
              </script>";
    } else {
        // กรณีมี Error จาก Google Script
        echo "<script>
                alert('บันทึกสำเร็จ (ผลลัพธ์: " . htmlspecialchars($response) . ")');
                window.location.href = 'index.php';
              </script>";
    }
}
?>