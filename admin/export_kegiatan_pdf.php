<?php
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

include "../config/koneksi.php";

// Header PDF
$html = '<h3 style="text-align:center;">Laporan Data Kegiatan SIMONEV</h3>';
$html .= '<table border="1" cellpadding="5" cellspacing="0" width="100%">
<thead>
<tr>
    <th>No</th>
    <th>KRO</th>
    <th>Nama Kegiatan</th>
    <th>Detail Kegiatan</th>
    <th>Penyerapan</th>
    <th>Progres (%)</th>
    <th>PCI</th>
</tr>
</thead>
<tbody>';

// Ambil data dari tabel kegiatan
$no = 1;
$query = mysqli_query($host, "SELECT * FROM kegiatan ORDER BY id DESC");
while ($row = mysqli_fetch_assoc($query)) {
    $html .= '<tr>
        <td>' . $no++ . '</td>
        <td>' . htmlspecialchars($row['kro']) . '</td>
        <td>' . htmlspecialchars($row['nama_kegiatan']) . '</td>
        <td>' . htmlspecialchars($row['detail_kegiatan']) . '</td>
        <td>' . htmlspecialchars($row['penyerapan']) . '</td>
        <td>' . htmlspecialchars($row['progres']) . '</td>
        <td>' . htmlspecialchars($row['pci']) . '</td>
    </tr>';
}

$html .= '</tbody></table>';

// Inisialisasi Dompdf
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

// Output PDF
$dompdf->stream("laporan_kegiatan.pdf", array("Attachment" => false));
exit;
