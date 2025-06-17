<?php
require_once('connection.php');
$errorMsg = '';

if (isset($_POST['adlog'])) {
    $id = $_POST['adid'];
    $pass = $_POST['adpass'];

    if (empty($id) || empty($pass)) {
        $errorMsg = "Пожалуйста, заполните все поля.";
    } else {
        $query = "SELECT * FROM admin WHERE ADMIN_ID='$id'";
        $res = mysqli_query($con, $query);
        if ($row = mysqli_fetch_assoc($res)) {
            if ($pass == $row['ADMIN_PASSWORD']) {
                header("Location: admindash.php");
                exit();
            } else {
                $errorMsg = "Неверный пароль.";
            }
        } else {
            $errorMsg = "Неверный логин администратора.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Вход администратора | CaRs</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(120deg, #1a2980, #26d0ce);
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .top-nav {
      display: flex;
      justify-content: flex-end;
      padding: 20px 40px 0 0;
    }

    .back-btn {
      background: #ffffff20;
      border: 2px solid #ffffff40;
      color: #fff;
      padding: 10px 24px;
      border-radius: 12px;
      font-weight: 600;
      text-decoration: none;
      transition: 0.2s ease;
    }

    .back-btn:hover {
      background: #ffffff40;
    }

    .admin-greeting {
      text-align: center;
      font-size: 2.4rem;
      font-weight: 800;
      color: #fff;
      margin: 25px 0 10px;
      letter-spacing: 1px;
    }

    .admin-form-card {
      background: #fff;
      width: 100%;
      max-width: 400px;
      margin: 20px auto;
      padding: 32px 26px;
      border-radius: 20px;
      box-shadow: 0 12px 28px rgba(0, 0, 0, 0.2);
    }

    .admin-form-card h2 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 1.6rem;
      color: #156af7;
    }

    .form-group {
      margin-bottom: 16px;
    }

    .form-group label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      color: #156af7;
    }

    .form-group input {
      width: 100%;
      padding: 10px 12px;
      border-radius: 10px;
      border: 1.2px solid #d0dffb;
      background: #f3f8ff;
      font-size: 1rem;
      color: #133c66;
      transition: 0.2s ease;
    }

    .form-group input:focus {
      border-color: #156af7;
      background: #fff;
      outline: none;
    }

    .toggle-pass {
      position: absolute;
      right: 14px;
      top: 38px;
      cursor: pointer;
    }

    .toggle-pass svg {
      vertical-align: middle;
    }

    .admin-btn {
      width: 100%;
      padding: 12px;
      font-size: 1.1rem;
      font-weight: 700;
      background: linear-gradient(to right, #1179ff, #23d0ed);
      border: none;
      border-radius: 10px;
      color: #fff;
      cursor: pointer;
      transition: background 0.2s ease;
    }

    .admin-btn:hover {
      background: linear-gradient(to right, #0e63e5, #1bbfe3);
    }

    .error-msg {
      margin-top: 15px;
      color: #e74c3c;
      font-weight: 600;
      text-align: center;
    }

    @media (max-width: 480px) {
      .admin-greeting { font-size: 1.4rem; }
      .admin-form-card { margin: 14px; padding: 22px; }
    }
  </style>
</head>
<script>
function togglePassword() {
    const input = document.getElementById('adpass');
    const eyeOpen = document.getElementById('eye-open');
    const eyeClosed = document.getElementById('eye-closed');
    if (input.type === "password") {
        input.type = "text";
        eyeOpen.style.display = "none";
        eyeClosed.style.display = "block";
    } else {
        input.type = "password";
        eyeOpen.style.display = "block";
        eyeClosed.style.display = "none";
    }
}
</script>
<body>
  <div class="top-nav">
    <a class="back-btn" href="index.php">← На главную</a>
  </div>

  <div class="admin-greeting">ПРИВЕТ, АДМИН!</div>

  <form class="admin-form-card" method="POST" autocomplete="off">
    <h2>Вход для администратора</h2>

    <div class="form-group">
      <label for="adid">Логин администратора</label>
      <input type="text" name="adid" id="adid" placeholder="Введите логин" required>
    </div>

    <div class="form-group" style="position: relative;">
      <label for="adpass">Пароль</label>
      <input type="password" name="adpass" id="adpass" placeholder="Введите пароль" required>
      <span class="toggle-pass" onclick="togglePassword()">
        <!-- SVG open -->
        <svg id="eye-open" width="24" height="24" viewBox="0 0 24 24" fill="none">
          <path d="M12 5C7 5 2.73 8.11 1 12C2.73 15.89 7 19 12 19C17 19 21.27 15.89 23 12C21.27 8.11 17 5 12 5Z" stroke="#156af7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <circle cx="12" cy="12" r="3.5" stroke="#156af7" stroke-width="2"/>
        </svg>
        <!-- SVG closed -->
        <svg id="eye-closed" width="24" height="24" viewBox="0 0 24 24" fill="none" style="display:none;">
          <path d="M3 3L21 21" stroke="#156af7" stroke-width="2" stroke-linecap="round"/>
          <path d="M17.94 17.94C16.13 19.26 14.12 20 12 20C7 20 2.73 16.11 1 12C1.8 10.18 3.07 8.6 4.75 7.37M9.5 9.5C10.14 9.19 10.83 9 11.58 9C13.88 9 15.58 11.09 15.58 12.93C15.58 13.68 15.39 14.37 15.08 15.01M5 5C2.73 7.18 1 9.51 1 12C1 16.11 5.27 20 12 20C14.12 20 16.13 19.26 17.94 17.94" stroke="#156af7" stroke-width="2" stroke-linecap="round"/>
        </svg>
      </span>
    </div>

    <button type="submit" class="admin-btn" name="adlog">Войти</button>

    <?php if (!empty($errorMsg)): ?>
      <div class="error-msg"><?php echo $errorMsg; ?></div>
    <?php endif; ?>
  </form>
</body>
</html>
