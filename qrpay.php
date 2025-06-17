<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Оплата через QR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8fafd;
            font-family: 'Montserrat', Arial, sans-serif;
        }
        .qr-card {
            max-width: 420px;
            margin: 44px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 6px 32px #e6e6e6;
            padding: 30px 25px 26px 25px;
            position: relative;
        }
        .back-btn {
            position: absolute;
            top: 24px;
            left: 18px;
            background: none;
            border: none;
            color: #222;
            font-size: 1.35rem;
            transition: color .12s;
        }
        .back-btn:hover {
            color: #18bb92;
        }
        .qr-pay-title {
            font-size: 1.27rem;
            font-weight: 700;
            color: #222;
            margin-bottom: 6px;
        }
        .green-text { color: #18bb92; font-weight: 600;}
        .orange-text { color: #ff7200; }
        .fs-small { font-size: 0.98rem;}
        .qr-logo {
            width: 160px;
            display: block;
            margin: 20px auto 18px auto;
            border-radius: 10px;
            border: 1.5px solid #eee;
            background: #f8fafd;
        }
        .copy-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
        }
        .copy-btn {
            background: #e7f6f0;
            color: #18bb92;
            border-radius: 22px;
            border: none;
            font-weight: 700;
            font-size: 1.03rem;
            padding: 4px 20px;
            transition: background 0.12s, color 0.12s;
            box-shadow: 0 1px 2px #c2ece4;
            white-space: nowrap;
        }
        .copy-btn:active, .copy-btn:focus, .copy-btn:hover {
            background: #18bb92;
            color: #fff;
        }
        .btn-pay {
            width: 100%;
            background: linear-gradient(90deg,#11d59b 0%,#19cf86 100%);
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1.18rem;
            color: #fff;
            margin-top: 30px;
            margin-bottom: 18px;
            padding: 11px 0 11px 0;
            transition: background .12s;
        }
        .btn-pay:hover, .btn-pay:active { background: #15be81; }
        .support-num {
            color: #18bb92;
            font-size: 1.04rem;
            text-align: center;
            font-weight: 700;
            margin-top: 6px;
        }
        .support-num a {
            text-decoration: none;
            color: #18bb92;
            font-weight: 700;
            transition: color 0.13s;
        }
        .support-num a:hover { color: #0ca577; text-decoration: underline;}
        .form-label {
            margin-bottom: 0;
            font-weight: 500;
        }
        @media (max-width: 480px) {
            .qr-card { padding: 18px 2vw;}
            .qr-logo { width: 94vw; max-width: 180px;}
        }
    </style>
</head>
<body>
    <div class="qr-card">
        <!-- Кнопка Назад -->
        <button class="back-btn" onclick="history.back()" title="Назад">
            &#8592;
        </button>
        <div class="qr-pay-title text-center mb-1">MBANK</div>
        <div class="green-text mb-1 text-center" style="font-size:1.04rem;">Комиссия перевода 0%</div>
        <div class="fs-small mb-3 text-center">
            Совершите перевод по указанным реквизитам через ваш кошелек в Мбанк&nbsp;.
        </div>
        <!-- QR-код -->
        <img class="qr-logo" src="images/qr.png" alt="QR для оплаты">
        <div class="orange-text fs-small mb-2 text-center" style="margin-top:-3px;">
            ФИО владельца Мбанк кошелька должно совпадать с ФИО владельца аккаунта.
        </div>
        <div class="mb-2 mt-3">
            <div class="form-label">Номер счета:</div>
            <div class="copy-row">
                <span id="accnum" style="user-select:all;font-size:1.08rem;">1033220000282834</span>
                <button type="button" class="copy-btn" onclick="copyToClipboard('accnum')">Скопировать</button>
            </div>
        </div>
        <div class="mb-2">
            <div class="form-label">Имя:</div>
            <div class="copy-row">
                <span id="accname" style="user-select:all;font-size:1.08rem;">"Сталбеков Иман Сталбекович"</span>
                <button type="button" class="copy-btn" onclick="copyToClipboard('accname')">Скопировать</button>
            </div>
        </div>
        <form method="post" action="success.php">
            <button type="submit" class="btn-pay">Я оплатил</button>
        </form>
        <div class="support-num">
            <a href="https://wa.me/996703474976" target="_blank" title="Написать в WhatsApp">Номер службы поддержки: 0555 545 354</a>
        </div>
    </div>

    <!-- Bootstrap toast -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
      <div id="copiedToast" class="toast align-items-center text-white bg-success border-0" role="alert">
        <div class="d-flex">
          <div class="toast-body">
            Скопировано!
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function copyToClipboard(id) {
            var text = document.getElementById(id).textContent;
            navigator.clipboard.writeText(text).then(function() {
                var toast = new bootstrap.Toast(document.getElementById('copiedToast'));
                toast.show();
            });
        }
    </script>
</body>
</html>
