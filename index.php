<?php
session_start();
$error = '';
require_once('connection.php');
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    if(empty($email)|| empty($pass)) {
        $_SESSION['error'] = "Пожалуйста, заполните все поля.";
        header("Location: index.php");
        exit();
    } else {
        $query="SELECT * FROM users WHERE EMAIL='$email'";
        $res=mysqli_query($con,$query);
        if($row=mysqli_fetch_assoc($res)){
            $db_password = $row['PASSWORD'];
            if(md5($pass) == $db_password) {
                $_SESSION['email'] = $email;
                header("Location: cardetails.php");
                exit();
            } else {
                $_SESSION['error'] = "Неверный пароль.";
                header("Location: index.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Такой email не зарегистрирован.";
            header("Location: index.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>АРЕНДА АВТО</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for eye icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,500&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            font-family: 'Montserrat', Arial, sans-serif;
            background: linear-gradient(120deg, #1a2980 0%, #26d0ce 100%);
        }
        .glass-card {
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            box-shadow: 0 8px 36px rgba(30,144,255,0.14);
        }
        .navbar-brand {
            font-weight: 800;
            letter-spacing: 2px;
            font-size: 2rem;
            color: #1876f2 !important;
        }
        .form-label {
            color: #23395d;
            font-weight: 600;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.18rem rgba(24, 118, 242, 0.18);
            border-color: #1e90ff;
        }
        .form-link {
            font-size: 0.99rem;
            color: #222;
            text-align: center;
        }
        .btn-outline-primary {
            font-weight: 600;
            border-radius: 18px;
            padding: 5px 22px;
        }
        .btn-primary {
            border-radius: 18px;
            font-weight: 700;
            padding: 9px 0;
            font-size: 1.07rem;
        }
        .reg-btn-small {
            margin-bottom: 18px;
        }
        @media (max-width: 576px) {
            .glass-card { padding: 2rem 0.7rem; }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">CaRs</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbars" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbars">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-2">
                    <!-- <li class="nav-item"><a class="nav-link" href="#">ГЛАВНАЯ</a></li>
                    <li class="nav-item"><a class="nav-link" href="aboutus.html">О НАС</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">СЕРВИСЫ</a></li>
                    <li class="nav-item"><a class="nav-link" href="contactus.html">КОНТАКТЫ</a></li> -->
                    <li class="nav-item"><a class="btn btn-outline-primary ms-2" href="adminlogin.php">АДМИН-ВХОД</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Сообщение об ошибке -->
    <?php if (!empty($error)): ?>
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($error) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php endif; ?>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
        <div class="glass-card p-4 px-4 px-md-5 col-12 col-sm-10 col-md-7 col-lg-5">
            <h2 class="mb-3 text-center fw-bold" style="color:#1876f2;">Арендуйте <span style="color:#ffd56c;">Автомобиль Мечты</span></h2>
            <p class="text-center mb-3" style="color:#234;">Выберите авто из коллекции и наслаждайтесь поездкой. Легко, быстро, удобно!</p>
            <!-- Регистрация: кнопка маленькая и неяркая -->
            <div class="text-center reg-btn-small">
                <a href="register.php" class="btn btn-outline-primary btn-sm">Регистрация</a>
            </div>
            <form method="POST" autocomplete="off">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control shadow-sm" id="email" name="email" placeholder="Введите email" required>
                </div>
                <div class="mb-2 position-relative">
                    <label for="pass" class="form-label">Пароль</label>
                    <input type="password" class="form-control shadow-sm" id="pass" name="pass" placeholder="Введите пароль" required>
                    <span class="position-absolute top-50 end-0 translate-middle-y me-3"
                        style="cursor:pointer; color:#bbb; font-size:1.13rem;"
                        onclick="togglePassword()">
                        <i id="eyeIcon" class="fa-regular fa-eye"></i>
                    </span>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-2" name="login">Войти</button>
            </form>
            <div class="form-link mt-2">
                Нет аккаунта? <a href="register.php" style="color:#1876f2;">Зарегистрируйтесь</a>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function togglePassword() {
        const passInput = document.getElementById('pass');
        const eyeIcon = document.getElementById('eyeIcon');
        if (passInput.type === "password") {
            passInput.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passInput.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
    </script>
</body>
</html>
