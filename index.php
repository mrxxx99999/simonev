<?php
session_start();
include 'config/koneksi.php';

$errors = [];

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $cek = mysqli_query($host, "SELECT * FROM users WHERE username='$username'");
    $user = mysqli_fetch_assoc($cek);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: admin/dashboard.php");
        exit;
    } else {
        $errors[] = "Username atau password salah.";
    }
}

if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $sub_bagian = in_array($role, ['Ketua Sub Bagian', 'Admin Sub Bagian']) ? $_POST['sub_bagian'] : '';

    $cek = mysqli_query($host, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        $errors[] = "Username sudah digunakan.";
    } else {
        $insert = mysqli_query($host, "INSERT INTO users (nama, username, password, role, sub_bagian)
                    VALUES ('$nama', '$username', '$password', '$role', '$sub_bagian')");
        if ($insert) {
            echo "<script>alert('Registrasi berhasil. Silakan login!'); window.location='index.php';</script>";
        } else {
            $errors[] = "Gagal registrasi: " . mysqli_error($host);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login & Register - SIMONEV</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .container { max-width: 500px; margin-top: 60px; }
    .card { padding: 20px; box-shadow: 0 0 20px rgba(0,0,0,0.1); }
    .toggle-link { cursor: pointer; color: blue; text-decoration: underline; }
  </style>
</head>
<body class="bg-light">

<div class="container">
  <div class="card">
    <h4 class="text-center" id="form-title">Login SIMONEV</h4>

    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger"><?= implode("<br>", $errors); ?></div>
    <?php endif; ?>

    <!-- Login Form -->
    <form method="post" id="login-form">
      <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
    </form>

    <!-- Register Form -->
    <form method="post" id="register-form" style="display: none;">
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
        <select name="role" class="form-control" id="role-select" required onchange="showSubBagian()">
          <option value="">-- Pilih Role --</option>
          <option value="Kepala Kantor">Kepala Kantor</option>
          <option value="Kepala Umum">Kepala Umum</option>
          <option value="Ketua Sub Bagian">Ketua Sub Bagian</option>
          <option value="Admin Sub Bagian">Admin Sub Bagian</option>
        </select>
      </div>
      <div class="mb-3" id="sub-bagian-div" style="display: none;">
        <label>Sub Bagian</label>
        <select name="sub_bagian" class="form-control">
          <option value="">-- Pilih Sub Bagian --</option>
          <option value="Produksi">Produksi</option>
          <option value="Distribusi">Distribusi</option>
          <option value="Sosial">Sosial</option>
          <option value="Neraca">Neraca</option>
          <option value="IPDS">IPDS</option>
          <option value="Umum">Umum</option>
        </select>
      </div>
      <button type="submit" name="register" class="btn btn-success w-100">Daftar</button>
    </form>

    <div class="text-center mt-3">
      <span class="toggle-link" onclick="toggleForm()">Belum punya akun? Daftar di sini</span>
    </div>
  </div>
</div>

<script>
function toggleForm() {
  const loginForm = document.getElementById('login-form');
  const registerForm = document.getElementById('register-form');
  const formTitle = document.getElementById('form-title');
  const toggleText = document.querySelector('.toggle-link');

  if (loginForm.style.display === 'none') {
    loginForm.style.display = 'block';
    registerForm.style.display = 'none';
    formTitle.innerText = 'Login SIMONEV';
    toggleText.innerText = 'Belum punya akun? Daftar di sini';
  } else {
    loginForm.style.display = 'none';
    registerForm.style.display = 'block';
    formTitle.innerText = 'Registrasi Pengguna';
    toggleText.innerText = 'Sudah punya akun? Login di sini';
  }
}

function showSubBagian() {
  const role = document.getElementById('role-select').value;
  const subDiv = document.getElementById('sub-bagian-div');
  if (role === 'Admin Sub Bagian' || role === 'Ketua Sub Bagian') {
    subDiv.style.display = 'block';
  } else {
    subDiv.style.display = 'none';
  }
}
</script>

</body>
</html>
