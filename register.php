<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация | CaRs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background: linear-gradient(110deg, #163fa3 0%, #10d6ef 100%);
            font-family: 'Montserrat', Arial, sans-serif;
            margin: 0;
            min-height: 100vh;
        }
        .centered {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .reg-card {
            background: #fff;
            box-shadow: 0 4px 32px 0 #11a7e63c;
            border-radius: 30px;
            padding: 44px 38px 32px 38px;
            max-width: 390px;
            width: 97vw;
            display: flex;
            flex-direction: column;
            gap: 18px;
            margin-top: 26px;
        }
        .reg-card h2 {
            background: linear-gradient(90deg, #2279fa 0%, #ffe186 90%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
            margin: 0 0 20px 0;
            font-weight: 900;
            font-size: 2.2rem;
            text-align: center;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }
        .form-group label {
            font-weight: 600;
            color: #0d2859;
            font-size: 1.01rem;
        }
        .form-group input,
        .form-group select {
            border: 1.1px solid #e5edfa;
            border-radius: 13px;
            padding: 12px 13px;
            font-size: 1rem;
            background: #f3f9fd;
            color: #17487b;
            outline: none;
            transition: border 0.14s;
        }
        .form-group input:focus {
            border: 1.2px solid #199aff;
            background: #fff;
        }
        .gender-group {
            display: flex;
            gap: 20px;
            margin: 0 0 7px 0;
        }
        .gender-group label {
            font-weight: 500;
            font-size: 1rem;
            margin-left: 2px;
        }
        .custom-radio {
            accent-color: #179cff;
            width: 16px;
            height: 16px;
            margin: 0 7px 0 0;
        }
        .reg-btn {
            padding: 14px 0;
            background: linear-gradient(90deg, #1179ff 0%, #23d0ed 100%);
            color: #fff;
            font-size: 1.15rem;
            font-weight: 700;
            border: none;
            border-radius: 14px;
            cursor: pointer;
            margin-top: 10px;
            box-shadow: 0 2px 14px #09b6ff21;
            transition: background 0.15s, color 0.12s;
        }
        .reg-btn:hover {
            background: linear-gradient(90deg, #19b6ff 0%, #2279fa 100%);
            color: #fff;
        }
        .err-msg {
            color: #d62612;
            font-size: 0.97rem;
            margin: 2px 0 0 0;
            display: none;
        }
        #message {
            display:none;
            background: #ecf6ff;
            color: #24426d;
            border-radius: 13px;
            padding: 11px 17px 9px 17px;
            margin-bottom: 8px;
            font-size: 0.98rem;
            box-shadow: 0 1.5px 8px #11a7e62b;
        }
        #message p { margin: 0 0 6px 0; }
        .valid { color: #0fb98c; }
        .valid:before { content: "✔ "; }
        .invalid { color: #d62612; }
        .invalid:before { content: "✖ "; }
        @media (max-width: 500px) {
            .reg-card { padding: 13px 4vw 13px 4vw; }
        }
    </style>
</head>
<body>
<?php
require_once('connection.php');
if(isset($_POST['regs'])) {
    $fname = mysqli_real_escape_string($con,$_POST['fname']);
    $lname = mysqli_real_escape_string($con,$_POST['lname']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $lic   = mysqli_real_escape_string($con,$_POST['lic']);
    $ph    = mysqli_real_escape_string($con,$_POST['ph']);
    $pass  = mysqli_real_escape_string($con,$_POST['pass']);
    $cpass = mysqli_real_escape_string($con,$_POST['cpass']);
    $gender= mysqli_real_escape_string($con,$_POST['gender']);
    $Pass  = md5($pass);

    if(empty($fname) || empty($lname) || empty($email) || empty($lic) || empty($ph) || empty($pass) || empty($gender)) {
        echo '<script>alert("Пожалуйста, заполните все поля.")</script>';
    } else {
        if($pass == $cpass){
            $sql2 = "SELECT * FROM users WHERE EMAIL='$email'";
            $res = mysqli_query($con,$sql2);
            if(mysqli_num_rows($res)>0){
                echo '<script>alert("EMAIL уже зарегистрирован. Войдите в систему!")</script>';
                echo '<script> window.location.href = "index.php";</script>';
            } else {
                $sql = "INSERT INTO users (FNAME,LNAME,EMAIL,LIC_NUM,PHONE_NUMBER,PASSWORD,GENDER) VALUES('$fname','$lname','$email','$lic','$ph','$Pass','$gender')";
                $result = mysqli_query($con,$sql);
                if($result){
                    echo '<script>alert("Регистрация прошла успешно! Войдите в систему.")</script>';
                    echo '<script> window.location.href = "index.php";</script>';
                } else {
                    echo '<script>alert("Ошибка соединения. Попробуйте позже.")</script>';
                }
            }
        } else {
            echo '<script>alert("Пароли не совпадают!")</script>';
            echo '<script> window.location.href = "register.php";</script>';
        }
    }
}
?>
<div class="centered">
    <form class="reg-card" action="register.php" method="POST" autocomplete="off" onsubmit="return validateForm();">
        <h2>Регистрация</h2>
        <div class="form-group">
            <label for="fname">Имя</label>
            <input type="text" name="fname" id="fname" placeholder="Введите имя" required>
        </div>
        <div class="form-group">
            <label for="lname">Фамилия</label>
            <input type="text" name="lname" id="lname" placeholder="Введите фамилию" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="example@gmail.com" required>
        </div>
        <div class="form-group">
            <label for="lic">Вод. удостоверение</label>
            <input type="text" name="lic" id="lic" placeholder="Номер удостоверения" required>
        </div>
        <div class="form-group">
            <label for="ph">Телефон</label>
            <input type="tel" name="ph" id="ph" maxlength="15" placeholder="Номер телефона" required onkeypress="return onlyNumberKey(event)">
        </div>
        <div class="form-group">
            <label for="pass">Пароль</label>
            <input type="password" name="pass" id="psw" placeholder="Придумайте пароль" required>
        </div>
        <div id="message">
            <p id="letter" class="invalid">Хотя бы одну <b>строчную</b> букву</p>
            <p id="capital" class="invalid">Хотя бы одну <b>заглавную</b> букву</p>
            <p id="number" class="invalid">Хотя бы одну <b>цифру</b></p>
            <p id="length" class="invalid">Минимум <b>8 символов</b></p>
        </div>
        <div class="form-group">
            <label for="cpass">Повторите пароль</label>
            <input type="password" name="cpass" id="cpsw" placeholder="Повторите пароль" required>
            <div class="err-msg" id="pass-err">Пароли не совпадают</div>
        </div>
        <div class="gender-group">
            <label>Пол:</label>
            <label><input type="radio" class="custom-radio" name="gender" value="male" required>Муж</label>
            <label><input type="radio" class="custom-radio" name="gender" value="female" required>Жен</label>
        </div>
        <button type="submit" class="reg-btn" name="regs" id="submitBtn">Зарегистрироваться</button>
    </form>
</div>
<script>
// Только цифры для телефона
function onlyNumberKey(evt) {
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
}

// Проверка пароля (подсказка и требования)
var myInput = document.getElementById("psw");
var myCInput = document.getElementById("cpsw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");
var errMsg = document.getElementById("pass-err");
var submitBtn = document.getElementById("submitBtn");

myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";
}
myInput.onblur = function() {
    document.getElementById("message").style.display = "none";
}
myInput.onkeyup = function() {
    var lowerCaseLetters = /[a-z]/g;
    if(myInput.value.match(lowerCaseLetters)) {
        letter.classList.remove("invalid"); letter.classList.add("valid");
    } else { letter.classList.remove("valid"); letter.classList.add("invalid"); }
    var upperCaseLetters = /[A-Z]/g;
    if(myInput.value.match(upperCaseLetters)) {
        capital.classList.remove("invalid"); capital.classList.add("valid");
    } else { capital.classList.remove("valid"); capital.classList.add("invalid"); }
    var numbers = /[0-9]/g;
    if(myInput.value.match(numbers)) {
        number.classList.remove("invalid"); number.classList.add("valid");
    } else { number.classList.remove("valid"); number.classList.add("invalid"); }
    if(myInput.value.length >= 8) {
        length.classList.remove("invalid"); length.classList.add("valid");
    } else { length.classList.remove("valid"); length.classList.add("invalid"); }
    checkPasswordMatch();
}
myCInput.oninput = checkPasswordMatch;
myInput.oninput = checkPasswordMatch;

function checkPasswordMatch() {
    var password = myInput.value;
    var confirm = myCInput.value;
    if (confirm && password !== confirm) {
        errMsg.style.display = "block";
    } else {
        errMsg.style.display = "none";
    }
}

// Проверка совпадения при отправке формы
function validateForm() {
    var password = document.getElementById("psw").value;
    var confirm = document.getElementById("cpsw").value;
    if(password !== confirm) {
        errMsg.style.display = "block";
        return false;
    }
    return true;
}
</script>
</body>
</html>
