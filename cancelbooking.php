<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ОТМЕНА АРЕНДЫ</title>
    <style>
        body {
            background: linear-gradient(120deg, #1a2980 0%, #26d0ce 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Montserrat', Arial, sans-serif;
        }
        .cancel-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px #c8e7ff;
            padding: 44px 36px 32px 36px;
            max-width: 410px;
            width: 100%;
            margin: 24px;
            text-align: center;
            position: relative;
        }
        .cancel-title {
            font-size: 1.34rem;
            font-weight: 800;
            margin-bottom: 28px;
            color: #144fa7;
        }
        .cancel-warning {
            font-size: 1.08rem;
            color: #1976d2;
            margin-bottom: 30px;
        }
        .btn-blue, .btn-outline-blue {
            width: 100%;
            max-width: 250px;
            padding: 13px 0 11px 0;
            border-radius: 12px;
            font-size: 1.13rem;
            font-weight: 700;
            margin-bottom: 14px;
            border: none;
            transition: all .16s;
            cursor: pointer;
        }
        .btn-blue {
            background: linear-gradient(90deg,#1976d2 0%,#26d0ce 100%);
            color: #fff;
            box-shadow: 0 2px 8px #a7d5ff34;
        }
        .btn-blue:hover, .btn-blue:focus {
            background: #1976d2;
        }
        .btn-outline-blue {
            background: #fff;
            color: #1976d2;
            border: 2px solid #26d0ce;
        }
        .btn-outline-blue:hover, .btn-outline-blue:focus {
            background: #1976d2;
            color: #fff;
        }
        @media (max-width: 600px) {
            .cancel-card { padding: 22px 6vw; }
        }
    </style>
</head>
<body>
<?php
    require_once('connection.php');
    session_start();
    $bid = $_SESSION['bid'];
    if(isset($_POST['cancelnow'])){
        $del = mysqli_query($con,"delete from booking where BOOK_ID = '$bid' order by BOOK_ID DESC limit 1");
        echo "<script>window.location.href='cardetails.php';</script>";
    }
?>
    <form class="cancel-card" method="POST">
        <div class="cancel-title">Вы уверены, что хотите отменить бронирование?</div>
        <div class="cancel-warning">Это действие невозможно отменить.<br>Вы потеряете все данные текущей аренды.</div>
        <input type="submit" class="btn-blue" value="Отменить аренду" name="cancelnow">
        <a href="payment.php" class="btn-outline-blue" style="display:inline-block;text-decoration:none;">Вернуться к оплате</a>
    </form>
</body>
</html>
