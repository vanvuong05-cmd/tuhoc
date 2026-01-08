<?php
session_start();
$page = $_GET['page'] ?? 'nippo';
$admin_login = $_SESSION['admin_login'] ?? false;
$title = 'タイヘイ製作所有限会社';

switch ($page) {
  case 'nippo':
    $title = '日報入力';
    break;
  case 'home':
    $title = '作業中一覧';
    break;
  case 'report':
    $title = 'レポート管理';
    break;
  case 'kikai':
    $title = '使用機械一覧';
    break;
  case 'admin':
    $title = '管理者ログイン';
    break;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($title) ?></title>
<style>
body {
  margin: 0;
  font-family: "Segoe UI", sans-serif;
  background: #f4f6f8;
  padding-top: 55px; /* chừa chỗ cho tab bar */
}

/* ===== TAB BAR ===== */
.tab-bar {
  display: flex;
  background: #2c3e50;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 9999;

  overflow-x: auto;        /* Cho phép cuộn ngang trên mobile */
  white-space: nowrap;     /* Không xuống dòng */
}

.tab-bar a {
  color: #ecf0f1;
  padding: 14px 18px;
  text-decoration: none;
  border-right: 1px solid #34495e;
  font-size: 15px;
  display: inline-block;
}

.tab-bar a:hover {
  background: #34495e;
}

.tab-bar a.active {
  background: #1abc9c;
  font-weight: bold;
}

/* ===== CONTENT ===== */
.content {
  padding: 10px;
}

/* ===== MOBILE RESPONSIVE ===== */
@media (max-width: 600px) {
  .tab-bar a {
    padding: 12px 14px;
    font-size: 14px;
  }

  .content {
    padding: 8px;
  }
}
</style>
</head>

<body>

<!-- TAB -->

<div class="tab-bar">
  <a href="?page=nippo" class="<?= $page=='nippo'?'active':'' ?>">🏠 入力</a>
  <a href="?page=report" class="<?= $page=='report'?'active':'' ?>">📋 レポート</a>
  <a href="?page=report_day" class="<?= $page=='report_day'?'active':'' ?>">📅 日別レポート</a>
  <a href="?page=home" class="<?= $page=='home'?'active':'' ?>">📋 作業中</a>
  <a href="?page=kikai" class="<?= $page=='kikai'?'active':'' ?>">⚙ 設備</a>

  <!-- TAB QUẢN LÝ -->
  <a href="?page=admin" class="<?= $page=='admin'?'active':'' ?>">🔐 管理者</a>

  <!-- CHỈ HIỆN KHI ĐÃ LOGIN ADMIN -->
  <?php if ($admin_login): ?>
    <a href="?page=admin_home" class="<?= $page=='admin_home'?'active':'' ?>">🏠 Admin Home</a>
    <a href="?page=kikai_input" class="<?= $page=='kikai_input'?'active':'' ?>">⚙ 設備入力</a>
    
    <a href="admin/logout.php" style="margin-left:auto; background:#c0392b;">🚪 Logout</a>
  <?php endif; ?>
</div>

<!-- CONTENT -->
<div class="content">
<?php
switch ($page) {
  case 'home':
    include "home.php";
    break;
  case 'report':
    include "report/report_admin.php";
    break;
  case 'report_day':
    include "report/report_day.php";
    break;
  case 'kikai':
    include "view/kikai_view.php";
    break;

  case 'admin':
    include "admin/login.php";
    break;
/* ===== ADMIN SAU LOGIN ===== */

  case 'admin_home':
    include "admin/home_admin.php";
    break;

  case 'kikai_input':
    include "admin/kikai_input.php";
    break;
  default:
    include "nippo_form.php"; // trang nhập báo cáo
}
?>
</div>

</body>
</html>
