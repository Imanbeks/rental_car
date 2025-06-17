<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Админ-панель | Бронирования</title>
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
    .content-table {
      width: 95%;
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
      padding: 12px 14px;
      font-size: 14px;
    }
    .content-table tbody tr:nth-child(even) {
      background-color: #f3f9fd;
    }
    .content-table tbody tr:hover {
      background-color: #e1f1ff;
    }
    .action-btn {
      background: #23c16b;
      color: white;
      padding: 6px 12px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.2s;
    }
    .action-btn:hover {
      background: #1aa857;
    }
    .action-btn a {
      color: white;
      text-decoration: none;
      font-weight: bold;
    }
    .return-btn {
      background: #f57c00;
    }
    .return-btn:hover {
      background: #ef6c00;
    }
  </style>
</head>
<body>
<?php
require_once('connection.php');
$query = "SELECT * FROM booking ORDER BY BOOK_ID DESC";
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
<h1 class="main-header">Список бронирований</h1>
<table class="content-table">
  <thead>
    <tr>
      <th>ID авто</th>
      <th>Email</th>
      <th>Место</th>
      <th>Дата брони</th>
      <th>Длительность</th>
      <th>Телефон</th>
      <th>Назначение</th>
      <th>Дата возврата</th>
      <th>Статус</th>
      <th>Подтвердить</th>
      <th>Возвращено</th>
    </tr>
  </thead>
  <tbody>
    <?php while($res = mysqli_fetch_array($queryy)) { ?>
    <tr>
      <td><?php echo $res['CAR_ID']; ?></td>
      <td><?php echo $res['EMAIL']; ?></td>
      <td><?php echo $res['BOOK_PLACE']; ?></td>
      <td><?php echo $res['BOOK_DATE']; ?></td>
      <td><?php echo $res['DURATION']; ?></td>
      <td><?php echo $res['PHONE_NUMBER']; ?></td>
      <td><?php echo $res['DESTINATION']; ?></td>
      <td><?php echo $res['RETURN_DATE']; ?></td>
      <td><?php echo $res['BOOK_STATUS']; ?></td>
      <td>
        <button class="action-btn">
          <a href="approve.php?id=<?php echo $res['BOOK_ID']; ?>">Подтвердить</a>
        </button>
      </td>
      <td>
        <button class="action-btn return-btn">
          <a href="adminreturn.php?id=<?php echo $res['CAR_ID']; ?>&bookid=<?php echo $res['BOOK_ID']; ?>">Возвращено</a>
        </button>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</body>
</html>
