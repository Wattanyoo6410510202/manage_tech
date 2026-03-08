<?php include('header.php'); ?>

<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;
$current_job = null;

if ($id !== null && isset($all_data[$id])) {
    $current_job = $all_data[$id];
}

if (!$current_job) {
    echo "<script>alert('ไม่พบข้อมูลรายการนี้'); window.location.href='index.php';</script>";
    exit;
}
?>

<div class="container mt-3 mb-5">
    <div class="d-flex align-items-center mb-3">
        <a href="index.php" class="text-gold me-3 fs-4"><i class="fa-solid fa-circle-chevron-left"></i></a>
        <h4 class="page-title mb-0" style="border-left: none; padding-left: 0; font-weight: 600;">จัดการข้อมูลงานซ่อม
        </h4>
    </div>

    <form action="update_script.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="row_index" value="<?php echo $id; ?>">

        <div class="card card-job-static border-gold-light p-3 mb-3">
            <h6 class="text-gold mb-3 small fw-bold text-uppercase" style="letter-spacing: 1px;">
                <i class="fa-solid fa-clipboard-list me-2"></i>ข้อมูลการแจ้งซ่อม
            </h6>
            <div class="row g-2">
                <div class="col-12">
                    <label class="text-sub small fw-bold">ชื่อ/ห้อง:</label>
                    <input type="text" class="form-control form-control-sm bg-light border-0"
                        value="<?php echo $current_job['ชื่อ']; ?>" readonly>
                </div>
                <div class="col-12">
                    <label class="text-sub small fw-bold">รายละเอียด:</label>
                    <textarea class="form-control form-control-sm bg-light border-0" rows="2"
                        readonly><?php echo $current_job['รายละเอียด']; ?></textarea>
                </div>
            </div>
        </div>

        <div class="card card-job-static border-gold-light p-3 mb-3">
            <h6 class="text-gold mb-3 small fw-bold text-uppercase" style="letter-spacing: 1px;">
                <i class="fa-solid fa-user-wrench me-2"></i>บันทึกการดำเนินการ
            </h6>
            <div class="row g-3">
                <div class="col-12">
                    <label class="text-sub small fw-bold mb-1">ช่างผู้รับผิดชอบ</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-gold-light text-gold">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <select class="form-select border-gold-light" name="mechanic">
                            <option value="" <?php echo empty($current_job['ช่าง']) ? 'selected' : ''; ?>>-- เลือกช่าง
                                --</option>
                            <option value="ช่างเป่า"
                                <?php echo ($current_job['ช่าง'] == 'ช่างเป่า') ? 'selected' : ''; ?>>ช่างเป่า</option>
                            <option value="ช่างเล็ก"
                                <?php echo ($current_job['ช่าง'] == 'ช่างเล็ก') ? 'selected' : ''; ?>>ช่างเล็ก</option>
                            <option value="ช่างอาร์"
                                <?php echo ($current_job['ช่าง'] == 'ช่างอาร์') ? 'selected' : ''; ?>>ช่างอาร์</option>
                            <option value="อื่นๆ"
                                <?php echo (!in_array($current_job['ช่าง'], ['ช่างเป่า', 'ช่างเล็ก', 'ช่างอาร์']) && !empty($current_job['ช่าง'])) ? 'selected' : ''; ?>>
                                อื่นๆ / ช่างนอก</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <label class="text-sub small fw-bold mb-2">บริการเพิ่มเติม</label>
                    <div class="purchase-toggle">
                        <input type="checkbox" class="btn-check" name="purchase_needed" id="purchase_check"
                            value="แจ้งจัดซื้อ" <?php echo !empty($current_job['จัดซื้อ']) ? 'checked' : ''; ?>>
                        <label
                            class="btn btn-outline-warning w-100 py-3 d-flex align-items-center justify-content-center rounded-3 shadow-none border-1"
                            for="purchase_check">
                            <i class="fa-solid fa-cart-plus me-2"></i>
                            <span class="fw-bold" style="font-size: 0.85rem;">ต้องการแจ้งจัดซื้อ / เบิกอะไหล่</span>
                        </label>
                    </div>
                </div>

                <div class="col-12">
                    <label class="text-sub small fw-bold mb-2">อัปเดตสถานะงาน</label>
                    <div class="row g-2">
                        <div class="col-4">
                            <input type="radio" class="btn-check" name="status" id="status1" value="รอดำเนินการ"
                                <?php echo $current_job['สถานะ'] == 'รอดำเนินการ' ? 'checked' : ''; ?>>
                            <label
                                class="btn btn-outline-danger w-100 py-2 d-flex flex-column align-items-center rounded-3 shadow-none border-1"
                                for="status1">
                                <i class="fa-solid fa-clock mb-1"></i>
                                <span style="font-size: 0.7rem;">รอ</span>
                            </label>
                        </div>
                        <div class="col-4">
                            <input type="radio" class="btn-check" name="status" id="status2" value="กำลังดำเนินการ"
                                <?php echo $current_job['สถานะ'] == 'กำลังดำเนินการ' ? 'checked' : ''; ?>>
                            <label
                                class="btn btn-outline-warning w-100 py-2 d-flex flex-column align-items-center rounded-3 shadow-none border-1"
                                for="status2">
                                <i class="fa-solid fa-screwdriver-wrench mb-1"></i>
                                <span style="font-size: 0.7rem;">ทำอยู่</span>
                            </label>
                        </div>
                        <div class="col-4">
                            <input type="radio" class="btn-check" name="status" id="status3" value="เสร็จสิ้น"
                                <?php echo $current_job['สถานะ'] == 'เสร็จสิ้น' ? 'checked' : ''; ?>>
                            <label
                                class="btn btn-outline-success w-100 py-2 d-flex flex-column align-items-center rounded-3 shadow-none border-1"
                                for="status3">
                                <i class="fa-solid fa-check-circle mb-1"></i>
                                <span style="font-size: 0.7rem;">เสร็จ</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <label class="text-sub small fw-bold mb-1">หมายเหตุ/เพิ่มเติมจากช่าง</label>
                    <textarea class="form-control border-gold-light" name="mechanic_note" rows="2"
                        placeholder="กรอกรายละเอียดการซ่อม..."><?php echo $current_job['เพิ่มเติมจากช่าง']; ?></textarea>
                </div>

                <div class="col-12 mt-3">
                    <label class="text-sub small fw-bold mb-2">
                        <i class="fa-solid fa-camera me-1 text-gold"></i> ภาพถ่ายหลังดำเนินการ (ถ้ามี)
                    </label>

                    <div class="card border-dashed p-3 text-center bg-light" id="drop-zone"
                        style="border: 2px dashed var(--gold-light); border-radius: 12px;">
                        <input type="file" name="job_images[]" id="job_images" class="d-none" accept="image/*" multiple
                            onchange="previewImages()">
                        <label for="job_images" style="cursor: pointer;" class="mb-0">
                            <i class="fa-solid fa-cloud-arrow-up fa-2x text-gold mb-2"></i>
                            <p class="small text-muted mb-0">คลิกเพื่อเลือกรูปภาพ หรือถ่ายภาพใหม่</p>
                            <span class="text-sub" style="font-size: 0.7rem;">(รองรับหลายไฟล์ JPG, PNG)</span>
                        </label>
                    </div>


                    <div id="image-preview-container" class="d-flex flex-wrap gap-2 mt-3"></div>
                </div>

                <div class="col-12 mt-3">
                    <label class="text-sub small fw-bold mb-2">
                        <i class="fa-solid fa-folder-open me-1 text-gold"></i> คลังรูปภาพเดิมในระบบ
                    </label>

                    <div class="p-2 border-gold-light rounded-3 bg-light">
                        <?php if (!empty($current_job['ลิ้งรวมรูป'])): ?>
                        <a href="<?php echo $current_job['ลิ้งรวมรูป']; ?>" target="_blank"
                            class="btn btn-sm btn-outline-gold w-100 py-2 d-flex align-items-center justify-content-center">
                            <i class="fa-brands fa-google-drive me-2"></i>
                            <span class="fw-bold">เปิดดูรูปภาพใน Google Drive</span>
                            <i class="fa-solid fa-arrow-up-right-from-square ms-2" style="font-size: 0.7rem;"></i>
                        </a>
                        <?php else: ?>
                        <div class="text-center py-2">
                            <span class="small text-muted italic">ยังไม่มีการบันทึกรูปภาพในงานนี้</span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>

        <div class="d-grid gap-2 mb-5">
            <button type="submit" class="btn btn-primary py-3 rounded-pill fw-bold shadow-sm border-0">
                <i class="fa-solid fa-save me-2"></i> บันทึกข้อมูลทั้งหมด
            </button>
        </div>
    </form>
