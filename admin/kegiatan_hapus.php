<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: ../login.php");
    exit;
}

// Cek role yang diperbolehkan
$allowed_roles = ['admin', 'Kepala Kantor', 'Kepala Umum', 'Ketua Sub Bagian', 'Admin Sub Bagian'];
if (!in_array($_SESSION['role'], $allowed_roles)) {
    echo "Anda tidak memiliki izin untuk menghapus data.";
    exit;
}

include "../config/koneksi.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = mysqli_query($host, "DELETE FROM kegiatan WHERE id = $id");

    if ($query) {
        header("Location: kegiatan.php");
        exit;
    } else {
        echo "Gagal menghapus kegiatan. Error: " . mysqli_error($host);
    }
} else {
    echo "ID tidak valid.";
}
?>
