<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: ../index.php");
    exit;
}
include "../config/koneksi.php";

// Ambil daftar unik KRO dari tabel kegiatan
$kroList = mysqli_query($host, "SELECT DISTINCT kro FROM kegiatan ORDER BY kro ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $kro = $_POST['kro'];
  $nama_kegiatan = $_POST['nama_kegiatan'];
  $detail_kegiatan = $_POST['detail_kegiatan'];
  $penyerapan = $_POST['penyerapan'];
  $progres = $_POST['progres'];
  $pci = $_POST['pci'];

  $simpan = mysqli_query($host, "INSERT INTO kegiatan (kro, nama_kegiatan, detail_kegiatan, penyerapan, progres, pci) 
    VALUES ('$kro', '$nama_kegiatan', '$detail_kegiatan', '$penyerapan', '$progres', '$pci')");

  if ($simpan) {
    header("Location: kegiatan.php");
    exit;
  } else {
    echo "Gagal menyimpan kegiatan: " . mysqli_error($host);
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Kegiatan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .slider-value {
      font-weight: bold;
    }
  </style>
</head>
<body>
<?php include 'layout/sidebar.php'; ?>
<div class="container mt-4">
  <h4 class="mb-4">Tambah Kegiatan</h4>
  <form method="POST">
   <div class="mb-3">
  <label class="form-label">KRO</label>
  <select name="kro" class="form-select" required>
    <option value="">-- Pilih KRO --</option>
    <option value="2896 Pengembangan dan Analisis Statistik">2896 Pengembangan dan Analisis Statistik</option>
    <option value="KRO 2">KRO 2</option>
    <option value="KRO 3">KRO 3</option>
    <option value="KRO 4">KRO 4</option>
    <option value="KRO 5">KRO 5</option>
    <option value="KRO 6">KRO 6</option>
    <option value="KRO 7">KRO 7</option>
    <option value="KRO 8">KRO 8</option>
    <option value="KRO 9">KRO 9</option>
    <option value="KRO 10">KRO 10</option>
    <option value="KRO 11">KRO 11</option>
    <option value="KRO 12">KRO 12</option>
    <option value="KRO 13">KRO 13</option>
    <option value="KRO 14">KRO 14</option>
    <option value="KRO 15">KRO 15</option>
    <option value="KRO 16">KRO 16</option>
    <option value="KRO 17">KRO 17</option>
    <option value="KRO 18">KRO 18</option>
    <option value="KRO 19">KRO 19</option>
    <option value="KRO 20">KRO 20</option>
    <option value="KRO 21">KRO 21</option>
    <option value="KRO 22">KRO 22</option>
    <option value="KRO 23">KRO 23</option>
    <option value="KRO 24">KRO 24</option>
    <option value="KRO 25">KRO 25</option>
    <option value="KRO 26">KRO 26</option>
    <option value="KRO 27">KRO 27</option>
    <option value="KRO 28">KRO 28</option>
    <option value="KRO 29">KRO 29</option>
    <option value="KRO 30">KRO 30</option>
  </select>
</div>


    <div class="mb-3">
      <label class="form-label">Nama Kegiatan</label>
      <input type="text" name="nama_kegiatan" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Detail Kegiatan</label>
      <textarea name="detail_kegiatan" class="form-control" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Penyerapan Anggaran</label>
      <div class="input-group">
        <span class="input-group-text">Rp</span>
        <input type="number" name="penyerapan" class="form-control" min="0" required>
        <span class="input-group-text">Juta</span>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Progres Kegiatan</label>
      <input type="range" name="progres" class="form-range" min="0" max="100" value="0" id="progresRange" oninput="updateProgresValue(this.value)">
      <span class="slider-value" id="progresValue">0%</span>
    </div>

    <div class="mb-3">
      <label class="form-label">Sub Bagian (PCI)</label>
      <select name="pci" class="form-select" required>
        <option value="">-- Pilih Sub Bagian --</option>
        <option value="Produksi">Produksi</option>
        <option value="Distribusi">Distribusi</option>
        <option value="Nerwilis">Nerwilis</option>
        <option value="Sosial">Sosial</option>
        <option value="IPDS">IPDS</option>
        <option value="Umum">Umum</option>
      </select>
    </div>

    <div class="d-flex justify-content-between">
      <button class="btn btn-primary">Simpan</button>
      <a href="kegiatan.php" class="btn btn-secondary">Batal</a>
    </div>
  </form>
</div>

<script>
function updateProgresValue(val) {
  document.getElementById('progresValue').innerText = val + '%';
}
</script>
</body>
</html>
