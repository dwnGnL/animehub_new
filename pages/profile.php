<link rel="stylesheet" href="../css/profile-page.css">

<div id="profile-page">
  <div class="left-profile">
    <div class="left-profile-head">Пользователь сайта</div>
    <div class="profile-page-user-avatar"><img class="profile-page-user-avatar-img" src="images/avatar/1.png"></div>

    <div class="choose-avatar"></div>

    <div class="left-profile-user-name font-family-user-name">User name</div>
  </div>

  <div class="right-profile show-account account-opacity">
    <div class="profile-button-place">
      <div class="account-button">Аккаунт</div>
      <div class="vip-setting-button">Настройки VIP</div>
    </div>

    <div class="profile-account-page">
      <div class="about-profile">
        <div class="about-profile-head">О профиле</div>
        <div class="about-profile-data">
          <div class="about-profile-data-line">
            <div class="about-profile-data-left">Имя:</div>
            <div class="about-profile-data-right change-profile-data">Name</div>
          </div>

          <div class="about-profile-data-line">
            <div class="about-profile-data-left">Город:</div>
            <div class="about-profile-data-right change-profile-data">City</div>
          </div>

          <div class="about-profile-data-line">
            <div class="about-profile-data-left">Зарегистрирован:</div>
            <div class="about-profile-data-right">Regist date</div>
          </div>

          <div class="about-profile-data-line">
            <div class="about-profile-data-left">Пол:</div>
            <div class="about-profile-data-right change-profile-data-select">Sex</div>
          </div>

          <div class="about-profile-data-line">
            <div class="about-profile-data-left">Возраст:</div>
            <div class="about-profile-data-right change-profile-data">Age</div>
          </div>
        </div>
      </div>

      <div class="save-change-button-place changed">
        <div class="change-button change-save-button">Изменить</div>
        <div class="save-button change-save-button">Сохранить</div>
      </div>
    </div>

    <div class="profile-vip-setting-page">
      <div class="change-font-family-user-name">
        <div>Шрифт</div>
        <select class="font-family-type">
          <option>Arial</option>
          <option>Times</option>
          <option>Courier</option>
          <option>Cute Font</option>
        </select>
      </div>

      <div class="show-notification">
        <label for="notification-check">
          <b>Показывать уведомления о новых сериях?</b>
          <input type="checkbox" id="notification-check">
        </label>
      </div>

      <textarea name="name" placeholder=""></textarea>

      <div class="save-vip-button">Сохранить</div>

    </div>
  </div>
</div>


<script src="js/profile.js"></script>
