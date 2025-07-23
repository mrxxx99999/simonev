<?php
include("../config/koneksi.php");      // akses ke config di luar admin
include("layout/sidebar.php"); 

// Proses simpan
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $sub_bagian = ($_POST['role'] == 'Kepala Kantor' || $_POST['role'] == 'Kepala Umum') ? NULL : $_POST['sub_bagian'];

    mysqli_query($host, "INSERT INTO users (nama, username, password, role, sub_bagian) 
        VALUES ('$nama', '$username', '$password', '$role', '$sub_bagian')");

    header("Location: index.php");
}
?>

<div class="container mt-4">
    <h3>Tambah User</h3>
    <form method="POST">
        <div class="mb-2">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Role</label>
            <select name="role" id="role" class="form-control" required onchange="toggleSubBagian()">
                <option value="">-- Pilih Role --</option>
                <option value="Kepala Kantor">Kepala Kantor</option>
                <option value="Kepala Umum">Kepala Umum</option>
                <option value="Ketua Sub Bagian">Ketua Sub Bagian</option>
                <option value="Admin Sub Bagian">Admin Sub Bagian</option>
            </select>
        </div>
        <div class="mb-3" id="subBagianGroup" style="display: none;">
            <label>Sub Bagian</label>
            <select name="sub_bagian" class="form-control">
                <option value="">-- Pilih Sub Bagian --</option>
                <option value="Distribusi">Distribusi</option>
                <option value="Produksi">Produksi</option>
                <option value="Nerwilis">Nerwilis</option>
                <option value="Sosial">Sosial</option>
                <option value="IPDS">IPDS</option>
                <option value="Umum">Umum</option>
            </select>
        </div>
        <button class="btn btn-primary" name="simpan">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
function toggleSubBagian() {
    const role = document.getElementById("role").value;
    const subBagianGroup = document.getElementById("subBagianGroup");

    if (role === "Ketua Sub Bagian" || role === "Admin Sub Bagian") {
        subBagianGroup.style.display = "block";
    } else {
        subBagianGroup.style.display = "none";
    }
}
</script>
