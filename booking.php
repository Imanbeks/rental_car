<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Бронирование авто</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,500&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #1a2980 0%, #26d0ce 100%);
            font-family: 'Montserrat', sans-serif;
            min-height: 100vh;
        }
        .navbar-brand {
            font-weight: 800;
            color: #1976d2 !important;
            font-size: 2rem;
        }
        .booking-container {
            margin-top: 40px;
            padding: 30px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.15);
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }
        .car-image {
            width: 100%;
            border-radius: 12px;
            object-fit: cover;
            max-height: 380px;
        }
        .btn-blue {
            background: linear-gradient(90deg,#1976d2 0%,#26d0ce 100%);
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            padding: 10px 25px;
            transition: 0.3s;
        }
        .btn-blue:hover {
            background: #1976d2;
        }
        h3, label {
            color: #1976d2;
            font-weight: 700;
        }
        .alert {
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
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
<nav class="navbar navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="cardetails.php">CaRs</a>
    </div>
</nav>

<div class="booking-container">
    <div class="row g-4">
        <div class="col-md-6">
            <img src="images/<?php echo htmlspecialchars($car['CAR_IMG']) ?>" class="car-image" alt="Фото автомобиля">
        </div>
        <div class="col-md-6">
            <h3>Забронировать <?php echo htmlspecialchars($car['CAR_NAME']) ?></h3>
            <?php if ($error): ?>
                <div class="alert alert-danger mt-2"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-2">
                    <label>Место бронирования</label>
                    <input type="text" name="place" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Дата бронирования</label>
                    <input type="date" name="date" class="form-control" id="datefield" required>
                </div>
                <div class="mb-2">
                    <label>Длительность (в днях)</label>
                    <input type="number" name="dur" class="form-control" min="1" max="30" required>
                </div>
                <div class="mb-2">
                    <label>Телефон</label>
                    <input type="tel" name="ph" class="form-control" maxlength="13" required>
                </div>
                <div class="mb-2">
                    <label>Назначение</label>
                    <input type="text" name="des" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Дата возврата</label>
                    <input type="date" name="rdate" class="form-control" id="dfield" required>
                </div>
                <button type="submit" name="book" class="btn btn-blue w-100">Подтвердить бронирование</button>
            </form>
        </div>
    </div>
</div>
<script>
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');
    const todayStr = `${yyyy}-${mm}-${dd}`;
    document.getElementById("datefield").setAttribute("min", todayStr);
    document.getElementById("dfield").setAttribute("min", todayStr);
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
