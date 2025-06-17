<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Админ-панель | Пользователи</title>
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
  <script>
    function confirmDelete(email) {
      if (confirm('Вы уверены, что хотите удалить этого пользователя?')) {
        window.location.href = 'deleteuser.php?id=' + encodeURIComponent(email);
      }
    }
  </script>
</head>
<body>
<?php
require_once('connection.php');
$query = "SELECT * FROM users";
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
<h1 class="main-header">Список пользователей</h1>
<table class="content-table">
  <thead>
    <tr>
      <th>Имя</th>
      <th>Email</th>
      <th>Вод. удостоверение</th>
      <th>Телефон</th>
      <th>Пол</th>
      <th>Удалить</th>
    </tr>
  </thead>
  <tbody>
    <?php while($res = mysqli_fetch_array($queryy)) { ?>
    <tr>
      <td><?php echo $res['FNAME'] . ' ' . $res['LNAME']; ?></td>
      <td><?php echo $res['EMAIL']; ?></td>
      <td><?php echo $res['LIC_NUM']; ?></td>
      <td><?php echo $res['PHONE_NUMBER']; ?></td>
      <td><?php echo $res['GENDER']; ?></td>
      <td>
        <button class="delete-btn" onclick="confirmDelete('<?php echo $res['EMAIL']; ?>')">
          Удалить
        </button>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</body>
</html>
