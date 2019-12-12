<link rel="stylesheet" href="<?=$uri?>templates/css/regist.css">

<div id="regist">
  <div class="regist-header">Регистрация</div>

  <form class="registration-form" method="post">
    <div class="registration-form-item"><span>Логин:</span><input name="login" type="text" required autocomplete="on" placeholder="Логин"></div>
    <div class="registration-form-item"><span>Пароль:</span><input name="password" type="password" required autocomplete="on" placeholder="Пароль"></div>
    <div class="registration-form-item"><span>Повторите пвроль:</span><input type="password" name="repassword" required autocomplete="on" placeholder="Подтверждение пароля"></div>
    <div class="registration-form-item"><span>E-mail:</span><input type="email" name="email" required autocomplete="on" placeholder="E-mail"></div>
    <input type="submit" name="button" value="Отправить">
  </form>
</div>
