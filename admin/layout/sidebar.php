<!-- sidebar.php -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
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

<!-- layout/sidebar.php -->
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
