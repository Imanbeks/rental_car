<?php 
require_once('connection.php');
session_start();

$value = $_SESSION['email'];
$sql="SELECT * FROM users WHERE EMAIL='$value'";
$name = mysqli_query($con,$sql);
$rows = mysqli_fetch_assoc($name);

$sql2 = "SELECT * FROM cars WHERE AVAILABLE='Y'";
$cars = mysqli_query($con, $sql2);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авто в аренду</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,500&display=swap" rel="stylesheet">
    <style>
        :root {
            --accent: #1876f2; /* твой цвет — можешь поменять! */
        }
        body {
            background: #fff;
            font-family: 'Montserrat', Arial, sans-serif;
            min-height: 100vh;
        }
        .navbar-brand {
            font-weight: 800;
            font-size: 2rem;
            letter-spacing: 2px;
            color: var(--accent) !important;
        }
        .profile-img {
            width: 42px;
            border-radius: 50%;
            margin-right: 12px;
        }
        .hello-user {
            font-weight: 600;
            color: #222;
        }
        .btn-logout {
            background: var(--accent);
            color: #fff !important;
            border-radius: 14px;
            font-weight: 600;
            padding: 4px 18px;
            border: none;
            margin-left: 18px;
        }
        .btn-logout:hover { background: #155fc4;}
        .overview {
            color: #222;
            font-size: 2.1rem;
            font-weight: 800;
            text-align: center;
            margin: 52px 0 36px 0;
            letter-spacing: 1px;
        }
        .car-card {
            border: 1.5px solid #eee;
            border-radius: 18px;
            box-shadow: 0 4px 16px #eee;
            background: #fff;
            margin-bottom: 28px;
            transition: box-shadow 0.14s, border 0.12s;
            padding: 0;
            overflow: hidden;
        }
        .car-card:hover {
            box-shadow: 0 8px 40px #1a29800f;
            border: 1.5px solid var(--accent);
        }
        .car-image {
            width: 100%;
            max-width: 210px;
            border-radius: 18px;
            object-fit: cover;
            background: #f6f8fa;
        }
        .car-name {
            font-size: 1.23rem;
            color: var(--accent);
            font-weight: 700;
            margin-bottom: 7px;
        }
        .car-info {
            color: #333;
            font-size: 1.06rem;
        }
        .car-price {
            color: var(--accent);
            font-weight: 700;
            font-size: 1.13rem;
            margin-bottom: 8px;
        }
        .car-btn {
            background: var(--accent);
            color: #fff !important;
            border-radius: 14px;
            font-weight: 700;
            padding: 10px 40px;
            font-size: 1.11rem;
            border: none;
            margin-top: 10px;
            transition: background 0.18s;
        }
        .car-btn:hover {
            background: #155fc4;
        }
        .status-link {
            color: var(--accent);
            text-decoration: underline;
            font-weight: 700;
        }
        .nav-link, .nav-link:visited {
            color: #222 !important;
            font-weight: 500;
            margin-right: 10px;
        }
        .nav-link.active, .nav-link:hover {
            color: var(--accent) !important;
        }
        @media (max-width: 992px) {
            .car-image { max-width: 130px; }
        }
        @media (max-width: 768px) {
            .overview { font-size: 1.5rem; margin: 30px 0 22px 0; }
            .car-card { flex-direction: column; align-items: center;}
            .car-image { max-width: 100%; }
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
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#">Главная</a></li>
                    <li class="nav-item"><a class="nav-link" href="aboutus2.html">О нас</a></li>
                    <li class="nav-item"><a class="nav-link" href="contactus2.html">Контакты</a></li>
                    <li class="nav-item"><a class="nav-link" href="feedback/Feedbacks.php">Отзывы</a></li>
                    <li class="nav-item"><a class="nav-link status-link" href="bookinstatus.php">Статус аренды</a></li>
                    <li class="nav-item d-flex align-items-center ms-3">
                        <img src="images/profile.png" alt="Profile" class="profile-img">
                        <span class="hello-user">Привет, <?php echo $rows['FNAME']." ".$rows['LNAME']?></span>
                    </li>
                    <li class="nav-item ms-2">
                        <a href="index.php" class="btn btn-logout">Выйти</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container pt-2 pb-5">
        <div class="overview">Доступные автомобили</div>
        <div class="row g-4 justify-content-center">
            <?php while($result = mysqli_fetch_array($cars)): ?>
            <div class="col-12 col-md-6 col-lg-4 d-flex">
                <div class="car-card d-flex flex-row align-items-center w-100 p-3">
                    <div class="flex-shrink-0 me-3">
                        <img src="images/<?php echo htmlspecialchars($result['CAR_IMG']) ?>" class="car-image" alt="car">
                    </div>
                    <div class="flex-grow-1">
                        <div class="car-name"><?php echo htmlspecialchars($result['CAR_NAME']) ?></div>
                        <div class="car-info">Тип топлива: <b><?php echo htmlspecialchars($result['FUEL_TYPE']) ?></b></div>
                        <div class="car-info">Вместимость: <b><?php echo htmlspecialchars($result['CAPACITY']) ?></b></div>
                        <div class="car-price">₸<?php echo htmlspecialchars($result['PRICE']) ?>/день</div>
                        <a href="booking.php?id=<?php echo $result['CAR_ID'];?>" class="car-btn">Выбрать</a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
