<?php session_start(); 

// jika sudah login wajib logout terlebih dahulu
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login apps iuran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- css login -->
    <style>
        body {
            background: linear-gradient(135deg, #0d6efd, #0dcaf0);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 380px;
            padding: 30px;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .login-title {
            font-weight: 600;
            text-align: center;
            margin-bottom: 10px;
        }

        .login-subtitle {
            font-size: 14px;
            color: #6c757d;
            text-align: center;
            margin-bottom: 25px;
        }

        .form-control {
            border-radius: 10px;
            padding-left: 40px;
        }
        
        .input-group-text {
            background: transparent;
            border-right: 0;
        }

        .from-control:focus {
            box-shadow: none;
            border-color: #0d6efd;
        }

        .btn-login {
            border-radius: 10px;
            font-weight: 500;
        }

        .logo {
            font-size: 40px;
            text-align: center;
            color: #0d6efd;
            margin-bottom: 10px;
        }

    </style>
</head>

<body>
<div class="login-card">
    <div class="logo">
        <i class="bi bi-mortarboard-fill"></i>
    </div>

    <h5 class="login-title">Sistem Informasi Iuran Sekolah</h5>
    <div class="login-subtitle">Silahkan login untuk melanjutkan</div>

    <!-- alert -->
     <?php if (isset($_SESSION['error'])) : ?>
        <div class="alert alert-danger text-center p-2">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <form action="cekLogin.php" method="post">

    <!-- Username -->
     <div class="mb-3 input-group">
        <span class="input-group-text"><i class="bi bi-person"></i></span>
        <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
     </div>

     <!-- Password -->
      <div class="mb-3 input-group">
        <span class="input-group-text"><i class="bi bi-lock"></i></span>
        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
        <!-- membuat eye password -->
        <span class="input-group-text" onclick="togglePassword()" style="cursor:pointer;"><i class="bi bi-eye" id="iconEye"></i></span>
      </div>

      <!-- button -->
       <button class="btn btn-primary w-100 btn-login" type="submit">
        <i class="bi bi-box-arrow-in-right"></i> Login
       </button>

    </form>
</div>

<!-- script java untuk aktifkan eye password -->
<script>
    function togglePassword () {
        const p = document.getElementById("password");
        const icon = document.getElementById("iconEye");

       if (p.type === "password") {
        p.type = "text";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
       } else {
        p.type = "password";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
       }
    }
</script>

</body>


</html>