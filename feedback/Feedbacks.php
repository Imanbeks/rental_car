<?php
require_once('../connection.php');
session_start();
$email = $_SESSION['email'] ?? '';

$feedbackMsg = '';
if (isset($_POST['submit'])) {
    $comment = mysqli_real_escape_string($con, $_POST['comment']);
    // Лучше брать email из сессии, а не из input!
    $sql = "INSERT INTO feedback (EMAIL, COMMENT) VALUES('$email', '$comment')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $feedbackMsg = "Спасибо за отзыв!";
        // Не делаем alert+header одновременно
        header("Location: ../cardetails.php");
        exit();
    } else {
        $feedbackMsg = "Произошла ошибка при отправке!";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Отзывы</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,500&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #eaf6ff 0%, #fff 100%);
            font-family: 'Montserrat', Arial, sans-serif;
        }
        .mainform {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 28px #e7eef7;
            margin: 48px auto 0 auto;
            max-width: 760px;
            padding: 40px 32px;
        }
        .feedback-title {
            color: #1876f2;
            font-size: 2.1rem;
            font-weight: 900;
            text-align: left;
            margin-bottom: 32px;
        }
        .btn-main {
            background: orange;
            color: #fff;
            border-radius: 14px;
            font-weight: 700;
            padding: 10px 30px;
            border: none;
            transition: background 0.16s;
            font-size: 1.08rem;
        }
        .btn-main:hover {
            background: #e56e00;
        }
        .btn-home {
            margin-bottom: 24px;
        }
        @media (max-width: 768px) {
            .mainform { padding: 16px 4vw;}
            .feedback-title { font-size: 1.4rem;}
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-end btn-home">
            <a href="../cardetails.php" class="btn btn-main">На Главную</a>
        </div>
        <div class="mainform">
            <div class="row">
                <div class="col-12 col-md-6 mb-4 mb-md-0 d-flex align-items-center">
                    <div>
                        <h2 class="feedback-title">Оставьте ваш отзыв!</h2>
                        <p style="font-size:1.11rem; color:#555;">Мы ценим ваше мнение — оно помогает сделать сервис лучше для всех.</p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <?php if ($feedbackMsg): ?>
                        <div class="alert alert-info"><?= $feedbackMsg ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <!-- Не спрашиваем повторно email — берём из сессии! -->
                        <div class="mb-3">
                            <label class="form-label">Комментарий</label>
                            <textarea class="form-control" name="comment" rows="5" placeholder="Ваш отзыв..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-info w-100 text-white" style="font-size:20px;" name="submit">Отправить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
