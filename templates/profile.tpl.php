<link rel="stylesheet"
      href="<?= $uri ?>/templates/css/profile-page.css?<?= filemtime('templates/css/profile-page.css') ?>">
<link rel="stylesheet"
      href="<?= $uri ?>/templates/css/colorpicker.css?<?= filemtime('templates/css/colorpicker.css') ?>">
<script type="text/javascript" src="<?= $uri ?>/templates/js/jquery.js"></script>
<script type="text/javascript"
        src="<?= $uri ?>/templates/js/colorpicker.js?<?= filemtime('templates/js/colorpicker.js') ?>"></script>
<script type="text/javascript" src="<?= $uri ?>/templates/js/eye.js?<?= filemtime('templates/js/eye.js') ?>"></script>
<script type="text/javascript"
        src="<?= $uri ?>/templates/js/utils.js?<?= filemtime('templates/js/utils.js') ?>"></script>
<script type="text/javascript"
        src="<?= $uri ?>/templates/js/layout.js?<?= filemtime('templates/js/layout.js') ?>"></script>

<div id="profile-page">
    <div class="left-profile">
        <div class="left-profile-head">Пользователь сайта</div>
        <div class="profile-page-user-avatar" style="position: relative">
            <img class="profile-page-user-avatar-img"
                 src="<?=viewAvatar($user['img'])?>"
                 alt="avatar"
            >
            <div id="avatar_loader" style="position: absolute; display: none">
                <img src="<?=$uri?>/templates/images/gif/Load.gif" alt="loader">
            </div>
        </div>
        <div class="choose-avatar"></div>
        <?php if ($_SESSION['login'] == $user['login']): ?>
            <div id="js-info"
                 data-salt="<?= $salt ?>"
                 data-id="<?= $user['id'] ?>"
            ></div>
            <input type="file" accept="image/*" id="chose-image" hidden>
        <?php endif; ?>
        <div class="left-profile-user-name font-family-user-name"
             style="font-family:<?= $user['font'] ?>;<?= $user['login_color'] ?>"><?= $user['login'] ?></div>
        <div class="left-profile-bottom"><b><?= $user['status'] ?></b></div>
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
                        <div class="about-profile-data-right change-profile-data"><?= $user['nameUser'] ?></div>
                    </div>

                    <div class="about-profile-data-line">
                        <div class="about-profile-data-left">Город:</div>
                        <div class="about-profile-data-right change-profile-data"><?= $user['city'] ?></div>
                    </div>

                    <div class="about-profile-data-line">
                        <div class="about-profile-data-left">Зарегистрирован:</div>
                        <div class="about-profile-data-right"><?= $helper::getWatch($user['date']) ?></div>
                    </div>

                    <div class="about-profile-data-line">
                        <div class="about-profile-data-left">Пол:</div>
                        <div class="about-profile-data-right change-profile-data-select"><?= $user['pol'] ?></div>
                    </div>

                    <div class="about-profile-data-line">
                        <div class="about-profile-data-left">Возраст:</div>
                        <div class="about-profile-data-right change-profile-data"><?= $user['age'] ?></div>
                    </div>

                </div>
            </div>

            <?php if ($_SESSION['login'] == $user['login']): ?>
                <div class="save-change-button-place changed">
                    <div class="change-button change-save-button">Изменить</div>
                    <div id="save_profile" class="save-button change-save-button">Сохранить</div>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($_SESSION['login'] == $user['login'] && $_SESSION['status'] != 'Анимешник'): ?>
            <div class="profile-vip-setting-page">
                <div class="set-nickname-color">
                    <div style="display:inline-block;">Цвет ника:</div>
                    <div id="colorSelector">
                        <div style="background-color:<?= $user['login_color'] ?>"></div>
                    </div>
                </div>

                <div class="choosed-bg" data-src='<?= $user['back_fon'] ?>'>

                    <ul class="choosing-bg">
                        <li class="bg-item" data-src="<?= $uri ?>templates/images/fons/21.jpg"></li>
                        <li class="bg-item" data-src="<?= $uri ?>templates/images/fons/22.jpg"></li>
                        <li class="bg-item" data-src="<?= $uri ?>templates/images/fons/23.jpg"></li>
                        <li class="bg-item" data-src="<?= $uri ?>templates/images/fons/24.jpg"></li>
                        <li class="bg-item" data-src="<?= $uri ?>templates/images/fons/25.jpg"></li>
                        <li class="bg-item" data-src="<?= $uri ?>templates/images/fons/26.jpg"></li>
                        <li class="bg-item" data-src="<?= $uri ?>templates/images/fons/27.jpg"></li>
                        <li class="bg-item" data-src="<?= $uri ?>templates/images/fons/28.jpg"></li>
                    </ul>
                </div>

                <div class="change-font-family-user-name">
                    <div>Шрифт</div>
                    <select class="font-family-type">
                        <option><?= $user['font'] ?></option>
                        <option>Arial</option>
                        <option>Times</option>
                        <option>Courier</option>
                        <option>Cute Font</option>
                    </select>
                </div>

                <div class="show-notification">
                    <label for="notification-check">
                        <b>Показывать уведомления о новых сериях?</b>
                        <?php if ($user['update_anime'] == 1): ?>
                            <input type="checkbox" id="notification-check" checked>
                        <?php else: ?>
                            <input type="checkbox" id="notification-check">
                        <?php endif; ?>
                    </label>
                </div>

                <textarea name="status" placeholder=""><?= $user['vip_status'] ?></textarea>

                <div id="save_vip" class="save-vip-button">Сохранить</div>
            </div>
        <?php endif; ?>
    </div>
</div>


<script src="<?= $uri ?>/templates/js/profile.js?<?= filemtime('templates/js/profile.js') ?>"></script>
