<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit;
}
include "../config/koneksi.php";

// Pagination
$batas = 10;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman - 1) * $batas;

// Pencarian
$search = isset($_GET['search']) ? mysqli_real_escape_string($host, $_GET['search']) : '';
$where = $search ? "WHERE kro LIKE '%$search%' OR nama_kegiatan LIKE '%$search%'" : '';

$queryTotal = mysqli_query($host, "SELECT COUNT(*) as total FROM kegiatan $where");
$totalData = mysqli_fetch_assoc($queryTotal)['total'];
$totalHalaman = ceil($totalData / $batas);

// Ambil data
$query = mysqli_query($host, "SELECT * FROM kegiatan $where ORDER BY id DESC LIMIT $halaman_awal, $batas");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Kegiatan - SIMONEV</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include 'layout/sidebar.php'; ?>
<div class="container mt-4">
  <div class="card shadow">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Daftar Kegiatan</h5>
      <a href="kegiatan_tambah.php" class="btn btn-light btn-sm"><i class="bi bi-plus-circle"></i> Tambah Kegiatan</a>
    </div>
    <div class="card-body">
      <!-- Search -->
      <form class="row mb-3" method="GET">
        <div class="col-md-4">
          <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" class="form-control" placeholder="Cari kegiatan...">
        </div>
        <div class="col-md-2">
          <button class="btn btn-secondary" type="submit"><i class="bi bi-search"></i> Cari</button>
        </div>
      </form>

      <!-- Table -->
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>KRO</th>
              <th>Nama Kegiatan</th>
              <th>Detail Kegiatan</th>
              <th>Penyerapan Anggaran</th>
              <th>Progres</th>
              <th>PCI</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = $halaman_awal + 1;
            while ($row = mysqli_fetch_assoc($query)):
              $progres = intval($row['progres']);
              $warna = 'bg-success';
              if ($progres < 40) $warna = 'bg-danger';
              elseif ($progres < 70) $warna = 'bg-warning';
            ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($row['kro']) ?></td>
              <td><?= htmlspecialchars($row['nama_kegiatan']) ?></td>
              <td><?= htmlspecialchars($row['detail_kegiatan']) ?></td>
              <td><?= htmlspecialchars($row['penyerapan']) ?></td>
              <td>
                <div class="progress" style="height: 20px;">
                  <div class="progress-bar <?= $warna ?>" role="progressbar" style="width: <?= max($progres, 5) ?>%; min-width: 40px;">
                    <strong style="color:white"><?= $progres ?>%</strong>
                  </div>
                </div>
              </td>
              <td><?= htmlspecialchars($row['pci']) ?></td>
              <td>
                <a href="kegiatan_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                <a href="kegiatan_hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus kegiatan ini?')"><i class="bi bi-trash"></i></a>
              </td>
            </tr>
            <?php endwhile; ?>
            <?php if ($totalData == 0): ?>
              <tr><td colspan="8" class="text-center">Data tidak ditemukan.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <nav>
        <ul class="pagination justify-content-center">
          <?php for ($i = 1; $i <= $totalHalaman; $i++): ?>
            <li class="page-item <?= ($i == $halaman) ? 'active' : '' ?>">
              <a class="page-link" href="?halaman=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
            </li>
          <?php endfor; ?>
        </ul>
      </nav>

      <!-- Export Buttons -->
      <div class="mt-3 text-end">
        <a href="export_kegiatan_excel.php" class="btn btn-success btn-sm"><i class="bi bi-file-earmark-excel"></i> Export Excel</a>
        <a href="export_kegiatan_pdf.php" class="btn btn-danger btn-sm"><i class="bi bi-file-earmark-pdf"></i> Export PDF</a>
        <a href="dashboard.php" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Kembali</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