</div>

<style>
/* การตั้งค่าหลัก */
:root {
    --primary-gold: #947436;
    --gold-light: rgba(148, 116, 54, 0.2);
}

.card-job-static {
    background: #fff;
    border-radius: 15px;
    border: 1px solid var(--gold-light) !important;
}

.border-gold-light {
    border: 1px solid var(--gold-light) !important;
}

.text-gold {
    color: var(--primary-gold);
}

.text-sub {
    color: #666;
}

/* ปรับแต่ง Input */
.form-control,
.form-select {
    border-radius: 8px;
    border-color: #eee;
    font-size: 0.9rem;
    transition: none !important;
}

.form-control:focus,
.form-select:focus {
    border-color: var(--primary-gold);
    box-shadow: none;
}

/* ตกแต่งปุ่มสถานะ */
.btn-check+.btn {
    border-color: #eee;
    background-color: #fafafa;
    color: #999;
    transition: none !important;
}

.btn-check:checked+.btn-outline-danger {
    background-color: #dc3545;
    color: white;
    border-color: #dc3545;
}

.btn-check:checked+.btn-outline-warning {
    background-color: #ffc107;
    color: #212529;
    border-color: #ffc107;
}

.btn-check:checked+.btn-outline-success {
    background-color: #198754;
    color: white;
    border-color: #198754;
}

