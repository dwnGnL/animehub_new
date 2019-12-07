<link rel="stylesheet" href="<?=$uri?>/templates/css/profile-page.css">

<div id="profile-page">
    <div class="left-profile">
        <div class="left-profile-head">Пользователь сайта</div>
        <div class="profile-page-user-avatar"><img class="profile-page-user-avatar-img" src="<?=$user['img']?>"></div>
        <div class="choose-avatar"></div>

        <div class="left-profile-user-name font-family-user-name" style="font-family:<?=$user['font']?>;<?=$user['login_color']?>"><?=$user['login']?></div>
        <div class="left-profile-bottom"><b><?=$user['status']?></b></div>
    </div>

    <div class="right-profile show-account account-opacity">
        <?php if ($_SESSION['login'] == $user['login'] && $_SESSION['status'] != 'Анимешник'): ?>
        <div class="profile-button-place">
            <div class="account-button">Аккаунт</div>
            <div class="vip-setting-button">Настройки VIP</div>
        </div>
        <?php endif; ?>

        <div class="profile-account-page">
            <div class="about-profile">
                <div class="about-profile-head">О профиле</div>
                <div class="about-profile-data">
                    <div class="about-profile-data-line">
                        <div class="about-profile-data-left">Имя:</div>
                        <div class="about-profile-data-right change-profile-data"><?=$user['nameUser']?></div>
                    </div>

                    <div class="about-profile-data-line">
                        <div class="about-profile-data-left">Город:</div>
                        <div class="about-profile-data-right change-profile-data"><?=$user['city']?></div>
                    </div>

                    <div class="about-profile-data-line">
                        <div class="about-profile-data-left">Зарегистрирован:</div>
                        <div class="about-profile-data-right"><?=$helper::getWatch($user['date'])?></div>
                    </div>

                    <div class="about-profile-data-line">
                        <div class="about-profile-data-left">Пол:</div>
                        <div class="about-profile-data-right change-profile-data-select"><?=$user['pol']?></div>
                    </div>

                    <div class="about-profile-data-line">
                        <div class="about-profile-data-left">Возраст:</div>
                        <div class="about-profile-data-right change-profile-data"><?=$user['age']?></div>
                    </div>

                </div>
            </div>

            <?php if ($_SESSION['login'] == $user['login']): ?>
            <div class="save-change-button-place changed">
                <div class="change-button change-save-button">Изменить</div>
                <div class="save-button change-save-button">Сохранить</div>
            </div>
            <?php endif; ?>
        </div>

        <?php if ($_SESSION['login'] == $user['login'] && $_SESSION['status'] != 'Анимешник'): ?>
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
        <?php endif; ?>
    </div>
</div>


<script src="<?=$uri?>/templates/js/profile.js"></script>

