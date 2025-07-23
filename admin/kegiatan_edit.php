<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: ../index.php");
    exit;
}
include "../config/koneksi.php";

// Validasi ID kegiatan
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
$data = mysqli_query($host, "SELECT * FROM kegiatan WHERE id='$id'");
$kegiatan = mysqli_fetch_assoc($data);

if (!$kegiatan) {
    echo "Data kegiatan tidak ditemukan.";
    exit;
}

// Daftar opsi PCI manual (karena tidak ada tabel pci)
$pciOptions = ['Produksi', 'Distribusi', 'Nerwilis', 'Sosial', 'IPDS', 'Umum'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kro = mysqli_real_escape_string($host, $_POST['kro']);
    $nama = mysqli_real_escape_string($host, $_POST['nama_kegiatan']);
    $detail = mysqli_real_escape_string($host, $_POST['detail_kegiatan']);
    $penyerapan = intval($_POST['penyerapan']);
    $progres = intval($_POST['progres']);
    $pci = mysqli_real_escape_string($host, $_POST['pci']);

    // Update data
    $update = mysqli_query($host, "UPDATE kegiatan SET 
        kro='$kro',
        nama_kegiatan='$nama',
        detail_kegiatan='$detail',
        penyerapan='$penyerapan',
        progres='$progres',
        pci='$pci'
        WHERE id='$id'");

    if ($update) {
        header("Location: kegiatan.php");
        exit;
    } else {
        echo "Gagal update kegiatan: " . mysqli_error($host);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Kegiatan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
  <div class="card shadow p-4">
    <h4 class="mb-4">Edit Kegiatan</h4>
    <form method="POST">
      <div class="mb-3">
        <label class="form-label">KRO</label>
        <input type="text" name="kro" value="<?= htmlspecialchars($kegiatan['kro']) ?>" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Nama Kegiatan</label>
        <input type="text" name="nama_kegiatan" value="<?= htmlspecialchars($kegiatan['nama_kegiatan']) ?>" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Detail Kegiatan</label>
        <textarea name="detail_kegiatan" class="form-control" required><?= htmlspecialchars($kegiatan['detail_kegiatan']) ?></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Penyerapan Anggaran (Rp)</label>
        <input type="number" name="penyerapan" value="<?= htmlspecialchars($kegiatan['penyerapan']) ?>" class="form-control" min="0" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Progres Kegiatan (%)</label>
        <input type="range" name="progres" min="0" max="100" value="<?= intval($kegiatan['progres']) ?>" class="form-range" id="progresRange">
        <div>Progres: <span id="rangeValue"><?= intval($kegiatan['progres']) ?></span>%</div>
      </div>
      <div class="mb-3">
        <label class="form-label">PCI</label>
        <select name="pci" class="form-select" required>
          <option value="">-- Pilih PCI --</option>
          <?php foreach ($pciOptions as $option) : ?>
            <option value="<?= $option ?>" <?= ($kegiatan['pci'] === $option) ? 'selected' : '' ?>>
              <?= $option ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="d-flex justify-content-between">
        <button class="btn btn-warning">Update</button>
        <a href="kegiatan.php" class="btn btn-secondary">Batal</a>
      </div>
    </form>
  </div>
</div>

<script>
  const range = document.getElementById('progresRange');
  const rangeValue = document.getElementById('rangeValue');
  range.addEventListener('input', () => {
    rangeValue.textContent = range.value;
  });
</script>
</body>
</html>
