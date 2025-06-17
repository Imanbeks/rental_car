<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Админ-панель | CaRs</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Montserrat', Arial, sans-serif;
      background: linear-gradient(120deg, #163fa3 0%, #10d6ef 100%);
      color: #0a2540;
      min-height: 100vh;
    }
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 60px;
      background-color: #ffffffcc;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }
    .logo {
      font-size: 28px;
      font-weight: 800;
      color: #156af7;
    }
    .menu ul {
      display: flex;
      gap: 30px;
      list-style: none;
    }
    .menu ul li a {
      text-decoration: none;
      font-weight: 600;
      color: #17487b;
      transition: 0.2s;
    }
    .menu ul li a:hover {
      color: #156af7;
    }
    .main-header {
      text-align: center;
      font-size: 36px;
      color: #ffffff;
      margin-top: 40px;
    }
    .add-btn {
      display: block;
      margin: 20px auto;
      background: linear-gradient(90deg, #1179ff 0%, #23d0ed 100%);
      color: #fff;
      border: none;
      padding: 12px 24px;
      border-radius: 12px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.2s;
    }
    .add-btn:hover {
      background: linear-gradient(90deg, #199aff 0%, #156af7 100%);
    }
    .add-btn a {
      text-decoration: none;
      color: white;
      font-weight: bold;
    }
    .content-table {
      width: 90%;
      margin: 30px auto;
      border-collapse: collapse;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    .content-table thead {
      background-color: #156af7;
      color: white;
      text-align: left;
    }
    .content-table th, .content-table td {
      padding: 14px 18px;
    }
    .content-table tbody tr:nth-child(even) {
      background-color: #f3f9fd;
    }
    .content-table tbody tr:hover {
      background-color: #e1f1ff;
    }
    .delete-btn {
      background: #ff4d4d;
      color: white;
      padding: 6px 12px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.2s;
    }
    .delete-btn:hover {
      background: #e63737;
    }
    .delete-btn a {
      color: white;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>
<?php
require_once('connection.php');
$query = "SELECT * FROM cars";
$queryy = mysqli_query($con, $query);
?>
<div class="navbar">
  <div class="logo">CaRs</div>
  <div class="menu">
    <ul>
      <li><a href="adminvehicle.php">Управление авто</a></li>
      <li><a href="adminusers.php">Пользователи</a></li>
      <li><a href="admindash.php">Отзывы</a></li>
      <li><a href="adminbook.php">Бронирования</a></li>
      <li><a href="index.php">Выход</a></li>
    </ul>
  </div>
</div>
<h1 class="main-header">Список автомобилей</h1>
<button class="add-btn"><a href="addcar.php">+ Добавить авто</a></button>
<table class="content-table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Название</th>
      <th>Топливо</th>
      <th>Вместимость</th>
      <th>Цена</th>
      <th>Доступность</th>
      <th>Удалить</th>
    </tr>
  </thead>
  <tbody>
    <?php while($res = mysqli_fetch_array($queryy)) { ?>
    <tr>
      <td><?php echo $res['CAR_ID']; ?></td>
      <td><?php echo $res['CAR_NAME']; ?></td>
      <td><?php echo $res['FUEL_TYPE']; ?></td>
      <td><?php echo $res['CAPACITY']; ?></td>
      <td><?php echo $res['PRICE']; ?></td>
      <td><?php echo ($res['AVAILABLE'] == 'Y') ? 'Да' : 'Нет'; ?></td>
      <td>
        <button class="delete-btn">
          <a href="deletecar.php?id=<?php echo $res['CAR_ID']; ?>">Удалить</a>
        </button>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</body>
</html>
