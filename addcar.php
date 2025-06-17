<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Добавить автомобиль | Админ</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background: linear-gradient(43deg, #1e3c72 0%, #2a5298 100%);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      padding: 40px 20px;
      color: #fff;
    }

    .form-wrapper {
      background-color: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(10px);
      border-radius: 16px;
      padding: 30px 35px;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    }

    h2 {
      text-align: center;
      font-size: 24px;
      margin-bottom: 20px;
      color: #ffcc70;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="number"],
    input[type="file"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 18px;
      border-radius: 8px;
      border: none;
      outline: none;
      font-size: 16px;
      background-color: #f1f5f9;
      color: #333;
    }

    input[type="file"] {
      background-color: white;
    }

    .btn {
      width: 100%;
      padding: 12px;
      background: linear-gradient(to right, #00c6ff, #0072ff);
      color: white;
      font-weight: bold;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s;
      margin-top: 10px;
    }

    .btn:hover {
      background: linear-gradient(to right, #0072ff, #00c6ff);
    }

    .back-btn {
      margin-bottom: 30px;
      align-self: flex-start;
    }

    .back-btn a {
      text-decoration: none;
      background: #ffcc70;
      padding: 10px 16px;
      border-radius: 8px;
      font-weight: bold;
      color: #222;
      transition: background 0.3s;
    }

    .back-btn a:hover {
      background: #ffc940;
    }

    @media (max-width: 540px) {
      .form-wrapper {
        padding: 20px;
      }
    }
  </style>
</head>
<body>

  <div class="back-btn">
    <a href="adminvehicle.php">← Назад</a>
  </div>

  <div class="form-wrapper">
    <h2>Добавить новый автомобиль</h2>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
      <label for="carname">Название автомобиля:</label>
      <input type="text" id="carname" name="carname" placeholder="Например: Toyota Camry" required />

      <label for="ftype">Тип топлива:</label>
      <input type="text" id="ftype" name="ftype" placeholder="Бензин / Дизель / Электро" required />

      <label for="capacity">Вместимость:</label>
      <input type="number" id="capacity" name="capacity" min="1" placeholder="Введите количество мест" required />

      <label for="price">Цена за день (KGS):</label>
      <input type="number" id="price" name="price" min="1" placeholder="Введите стоимость аренды" required />

      <label for="image">Фото автомобиля:</label>
      <input type="file" id="image" name="image" required />

      <button type="submit" class="btn" name="addcar">Добавить автомобиль</button>
    </form>
  </div>

</body>
</html>
