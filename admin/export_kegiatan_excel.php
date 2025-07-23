<?php
include "../config/koneksi.php";

// Set header untuk file Excel
header("Content-Type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Kegiatan_SIMONEV.xls");

// Buat tabel
echo "<table border='1'>
<tr>
  <th>No</th>
  <th>KRO</th>
  <th>Nama Kegiatan</th>
  <th>Detail Kegiatan</th>
  <th>Penyerapan</th>
  <th>Progres</th>
  <th>PCI</th>
</tr>";

$no = 1;
$data = mysqli_query($host, "SELECT * FROM kegiatan ORDER BY id DESC");
while ($row = mysqli_fetch_assoc($data)) {
    echo "<tr>
      <td>{$no}</td>
      <td>{$row['kro']}</td>
      <td>{$row['nama_kegiatan']}</td>
      <td>{$row['detail_kegiatan']}</td>
      <td>{$row['penyerapan']}</td>
      <td>{$row['progres']}</td>
      <td>{$row['pci']}</td>
    </tr>";
    $no++;
}
echo "</table>";
?>
