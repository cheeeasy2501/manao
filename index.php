<?php
require_once 'layouts/header.php' ?>
<? if(isset($_SESSION['login'])) {?>
<div class="hello">
    <span>Привет <?= $_SESSION['login']; ?></span>
    <button id="exitButton">Выйти</button>
</div>
<?}
    else {
?>
<nav class="nav container">
    <li class="nav-item" data-link="login-block">Авторизация</li>
    <li class="nav-item" data-link="registration-block">Регистрация</li>
</nav>
<section class="forms" id="login-block">
    <div class="container">
        <div class="form-block">
            <h2>Авторизация</h2>
            <div class="login-errors errors display-none"></div>
            <form id="login-form">
                <div>
                    <div class="input-name">Введите логин</div>
                    <input type="text" name="login" data-validation="length" data-validation-length="min5" data-validation-error-msg-length="Логин должен состоять минимум из 5 символов">
                </div>
                <div>
                    <div class="input-name">Введите пароль</div>
                    <input type="password" name="password" data-validation="length" data-validation-length="min6" data-validation-error-msg-length="Пароль должен состоять минимум из 6 символов">
                </div>
                <button id="loginButton" type="submit">Войти</button>
            </form>
        </div>
    </div>
</section>

<section class="forms" id="registration-block">
    <div class="container">
        <div class="form-block">
            <h2>Регистрация</h2>
            <div class="registration-errors errors display-none"></div>
            <form id="registration-form">
                <div>
                    <div class="input-name">Введите Email</div>
                    <input type="email" name="email" data-validation="email" data-validation-error-msg-email="Введите корректный Email-адрес">
                </div>
                <div>
                    <div class="input-name">Введите имя</div>
                    <input type="text" name="name" data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Обязательное поле">
                </div>
                <div>
                    <div class="input-name">Введите логин</div>
                    <input type="text" name="login" data-validation="length" data-validation-length="min5" data-validation-error-msg-length="Логин должен состоять минимум из 5 символов">
                </div>
                <div>
                    <div class="input-name">Введите пароль</div>
                    <input type="password" name="password" data-validation="length" data-validation-length="min6" data-validation-error-msg-length="Пароль должен состоять минимум из 6 символов">
                </div>
                <div>
                    <div class="input-name">Подтвердите пароль</div>
                    <input type="password" name="confim_password" data-validation="confirmation" data-validation-confirm="password" data-validation-error-msg="Введенный пароль не совпадает!">
                </div>
                <button id="registrationButton" type="submit">Регистрация</button>
            </form>
        </div>
    </div>
</section>
<? }?>
<?php require_once 'layouts/footer.php' ?>