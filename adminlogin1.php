<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход администратора | CaRs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(110deg, #163fa3 0%, #10d6ef 100%);
            font-family: 'Montserrat', Arial, sans-serif;
            display: flex;
            flex-direction: column;
        }
        .top-nav {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 22px 38px 10px 0;
        }
        .back-btn {
            background: linear-gradient(90deg, #1179ff 0%, #23d0ed 100%);
            color: #fff;
            padding: 11px 28px;
            border: none;
            border-radius: 15px;
            font-size: 1.06rem;
            font-weight: 700;
            box-shadow: 0 2px 12px #0099ff1a;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.13s;
        }
        .back-btn:hover {
            background: linear-gradient(90deg, #199aff 0%, #156af7 100%);
            color: #fff;
        }
        .admin-greeting {
            text-align: center;
            font-size: 2.3rem;
            font-weight: 900;
            letter-spacing: 1px;
            margin: 22px 0 0 0;
            color: #fff;
            background: linear-gradient(90deg, #1d79fa 0%, #ffe186 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .admin-form-card {
            background: #fff;
            max-width: 380px;
            margin: 32px auto 0 auto;
            border-radius: 26px;
            box-shadow: 0 6px 32px #11a7e63c;
            padding: 36px 30px 28px 30px;
            display: flex;
            flex-direction: column;
            gap: 19px;
        }
        .admin-form-card h2 {
            color: #156af7;
            margin: 0 0 13px 0;
            text-align: center;
            font-weight: 900;
            font-size: 1.47rem;
            letter-spacing: 1px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .form-group label {
            font-weight: 600;
            color: #156af7;
            font-size: 1rem;
        }
        .form-group input {
            border: 1.1px solid #e5edfa;
            border-radius: 11px;
            padding: 11px 13px;
            font-size: 1.01rem;
            background: #f3f9fd;
            color: #17487b;
            outline: none;
            transition: border 0.14s;
        }
        .form-group input:focus {
            border: 1.2px solid #199aff;
            background: #fff;
        }
        .admin-btn {
            padding: 13px 0;
            background: linear-gradient(90deg, #1179ff 0%, #23d0ed 100%);
            color: #fff;
            font-size: 1.17rem;
            font-weight: 700;
            border: none;
            border-radius: 13px;
            cursor: pointer;
            margin-top: 12px;
            box-shadow: 0 2px 13px #09b6ff1b;
            transition: background 0.13s;
        }
        .admin-btn:hover {
            background: linear-gradient(90deg, #19b6ff 0%, #156af7 100%);
            color: #fff;
        }
        .form-link {
            text-align: center;
            font-size: 1rem;
            color: #4971aa;
            margin-top: 14px;
        }
        @media (max-width: 480px) {
            .admin-form-card { padding: 18px 3vw 18px 3vw; }
            .top-nav { padding: 14px 5vw 5px 0; }
            .admin-greeting { font-size: 1.2rem; margin-top: 9px;}
        }
        .toggle-pass svg {
    vertical-align: middle;
    transition: opacity 0.14s;
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
<?php
    require_once('connection.php');
    if(isset($_POST['adlog'])){
        $id=$_POST['adid'];
        $pass=$_POST['adpass'];
        if(empty($id)|| empty($pass)) {
            echo '<script>alert("Пожалуйста, заполните все поля.")</script>';
        } else {
            $query="SELECT * FROM admin WHERE ADMIN_ID='$id'";
            $res=mysqli_query($con,$query);
            if($row=mysqli_fetch_assoc($res)){
                $db_password = $row['ADMIN_PASSWORD'];
                if($pass == $db_password) {
                    // header должен быть до вывода
                    header("Location: admindash.php");
                    exit;
                } else {
                    echo '<script>alert("Неверный пароль")</script>';
                }
            } else {
                echo '<script>alert("Неверный логин администратора")</script>';
            }
        }
    }
?>
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
    <span class="toggle-pass" onclick="togglePassword()" style="position: absolute; right: 16px; top: 38px; cursor:pointer;">
      <!-- SVG Глаз (открытый) -->
      <svg id="eye-open" width="24" height="24" viewBox="0 0 24 24" fill="none">
        <path d="M12 5C7 5 2.73 8.11 1 12C2.73 15.89 7 19 12 19C17 19 21.27 15.89 23 12C21.27 8.11 17 5 12 5Z"
          stroke="#156af7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <circle cx="12" cy="12" r="3.5" stroke="#156af7" stroke-width="2"/>
      </svg>
      <!-- SVG Глаз (закрытый), скрыт по умолчанию -->
      <svg id="eye-closed" width="24" height="24" viewBox="0 0 24 24" fill="none" style="display:none;">
        <path d="M3 3L21 21" stroke="#156af7" stroke-width="2" stroke-linecap="round"/>
        <path d="M17.94 17.94C16.13 19.26 14.12 20 12 20C7 20 2.73 16.11 1 12C1.8 10.18 3.07 8.6 4.75 7.37M9.5 9.5C10.14 9.19 10.83 9 11.58 9C13.88 9 15.58 11.09 15.58 12.93C15.58 13.68 15.39 14.37 15.08 15.01M5 5C2.73 7.18 1 9.51 1 12C1 16.11 5.27 20 12 20C14.12 20 16.13 19.26 17.94 17.94"
          stroke="#156af7" stroke-width="2" stroke-linecap="round"/>
      </svg>
    </span>
</div>
        <button type="submit" class="admin-btn" name="adlog">Войти</button>
        <!-- <div class="form-link">
            <a href="index.php" style="color:#199aff; text-decoration:underline;">Вернуться на сайт</a>
        </div> -->
    </form>
</body>
</html>
