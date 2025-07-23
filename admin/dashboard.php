<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}
include "../config/koneksi.php";

// Ambil data user yang sedang login
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - SIMONEV BPS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f1f5f9;
    }
    .sidebar {
      width: 250px;
      background-color: #023e8a;
      min-height: 100vh;
      transition: all 0.3s ease;
    }
    .sidebar.collapsed {
      width: 70px;
    }
    .sidebar .nav-link {
      color: #ffffff;
      font-size: 15px;
      padding: 10px 20px;
    }
    .sidebar .nav-link:hover {
      background-color: #0077b6;
      color: #fff;
    }
    .sidebar .nav-link i {
      margin-right: 8px;
    }
    .sidebar.collapsed .nav-link span {
      display: none;
    }
    .sidebar.collapsed h5,
    .sidebar.collapsed .logout-btn {
      display: none;
    }
    .main-content {
      flex-grow: 1;
      padding: 20px;
    }
    .card-box {
      border-left: 5px solid #0077b6;
    }
    .toggle-btn {
      position: absolute;
      top: 15px;
      right: -15px;
      background: #0077b6;
      color: white;
      border: none;
      border-radius: 50%;
      padding: 4px 8px;
      cursor: pointer;
    }
  </style>
</head>
<body>

<div class="d-flex">
  <!-- Sidebar -->
  <div id="sidebar" class="sidebar text-white position-relative">
    <div class="p-3">
      <h5 class="fw-bold">BPS SIMONEV</h5>
    </div>
    <ul class="nav flex-column">
      <li><a href="dashboard.php" class="nav-link"><i class="bi bi-house-door"></i> <span>Home</span></a></li>
      <li><a href="kegiatan.php" class="nav-link"><i class="bi bi-journal-text"></i> <span>Kegiatan</span></a></li>
      <li><a href="index.php" class="nav-link"><i class="bi bi-people-fill"></i> <span>Manajemen User</span></a></li>
    </ul>
    <div class="p-3">
      <a href="../index.php" class="btn btn-light w-100 logout-btn"><i class="bi bi-box-arrow-left"></i> Logout</a>
    </div>
    <button id="toggleSidebar" class="toggle-btn"><i class="bi bi-chevron-double-left"></i></button>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <div class="mt-1 d-flex gap-2 flex-wrap">
  <span>Selamat datang, <strong><?= htmlspecialchars($user['nama']) ?></strong>,</span>
  <span>Anda login sebagai <strong><?= $user['role'] ?></strong></span>
  <?php if (!empty($user['sub_bagian'])) : ?>
    <span>Sub Bagian: <strong><?= $user['sub_bagian'] ?></strong></span>
  <?php endif; ?>
</div>

    <h3 class="mb-3">Dashboard SIMONEV</h3>
    <div class="row g-4">
      <!-- Box: Total Kegiatan -->
      <div class="col-md-4">
        <div class="card card-box shadow-sm">
          <div class="card-body">
            <h6>Total Kegiatan</h6>
            <h3 class="text-primary">
              <?php
              $kegiatan = mysqli_query($host, "SELECT COUNT(*) as total FROM kegiatan");
              echo mysqli_fetch_assoc($kegiatan)['total'];
              ?>
            </h3>
            <i class="bi bi-journal-text fs-2 text-secondary"></i>
          </div>
        </div>
      </div>

      <!-- Box: Total User -->
      <div class="col-md-4">
        <div class="card card-box shadow-sm">
          <div class="card-body">
            <h6>Jumlah User</h6>
            <h3 class="text-warning">
              <?php
              $userCount = mysqli_query($host, "SELECT COUNT(*) as total FROM users");
              echo mysqli_fetch_assoc($userCount)['total'];
              ?>
            </h3>
            <i class="bi bi-people-fill fs-2 text-secondary"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Info User Login -->
    
  </div>
</div>

<script>
  const toggleBtn = document.getElementById('toggleSidebar');
  const sidebar = document.getElementById('sidebar');

  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    const icon = toggleBtn.querySelector('i');
    icon.classList.toggle('bi-chevron-double-left');
    icon.classList.toggle('bi-chevron-double-right');
  });
</script>

</body>
</html>
