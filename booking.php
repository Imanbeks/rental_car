<?php
require_once('connection.php');
session_start();

$carid = $_GET['id'];
$sql = "SELECT * FROM cars WHERE CAR_ID='$carid'";
$carRow = mysqli_query($con, $sql);
$car = mysqli_fetch_assoc($carRow);

$value = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE EMAIL='$value'";
$name = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($name);
$uemail = $user['EMAIL'];
$carprice = $car['PRICE'];

$error = '';
if (isset($_POST['book'])) {
    $bplace = mysqli_real_escape_string($con, $_POST['place']);
    $bdate = date('Y-m-d', strtotime($_POST['date']));
    $dur = mysqli_real_escape_string($con, $_POST['dur']);
    $phno = mysqli_real_escape_string($con, $_POST['ph']);
    $des = mysqli_real_escape_string($con, $_POST['des']);
    $rdate = date('Y-m-d', strtotime($_POST['rdate']));

    if (empty($bplace) || empty($bdate) || empty($dur) || empty($phno) || empty($des) || empty($rdate)) {
        $error = 'Пожалуйста, заполните все поля.';
    } else {
        if ($bdate < $rdate) {
            $price = ($dur * $carprice);
            $sql = "INSERT INTO booking (CAR_ID,EMAIL,BOOK_PLACE,BOOK_DATE,DURATION,PHONE_NUMBER,DESTINATION,PRICE,RETURN_DATE)
                    VALUES($carid,'$uemail','$bplace','$bdate',$dur,'$phno','$des',$price,'$rdate')";
            $result = mysqli_query($con, $sql);

            if ($result) {
                $_SESSION['email'] = $uemail;
                header("Location: payment.php");
                exit();
            } else {
                $error = 'Ошибка соединения с базой.';
            }
        } else {
            $error = 'Дата возврата должна быть позже даты бронирования!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Бронирование авто</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,500&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #1a2980 0%, #26d0ce 100%);
            min-height: 100vh;
            font-family: 'Montserrat', Arial, sans-serif;
        }
        .navbar-brand {
            color: #1976d2 !important;
            font-weight: 800;
            font-size: 2rem;
            letter-spacing: 2px;
        }
        .form-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px #6ec6ff33;
            max-width: 500px;
            margin: 50px auto 0 auto;
            padding: 36px 32px;
        }
        .btn-blue {
            background: linear-gradient(90deg,#1976d2 0%,#26d0ce 100%);
            color: #fff;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1.09rem;
            border: none;
            transition: background 0.15s;
        }
        .btn-blue:hover {
            background: #1976d2;
            color: #fff;
        }
        label, .form-label {
            font-weight: 600;
            color: #1976d2;
        }
        .main-title {
            color: #1976d2;
            font-weight: 800;
            text-align: center;
            font-size: 2rem;
            margin-bottom: 18px;
        }
        .car-title {
            color: #222;
            font-weight: 700;
            text-align: center;
            font-size: 1.15rem;
            margin-bottom: 30px;
        }
        .profile-img {
            width: 38px;
            border-radius: 50%;
            margin-left: 8px;
        }
        .phello {
            font-weight: 700;
            color: #1976d2;
            margin-left: 10px;
        }
        @media (max-width: 576px) {
            .form-card { padding: 16px 2vw;}
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="cardetails.php">CaRs</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbars" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbars">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item"><a class="nav-link" href="cardetails.php">Главная</a></li>
                    <li class="nav-item"><a class="nav-link" href="aboutus2.html">О нас</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Дизайн</a></li>
                    <li class="nav-item"><a class="nav-link" href="contactus2.html">Контакты</a></li>
                    <li class="nav-item ms-3">
                        <img src="images/profile.png" class="profile-img" alt="Профиль">
                    </li>
                    <li class="nav-item ms-1">
                        <span class="phello">Привет, <?php echo $user['FNAME'] . ' ' . $user['LNAME']; ?></span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="form-card mt-4">
        <div class="main-title">Бронирование</div>
        <div class="car-title">Автомобиль: <span style="color:#1976d2;"><?php echo htmlspecialchars($car['CAR_NAME']); ?></span></div>
        <?php if ($error): ?>
            <div class="alert alert-danger mb-2 py-2"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" autocomplete="off">
            <div class="mb-3">
                <label for="place" class="form-label">Место бронирования</label>
                <input type="text" class="form-control" id="place" name="place" placeholder="Введите место бронирования" required>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Дата бронирования</label>
                <input type="date" class="form-control" id="datefield" name="date" required>
            </div>
            <div class="mb-3">
                <label for="dur" class="form-label">Длительность (дней)</label>
                <input type="number" class="form-control" id="dur" name="dur" min="1" max="30" placeholder="Введите длительность аренды" required>
            </div>
            <div class="mb-3">
                <label for="ph" class="form-label">Номер телефона</label>
                <input type="tel" class="form-control" id="ph" name="ph" maxlength="13" placeholder="Введите номер" required>
            </div>
            <div class="mb-3">
                <label for="des" class="form-label">Назначение</label>
                <input type="text" class="form-control" id="des" name="des" placeholder="Куда вы поедете?" required>
            </div>
            <div class="mb-3">
                <label for="rdate" class="form-label">Дата возврата</label>
                <input type="date" class="form-control" id="dfield" name="rdate" required>
            </div>
            <button type="submit" class="btn btn-blue w-100 mt-2" name="book">Арендовать</button>
        </form>
    </div>

    <script>
        // Минимальные значения для дат (только будущее)
        function setDateLimits() {
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            const todayStr = yyyy + '-' + mm + '-' + dd;
            document.getElementById("datefield").setAttribute("min", todayStr);
            document.getElementById("dfield").setAttribute("min", todayStr);
        }
        setDateLimits();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
