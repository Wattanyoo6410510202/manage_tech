<?php 
include('header.php'); 

// กรองเฉพาะงาน "กำลังดำเนินการ"
$display_data = [];
if (!empty($all_data)) {
    foreach ($all_data as $index => $row) {
        if (isset($row['สถานะ']) && $row['สถานะ'] === 'เสร็จสิ้น') {
            $row['original_index'] = $index;
            $display_data[] = $row;
        }
    }
}
?>

<div class="container mt-3 mt-lg-4">
    <div class="row g-3">
        <?php if (!empty($display_data)): ?>
            <?php foreach ($display_data as $row): ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card card-job p-3 position-relative shadow-sm border-0 mb-2"
                        onclick="location.href='edit_report.php?id=<?php echo $row['original_index']; ?>'"
                        style="cursor: pointer;">

                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <small class="text-sub">
                                <i class="fa-regular fa-clock me-1 text-gold"></i>
                                <?php
                                if (isset($row['เวลา'])) {
                                    $date_part = explode(',', $row['เวลา'])[0];
                                    $timestamp = strtotime($date_part);
                                    echo date('d/m/', $timestamp) . (date('Y', $timestamp) + 543);
                                } else {
                                    echo '-';
                                }
                                ?>
                            </small>
                        </div>

                        <div class="mb-3">
                            <p class="text-main fw-normal mb-0" style="font-size: 0.95rem; line-height: 1.5;">
                                <?php echo $row['รายละเอียด']; ?>
                            </p>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top"
                            style="border-color: rgba(148, 116, 54, 0.1) !important;">

                            <div class="d-flex flex-column">
                                <span class="text-main fw-bold small mb-1">
                                    <i class="fa-solid fa-id-badge me-1 text-gold"></i>
                                    <?php echo $row['ชื่อ'] ?: 'ไม่ระบุชื่อ'; ?>
                                </span>

                                <span class="text-sub" style="font-size: 0.75rem;">
                                    <i class="fa-solid fa-user-wrench me-1 text-gold"></i>
                                    <span class="opacity-75">ช่าง:</span>
                                    <?php echo $row['ช่าง'] ?: 'รอมอบหมาย'; ?>
                                </span>
                            </div>

                            <div class="text-gold">
                                <i class="fa-solid fa-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>