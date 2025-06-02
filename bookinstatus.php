<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Статус аренды</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(120deg, #1a2980 0%, #26d0ce 100%);
            font-family: 'Montserrat', Arial, sans-serif;
        }
        .status-container {
            max-width: 480px;
            margin: 60px auto 0 auto;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 32px #b9e1ff50;
            padding: 42px 30px 38px 30px;
            position: relative;
        }
        .btn-main {
            background: linear-gradient(90deg,#1976d2 0%,#26d0ce 100%);
            color: #fff;
            font-weight: 700;
            border-radius: 11px;
            font-size: 1.07rem;
            padding: 10px 0;
            margin-bottom: 16px;
            border: none;
            transition: background .15s;
            width: 100%;
            max-width: 220px;
        }
        .btn-main:hover, .btn-main:focus {
            background: #1976d2;
            color: #fff;
        }
        .username {
            color: #fff;
            font-weight: 700;
            font-size: 1.18rem;
            text-align: right;
            margin-bottom: 6px;
        }
        .status-title {
            font-size: 1.37rem;
            font-weight: 800;
            color: #1a2980;
            margin-bottom: 22px;
            text-align: center;
        }
        .status-label {
            color: #8cbbe6;
            font-size: 1.05rem;
            font-weight: 500;
            margin-bottom: 2px;
        }
        .status-value {
            color: #222;
            font-size: 1.16rem;
            font-weight: 700;
            margin-bottom: 14px;
        }
        @media (max-width: 540px) {
            .status-container { padding: 22px 3vw; }
        }
    </style>
</head>
<body>
<?php
    require_once('connection.php');
    session_start();
    $email = $_SESSION['email'];

    $sql="select * from booking where EMAIL='$email' order by BOOK_ID DESC LIMIT 1";
    $name = mysqli_query($con,$sql);
    $rows=mysqli_fetch_assoc($name);
    if($rows==null){
        echo '<script>alert("БРОНИРОВАНИЯ ОТСУТСТВУЮТ")</script>';
        echo '<script> window.location.href = "cardetails.php";</script>';
    } else {
        $sql2="select * from users where EMAIL='$email'";
        $name2 = mysqli_query($con,$sql2);
        $rows2=mysqli_fetch_assoc($name2);
        $car_id=$rows['CAR_ID'];
        $sql3="select * from cars where CAR_ID='$car_id'";
        $name3 = mysqli_query($con,$sql3);
        $rows3=mysqli_fetch_assoc($name3);
?>
    <div class="container" style="max-width:600px;">
        <div class="d-flex justify-content-between align-items-center mt-4 mb-2">
            <a href="cardetails.php" class="btn btn-main" style="max-width:160px;">На главную</a>
            <div class="username">Привет, <?php echo $rows2['FNAME']." ".$rows2['LNAME']; ?></div>
        </div>
        <div class="status-container mt-2">
            <div class="status-title">Статус вашей аренды</div>
            <div class="status-label">Модель авто:</div>
            <div class="status-value"><?php echo $rows3['CAR_NAME']; ?></div>

            <div class="status-label">Количество дней:</div>
            <div class="status-value"><?php echo $rows['DURATION']; ?></div>

            <div class="status-label">Статус аренды:</div>
            <div class="status-value">
                <?php
                    // Красим статус цветом для наглядности:
                    $status = $rows['BOOK_STATUS'];
                    if (mb_stripos($status, 'подтверж') !== false || mb_stripos($status, 'выдан') !== false)
                        echo '<span style="color:#18bb92">'.$status.'</span>';
                    elseif (mb_stripos($status, 'отмен') !== false)
                        echo '<span style="color:#ff3e3e">'.$status.'</span>';
                    else
                        echo '<span style="color:#ffa700">'.$status.'</span>';
                ?>
            </div>
        </div>
    </div>
<?php } ?>
</body>
</html>
