<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Подтверждение перевода</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f8fafd; font-family: 'Montserrat', Arial, sans-serif; }
    .form-card {
      max-width: 440px; margin: 38px auto; background: #fff; border-radius: 20px;
      box-shadow: 0 6px 32px #e6e6e6; padding: 38px 30px 34px 30px; position: relative;
    }
    .back-btn { position: absolute; top: 28px; left: 18px; background: none; border: none; color: #222; font-size: 1.4rem;}
    .back-btn:hover { color: #19cf86;}
    .title { font-size: 1.25rem; font-weight: 700; color: #222; margin-bottom: 20px;}
    .amount-label { font-size: 2.1rem; color: #95a3b8; text-align: center; margin-bottom: 7px; margin-top: 20px;}
    .input-group-text { background: #f2f4f6; color: #557; font-weight: 700; border-radius: 13px;}
    .input-amount { font-size: 2rem; height: 60px; text-align: center;}
    .btn-confirm { width: 100%; background: #bfc9db; color: #fff; border-radius: 13px; font-weight: 700; font-size: 1.12rem; margin-top: 36px; padding: 12px 0; border: none;}
    .btn-confirm.active { background: #19cf86; }
    .form-label { color: #95a3b8; font-size: 1.05rem;}
    .input-phone-group { background: #f7f7f7; border-radius: 13px; padding: 3px 8px;}
    .input-phone { border: none; background: transparent;}
    .input-phone:focus, .input-amount:focus { outline: none; box-shadow: none;}
    @media (max-width: 480px) { .form-card { padding: 13px 2vw;} }
  </style>
</head>
<body>
  <div class="form-card">
    <button class="back-btn" onclick="history.back()" title="Назад">&#8592;</button>
    <div class="title text-center mt-2 mb-3">Укажите сумму которую вы перевели</div>
    <form id="confirmForm" autocomplete="off" onsubmit="return sendWhatsApp()">
      <div class="amount-label">Сумма</div>
      <div class="input-group mb-4 justify-content-center" style="width: 80%;margin:auto;">
        <input type="number" min="1" class="form-control input-amount" id="amount" placeholder="0" required>
        <span class="input-group-text ms-2" style="font-size:1.06rem;">
          <img src="images/som.png" style="width:20px;margin-right:5px;">
          KGS
        </span>
      </div>
      <div class="mb-3 mt-4 text-center" style="font-size:1.07rem;color:#8b95a6;">Укажите номер телефона для связи с вами</div>
      <div class="input-group input-phone-group mb-1" style="width: 80%;margin:auto;">
        <span class="input-group-text" style="border:none;">+996</span>
        <input type="tel" class="form-control input-phone" id="phone" pattern="[0-9]{9}" maxlength="9" placeholder="Номер телефона" required>
      </div>
      <button id="confirmBtn" type="submit" class="btn-confirm mt-4" disabled>Подтвердить</button>
    </form>
  </div>
  <script>
    // Включаем кнопку только когда оба поля заполнены
    let amountInput = document.getElementById('amount');
    let phoneInput = document.getElementById('phone');
    let btn = document.getElementById('confirmBtn');
    amountInput.oninput = phoneInput.oninput = function() {
      btn.disabled = !(amountInput.value > 0 && phoneInput.value.length === 9);
      btn.classList.toggle('active', !btn.disabled);
    }
    function sendWhatsApp() {
      let amount = amountInput.value;
      let phone = '+996' + phoneInput.value;
      let message = encodeURIComponent('Уведомление о пополнении!\nСумма: ' + amount + ' KGS\nТелефон для связи: ' + phone);
      // WhatsApp API для отправки сообщения контакту
      window.open('https://wa.me/996703474976?text=' + message, '_blank');
      return false; // не отправлять форму стандартно
    }
  </script>
</body>
</html>
