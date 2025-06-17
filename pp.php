<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Оплата</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(120deg, #1a2980, #26d0ce);
      font-family: 'Montserrat', sans-serif;
      padding-top: 60px;
      min-height: 100vh;
    }
    .card-box {
      max-width: 420px;
      margin: auto;
      background: #fff;
      border-radius: 18px;
      padding: 30px 28px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }
    .form-control {
      border-radius: 10px;
      font-size: 1rem;
    }
    .btn-pay {
      background: linear-gradient(90deg, #1976d2, #26d0ce);
      color: #fff;
      border: none;
      padding: 10px 0;
      font-weight: 600;
      border-radius: 12px;
      font-size: 1.1rem;
      margin-top: 18px;
    }
    .btn-pay:hover {
      background: #155fc4;
    }
    .form-label {
      font-weight: 600;
      color: #1976d2;
    }
    .title {
      text-align: center;
      font-weight: 700;
      margin-bottom: 24px;
      font-size: 1.6rem;
      color: #1976d2;
    }
  </style>
</head>
<body>
  <div class="card-box">
    <div class="title">Оплата картой</div>
    <form action="success.php" method="POST">
      <div class="mb-3">
        <label for="cardnumber" class="form-label">Номер карты</label>
        <input type="text" id="cardnumber" class="form-control" placeholder="0000 0000 0000 0000" required>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="exp" class="form-label">Срок действия</label>
          <input type="text" id="exp" class="form-control" placeholder="MM/YY" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="cvv" class="form-label">CVV</label>
          <input type="password" id="cvv" class="form-control" placeholder="123" required>
        </div>
      </div>
      <button type="submit" class="btn btn-pay w-100">Оплатить</button>
    </form>
  </div>
</body>
</html>
