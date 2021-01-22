<?php \Lib\ReCaptcha::renderJs(); ?>
<link rel="stylesheet" href="<?=$uri?>templates/css/regist.css">

<div id="regist">
  <div class="regist-header">Регистрация</div>

  <form class="registration-form" method="post">
    <div class="registration-form-item">
      <span>Логин:</span>
      <div class="registration-input">
        <input class="registration-input-item" name="login" type="text" required autocomplete="on">
        <div class="registration-placeholder">Логин</div>
      </div>
    </div>

    <div class="registration-form-item">
      <span>Пароль:</span>
      <div class="registration-input">
        <input class="registration-input-item" name="password" type="password" required autocomplete="on">
        <div class="registration-placeholder">Пароль</div>
      </div>
    </div>
    <div class="registration-form-item">
      <span>Повторите пвроль:</span>
      <div class="registration-input">
        <input class="registration-input-item" type="password" name="repassword" required autocomplete="on">
        <div class="registration-placeholder">Подтверждение пароля</div>
      </div>
    </div>
    <div class="registration-form-item">
      <span>E-mail:</span>
      <div class="registration-input">
        <input class="registration-input-item" type="email" name="email" required autocomplete="on">
        <div class="registration-placeholder">E-mail</div>
      </div>
    </div>
      <div class="registration-form-item">
          <span>Captcha</span>
          <div class="registration-input">
              <?php \Lib\ReCaptcha::display(); ?>
          </div>
      </div>
    <input type="submit" name="button" value="Отправить">
  </form>
</div>