.btn-primary {
    background-color: var(--primary-gold);
}

.btn-primary:active {
    background-color: #7a5f2c !important;
    transform: none !important;
}

.border-dashed {
    transition: all 0.3s ease;
}

.border-dashed:hover {
    background-color: rgba(148, 116, 54, 0.05) !important;
    border-color: var(--primary-gold) !important;
}

.preview-img-container {
    position: relative;
    width: 80px;
    height: 80px;
}

.preview-img-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid var(--gold-light);
}

.remove-img-btn {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #dc3545;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    font-size: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    cursor: pointer;
}
</style>

<script>
// ตัวแปรสะสมไฟล์ทั้งหมด
let selectedFiles = [];

function previewImages() {
    const fileInput = document.getElementById('job_images');
    const newFiles = Array.from(fileInput.files);

    // นำไฟล์ใหม่ที่เพิ่งเลือก ไปรวมกับไฟล์เดิมที่มีอยู่ (สะสมไปเรื่อยๆ)
    selectedFiles = selectedFiles.concat(newFiles);

    // อัปเดตไฟล์กลับไปที่ Input (เพื่อให้ตอน Submit ส่งไปครบทุกไฟล์)
    updateInputFiles();

    // วาด Preview ใหม่
    renderPreviews();
}

function renderPreviews() {
    const previewContainer = document.getElementById('image-preview-container');
    previewContainer.innerHTML = '';

    selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'preview-img-container shadow-sm';
            div.innerHTML = `
                    <img src="${e.target.result}">
                    <button type="button" class="remove-img-btn" onclick="removeFile(${index})">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                `;
            previewContainer.appendChild(div);
        }
        reader.readAsDataURL(file);
    });
}

function removeFile(index) {
    // ลบไฟล์ออกจาก Array ตามลำดับที่กด
    selectedFiles.splice(index, 1);

    // อัปเดตไฟล์กลับไปที่ Input
    updateInputFiles();

    // วาดตัวอย่างภาพใหม่
    renderPreviews();
}

// ฟังก์ชันกลางสำหรับอัปเดตค่าไปยัง Input จริง
function updateInputFiles() {
    const fileInput = document.getElementById('job_images');
    const dataTransfer = new DataTransfer();

    selectedFiles.forEach(file => {
        dataTransfer.items.add(file);
    });

    fileInput.files = dataTransfer.files;
}
</script>