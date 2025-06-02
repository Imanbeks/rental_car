<?php
require_once('connection.php');
session_start();
$email  = $_SESSION['email'] ;

$sql = "select * from booking where EMAIL='$email' order by BOOK_ID DESC ";
$cname = mysqli_query($con, $sql);
$email = mysqli_fetch_assoc($cname);
$bid = $email['BOOK_ID'];
$_SESSION['bid'] = $bid;

$error = '';
if (isset($_POST['pay'])) {
    $cardno = mysqli_real_escape_string($con, $_POST['cardno']);
    $exp = mysqli_real_escape_string($con, $_POST['exp']);
    $cvv = mysqli_real_escape_string($con, $_POST['cvv']);
    $price = $email['PRICE'];

    // Эмулируем безопасную "оплату" (ничего не сохраняем!)
    if (empty($cardno) || empty($exp) || empty($cvv)) {
        $error = "Пожалуйста, заполните все поля.";
    } elseif (!preg_match('/^\d{4} \d{4} \d{4} \d{4}$/', $cardno)) {
        $error = "Некорректный номер карты!";
    } elseif (!preg_match('/^\d{2}\/\d{2}$/', $exp)) {
        $error = "Некорректный срок действия!";
    } elseif (!preg_match('/^\d{3}$/', $cvv)) {
        $error = "Некорректный CVV!";
    } else {
        // Тут эмуляция — считаем оплату прошедшей, но ничего не сохраняем (или можешь записывать в БД тестовые значения)
        header("Location: psucess.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Оплата</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(120deg, #ffe0c2 0%, #fff 100%) url("images/paym.jpg") center/cover;
            font-family: 'Poppins', Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .pay-card {
            background: rgba(255,255,255,0.93);
            border-radius: 20px;
            box-shadow: 0 8px 32px #f2b9802b;
            max-width: 420px;
            width: 100%;
            padding: 36px 26px 30px 26px;
            margin-top: 0;
            position: relative;
        }
        .pay-title {
            color: #18bb92;
            font-weight: 900;
            font-size: 1.9rem;
            text-align: center;
            margin-bottom: 20px;
        }
        .pay-icons {
            display: flex;
            justify-content: center;
            gap: 22px;
            font-size: 2.3rem;
            margin-bottom: 12px;
        }
        .visa { color: #1a1f71;}
        .elcart { color: #47a049;}
        .qr { color: #18bb92;}
        .btn-orange {
          background: #fff4ef;
            color: #ff7200;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.03rem;
            border: 1.5px solid #ff7200;
            transition: background 0.15s;
            margin-left: 4px;
        }
        .btn-orange:hover {
            background: #18bb92;
            color: #fff;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1.12rem;
            border: none;
            transition: background 0.15s;
        }
        .btn-qr {
            background: #fff4ef;
            color: #ff7200;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.03rem;
            border: 1.5px solid #ff7200;
            transition: background 0.15s;
            margin-left: 4px;
        }
        .btn-qr:hover {
            background: #18bb92;
            color: #fff;
        }
        .input-group-text {
            background: transparent;
            border: none;
        }
        .form-label { font-weight: 500; color: #18bb92;}
        .form-control:focus { border-color: #18bb92; box-shadow: 0 0 0 0.15rem #ff720052; }
        .pay-amount {
            text-align: center;
            color: #222;
            font-size: 1.12rem;
            font-weight: 600;
            margin-bottom: 22px;
        }
        .alert { margin-bottom: 16px; }
    </style>
</head>
<body>
    <div class="pay-card">
        <div class="pay-title">Оплата аренды</div>
        <div class="pay-amount">
            Общая сумма: <span style="color:#18bb92;">⃀<?php echo $email['PRICE']?>/-</span>
        </div>
        <div class="pay-icons">
            <i class="fa-brands fa-cc-visa visa" title="VISA"></i>
            <i class="fa-solid fa-credit-card elcart" title="Элкарт"></i>
            <a href="qrpay.php" title="Оплата по QR" style="text-decoration:none;"><i class="fa-solid fa-qrcode qr"></i></a>
        </div>
        <?php if ($error): ?>
            <div class="alert alert-danger py-2"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" autocomplete="off">
            <div class="mb-3">
                <label for="cardno" class="form-label">Номер карты</label>
                <div class="input-group">
                    <input
                        type="text"
                        class="form-control"
                        id="cardno"
                        name="cardno"
                        maxlength="19"
                        placeholder="xxxx xxxx xxxx xxxx"
                        required
                        autocomplete="off"
                    />
                    <span class="input-group-text"><i id="brandIcon" class="fa-regular fa-credit-card"></i></span>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-6">
                    <label for="exp" class="form-label">Срок действия</label>
                    <input
                        type="text"
                        class="form-control"
                        id="exp"
                        name="exp"
                        maxlength="5"
                        placeholder="MM/YY"
                        required
                        autocomplete="off"
                    />
                </div>
                <div class="col-6">
                    <label for="cvv" class="form-label">CVV</label>
                    <input
                        type="password"
                        class="form-control"
                        id="cvv"
                        name="cvv"
                        maxlength="3"
                        placeholder="XXX"
                        required
                        autocomplete="off"
                    />
                </div>
            </div>
            <button type="submit" class="btn btn-orange w-100 mt-4" name="pay">Оплатить</button>
            <a href="qrpay.php" class="btn btn-qr w-100 mt-2"><i class="fa-solid fa-qrcode"></i> Оплатить по QR</a>
            <a href="cancelbooking.php" class="btn btn-outline-danger w-100 mt-2">Отмена</a>
            
        </form>
        <div class="text-center mt-3" style="font-size:0.98rem;color:#aaa;">
            <i class="fa fa-info-circle"></i>
            Ваши данные карты нигде не сохраняются и не передаются. Оплата проводится только для демонстрации.
        </div>
    </div>
    <!-- Cleave.js для маски -->
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script>
        // Маска для ввода номера карты
        var cleaveCard = new Cleave('#cardno', {
            creditCard: true,
            onCreditCardTypeChanged: function (type) {
                // Смена иконки в зависимости от типа карты (визуально)
                let brandIcon = document.getElementById('brandIcon');
                if (type === 'visa') {
                    brandIcon.className = "fa-brands fa-cc-visa visa";
                } else if (type === 'mastercard') {
                    brandIcon.className = "fa-brands fa-cc-mastercard";
                } else {
                    brandIcon.className = "fa-regular fa-credit-card";
                }
            }
        });
        // Маска для срока действия
        var cleaveExp = new Cleave('#exp', {
            date: true,
            datePattern: ['m', 'y']
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
