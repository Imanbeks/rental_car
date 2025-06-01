
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>АРЕНДА АВТО</title>
    <script type="text/javascript">
        window.history.forward();
        function noBack() {
            window.history.forward();
        }
    </script>
    <link  rel="stylesheet" href="css/style.css">
    <script type="text/javascript">
        function preventBack() {
            window.history.forward(); 
        }
          
        setTimeout("preventBack()", 0);
          
        window.onunload = function () { null };
    </script>
</head>
<body>



<?php
require_once('connection.php');
    if(isset($_POST['login']))
    {
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        
        
        if(empty($email)|| empty($pass))
        {
            echo '<script>alert("please fill the blanks")</script>';
        }

        else{
            $query="select *from users where EMAIL='$email'";
            $res=mysqli_query($con,$query);
            if($row=mysqli_fetch_assoc($res)){
                $db_password = $row['PASSWORD'];
                if(md5($pass)  == $db_password)
                {
                    header("location: cardetails.php");
                    session_start();
                    $_SESSION['email'] = $email;
                    
                }
                else{
                    echo '<script>alert("Enter a proper password")</script>';
                }



                



            }
            else{
                echo '<script>alert("enter a proper email")</script>';
            }
        }
    }







?>
    <div class="hai">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">CaRs</h2>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="#">ГЛАВНАЯ</a></li>
                    <li><a href="aboutus.html">О НАС</a></li>
                    <li><a href="#">СЕРВИСЫ</a></li>
                    
                    <li><a href="contactus.html">КОНТАКТЫ</a></li>
                  <li> <button class="adminbtn"><a href="adminlogin.php">АДМИН-ВХОД</a></button></li>
                </ul>
            </div>
            
          
        </div>
        <div class="content">
            <h1>Арендуйте <br><span>Автомобиль Мечты</span></h1>
            <p class="par">Живите роскошно.<br>
                Просто выберите и арендуйте любой автомобиль из нашей большой коллекции.<br>Наслаждайтесь каждым моментом с семьёй<br>
                Присоединяйтесь к нам, чтобы сделать нашу дружную семью ещё больше.  </p>
            <button class="cn"><a href="register.php">ПРИСОЕДИНЯЙТЕСЬ К НАМ</a></button>
            <div class="form">
                <h2>ВХОД</h2>
                <form method="POST"> 
                <input type="email" name="email" placeholder="Enter Email Here">
                <input type="password" name="pass" placeholder="Enter Password Here">
                <input class="btnn" type="submit" value="Login" name="login"></input>
                </form>
                <p class="link">Нет аккаунта?<br>
                <a href="register.php">Регистрация</a> здесь</a></p>
                <!-- <p class="liw">or<br>Log in with</p>
                <div class="icon">
                    &emsp;&emsp;&emsp;&ensp;<a href="https://www.facebook.com/"><ion-icon name="logo-facebook"></ion-icon> </a>&nbsp;&nbsp;
                    <a href="https://www.instagram.com/"><ion-icon name="logo-instagram"></ion-icon> </a>&ensp;
                    <a href="https://myaccount.google.com/"><ion-icon name="logo-google"></ion-icon> </a>&ensp;
                    
                </div> -->
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>
</html>
