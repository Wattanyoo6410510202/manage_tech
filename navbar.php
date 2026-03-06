<nav class="navbar navbar-expand-lg navbar-dark bg-primary navbar-desktop">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">รายงานช่าง</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" href="index.php">รายการทั้งหมด</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'in_progress.php') ? 'active' : ''; ?>" href="in_progress.php">กำลังดำเนินการ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'completed.php') ? 'active' : ''; ?>" href="completed.php">เสร็จสิ้นแล้ว</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="mobile-nav">
    <a href="index.php" class="mobile-nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">
        <i class="fa-solid fa-clock"></i>
        <span>รอทำ</span>
    </a>
    <a href="in_progress.php" class="mobile-nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'in_progress.php') ? 'active' : ''; ?>">
        <i class="fa-solid fa-hammer"></i>
        <span>กำลังทำ</span>
    </a>
    <a href="completed.php" class="mobile-nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'completed.php') ? 'active' : ''; ?>">
        <i class="fa-solid fa-check-circle"></i>
        <span>เสร็จแล้ว</span>
    </a>
    <a href="add_report.php" class="mobile-nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'add_report.php') ? 'active' : ''; ?>">
         <i class="fa-solid fa-cog"></i>
        <span>เพิ่มเติม</span>
    </a>
</div>