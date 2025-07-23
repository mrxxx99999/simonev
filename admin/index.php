<?php
include("../config/koneksi.php");      // akses ke config di luar admin
include("layout/sidebar.php");        // akses ke layout di dalam admin
?>

<div class="container mt-4">
    <h3>Manajemen User</h3>
    <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah User</a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th>Sub Bagian</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($host, "SELECT * FROM users");
            $no = 1;
            while ($data = mysqli_fetch_assoc($query)) :
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($data['nama']) ?></td>
                    <td><?= htmlspecialchars($data['username']) ?></td>
                    <td><?= htmlspecialchars($data['role']) ?></td>
                    <td><?= htmlspecialchars($data['sub_bagian']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $data['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="hapus.php?id=<?= $data['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus user ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
