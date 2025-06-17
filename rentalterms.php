<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Условия аренды | CaRs</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #cceaff 0%, #99d6ff 100%);
      padding: 40px 20px;
      color: #333;
    }

    .container {
      max-width: 880px;
      margin: auto;
      background: #ffffff;
      border-radius: 20px;
      padding: 30px 40px;
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      font-size: 32px;
      color: #1a73e8;
      margin-bottom: 30px;
    }

    h2 {
      font-size: 20px;
      color: #1a73e8;
      margin-top: 25px;
    }

    ul {
      margin: 10px 0 20px 25px;
    }

    li {
      margin-bottom: 10px;
    }

    .btn-group {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      justify-content: center;
      margin-top: 40px;
    }

    .button {
      background: linear-gradient(to right, #4facfe, #00f2fe);
      border: none;
      padding: 12px 20px;
      border-radius: 8px;
      font-weight: bold;
      color: white;
      text-decoration: none;
      transition: background 0.2s ease;
    }

    .button:hover {
      background: linear-gradient(to right, #00f2fe, #4facfe);
    }

    @media (max-width: 600px) {
      .container {
        padding: 20px;
      }

      h1 {
        font-size: 26px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Условия аренды автомобиля</h1>

    <h2>1. Общие положения</h2>
    <ul>
      <li>Минимальный возраст арендатора — 21 год, стаж — от 2 лет.</li>
      <li>Обязательно наличие водительского удостоверения и паспорта.</li>
    </ul>

    <h2>2. Срок аренды</h2>
    <ul>
      <li>Минимум — 1 час, максимум — 30 суток.</li>
      <li>Продление — по согласованию заранее.</li>
    </ul>

    <h2>3. Стоимость и оплата</h2>
    <ul>
      <li>Цена зависит от категории автомобиля и срока аренды.</li>
      <li>Оплата: наличными или через приложение.</li>
    </ul>

    <h2>4. Ответственность</h2>
    <ul>
      <li>Арендатор несёт ответственность за автомобиль на весь срок аренды.</li>
      <li>За повреждения и нарушения условий аренды предусмотрены штрафы.</li>
    </ul>

    <h2>5. Возврат</h2>
    <ul>
      <li>Машина должна быть возвращена в согласованное время и в исходном состоянии.</li>
      <li>Опоздание свыше 1 часа оплачивается как дополнительный час.</li>
    </ul>

    <div class="btn-group">
      <a href="documents/rental_contract.pdf" target="_blank" class="button">📄 Скачать договор аренды (PDF)</a>
      <a href="cardetails.php" class="button">🏠 На главную</a>
    </div>
  </div>
</body>
</html>
