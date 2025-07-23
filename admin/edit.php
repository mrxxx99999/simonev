<?php
include("../config/koneksi.php");      // akses ke config di luar admin
include("layout/sidebar.php"); 

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($host, "SELECT * FROM users WHERE id = $id"));

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    $sub_bagian = $_POST['sub_bagian'];

    // Password hanya diubah jika diisi
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        mysqli_query($host, "UPDATE users SET nama='$nama', username='$username', password='$password', role='$role', sub_bagian='$sub_bagian' WHERE id=$id");
    } else {
        mysqli_query($host, "UPDATE users SET nama='$nama', username='$username', role='$role', sub_bagian='$sub_bagian' WHERE id=$id");
    }

    header("Location: index.php");
}
?>

<div class="container mt-4">
    <h3>Edit User</h3>
    <form method="POST">
        <div class="mb-2">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
        </div>
        <div class="mb-2">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?= $data['username'] ?>" required>
        </div>
        <div class="mb-2">
            <label>Password (biarkan kosong jika tidak diubah)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-2">
            <label>Role</label>
            <select name="role" class="form-control" id="roleSelect" required onchange="toggleSubBagian()">
                <option value="Kepala Kantor" <?= $data['role'] == 'Kepala Kantor' ? 'selected' : '' ?>>Kepala Kantor</option>
                <option value="Kepala Umum" <?= $data['role'] == 'Kepala Umum' ? 'selected' : '' ?>>Kepala Umum</option>
                <option value="Ketua Sub Bagian" <?= $data['role'] == 'Ketua Sub Bagian' ? 'selected' : '' ?>>Ketua Sub Bagian</option>
                <option value="Admin Sub Bagian" <?= $data['role'] == 'Admin Sub Bagian' ? 'selected' : '' ?>>Admin Sub Bagian</option>
            </select>
        </div>
        <div class="mb-3" id="subBagianField">
            <label>Sub Bagian</label>
            <select name="sub_bagian" class="form-control" id="subBagianSelect">
                <option value="">-- Pilih Sub Bagian --</option>
                <?php
                $sub_bagians = ["Distribusi", "Produksi", "Nerwilis", "Sosial", "IPDS", "Umum"];
                foreach ($sub_bagians as $sb) {
                    echo "<option value='$sb' " . ($data['sub_bagian'] == $sb ? 'selected' : '') . ">$sb</option>";
                }
                ?>
            </select>
        </div>
        <button class="btn btn-success" name="update">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
function toggleSubBagian() {
    const role = document.getElementById('roleSelect').value;
    const subBagianDiv = document.getElementById('subBagianField');
    const subBagianSelect = document.getElementById('subBagianSelect');

    if (role === 'Kepala Kantor' || role === 'Kepala Umum') {
        subBagianDiv.style.display = 'none';
        subBagianSelect.removeAttribute('required');
        subBagianSelect.value = '';
    } else {
        subBagianDiv.style.display = 'block';
        subBagianSelect.setAttribute('required', 'required');
    }
}

// Jalankan saat pertama kali halaman dibuka
document.addEventListener('DOMContentLoaded', toggleSubBagian);
</script>
