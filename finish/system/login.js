"use strict";
const errorUsername = document.querySelector('[data-error-username]');
const errorPassword = document.querySelector('[data-error-password]');
const errorGroup = document.querySelector('[data-error-group]');
const valid = document.querySelector('[data-valid]');

/**
    * @description Валидация формы регистрации
        */
document.querySelector('[data-form]').addEventListener('input', (event) => {
    let isValid = true;
    const usernameInput = document.querySelector('[data-username]');
    const passwordInput = document.querySelector('[data-password]');
    const groupInput = document.querySelector('[data-group]');

    // Проверка длины имени пользователя
    usernameInput.value.length < 6 ?
        (errorUsername.innerHTML = '<p class="error">Имя пользователя должно быть больше 6 символов</p>', isValid = false) :
        errorUsername.innerHTML = '';

    // Проверка длины пароля
    passwordInput.value.length < 6 ?
        (errorPassword.innerHTML = '<p class="error">Пароль должен быть больше 6 символов</p>', isValid = false) :
        errorPassword.innerHTML = '';

    // Проверка ввода группы
    groupInput.value.length < 3 ?
        (errorGroup.innerHTML = '<p class="error">Впишите номер группы без [241 -]</p>', isValid = false) :
        errorGroup.innerHTML = '';

    // Включение или выключение кнопки
    isValid ?
        (valid.disabled = false, valid.style.transition = '1s ease all', valid.style.opacity = '1') :
        (valid.disabled = true, valid.style.opacity = '0.5');
});

/**
 * @param { string } selector
    * @param { string } message
        * @param { string } type
            * @description Регистрация, авторизация, переходы
                */
const container = document.querySelector('.container');
const registerBtn = document.querySelector('.register-btn');
const loginBtn = document.querySelector('.login-btn');

registerBtn.addEventListener('click', () => {
    container.classList.add('active');
});

loginBtn.addEventListener('click', () => {
    container.classList.remove('active');
});

/*
    * @params {element} valid_login - переменная кнопки
        * @params {boolen} isValid_auth - tracker / трэкер проверки
            * @description - установка пассивной кнопки изначально
                */
var valid_login = document.querySelector('[data-log-valid]');
valid_login.setAttribute('disabled', true);
valid_login.style.opacity = '0.5';

document.querySelector('[data-log-forms-check]').addEventListener('input', function (event) {
    /**
    * @description - Проверка системы аутентификации
        * @params { element } usernameInput #getElementById
            * @params { element } passwordInput #getElementById
                * @params { element } Errorusername #getElementById
                    * @params { element } passwordMessage #getElementById
                        * @params { element } valid_login #getElementById
                            * @params { boolen } isValid_auth #установка => false значения по умолчанию
                                */
    const usernameInput = document.getElementById('log-user');
    const passwordInput = document.getElementById('log-pass');
    const Errorusername = document.querySelector('[data-log-error-username]');
    const passwordMessage = document.querySelector('[data-log-error-password]');
    let isValid_auth = false;

    // Сброс сообщений об ошибках
    // Errorusername.innerHTML = '';
    // passwordMessage.innerHTML = '';

    const usernameValue = usernameInput.value;
    const passwordValue = passwordInput.value;

    // Проверка существования пользователя
    fetch(`/../system/check.php?action=username&username=${encodeURIComponent(usernameValue)}`)
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                Errorusername.innerHTML = `<p class='mess_check'><span class='numeric'>1</span> Пользователь: <font class='godowod'>${usernameValue}</font><i class='fa fa-user-lock god_icon'></i></p>`;
                return true;
            } else {
                Errorusername.innerHTML = `<p class='mess_check'><span class='numeric'>1</span> Пользователь: <font class='notowod'>${usernameValue}</font><i class='fa fa-magnifying-glass bad_icon'></i> не зарегистрирован!</p>`;
                return false;
            }
        })
        .then((usernameValid) => {
            if (!usernameValid) {
                valid_login.setAttribute('disabled', true);
                valid_login.style.opacity = '0.5';
                return;
            }

            // Проверка на наличие пароля
            if (!passwordValue) {
                passwordMessage.innerHTML = `<p class='mess_check'><span class='numeric'>2</span>Введите пароль! <i class='fa fa-warning bad_icon'></i></p>`;
                valid_login.setAttribute('disabled', true);
                valid_login.style.opacity = '0.5';
                return;
            }

            // Проверка пароля
            fetch(`/../system/check.php?action=password&username=${encodeURIComponent(usernameValue)}`)
                .then(response => response.json())
                .then(data => {
                    if (!data.exists) {
                        passwordMessage.innerHTML = `<p class='mess_check'><span class='numeric'>2</span> Пароль: <font class='notowod'>Профиль не найден!<i class='bx bx-hand bad_icon'></i></font></p>`;
                        valid_login.setAttribute('disabled', true);
                        valid_login.style.opacity = '0.5';
                    } else if (passwordValue !== data.password) {
                        passwordMessage.innerHTML = `<p class='mess_check'><span class='numeric'>2</span> Пароль: <font class='notowod'>Неверный пароль!<i class='bx bx-magnifying-glass bad_icon'></i></font></p>`;
                        valid_login.setAttribute('disabled', true);
                        valid_login.style.opacity = '0.5';
                    } else {
                        passwordMessage.innerHTML = `<p class='mess_check'><span class='numeric'>2</span> Пароль: <font class='godowod'>Верный пароль!<i class='bx bx-key god_icon'></i></font></p>`;
                        valid_login.removeAttribute('disabled');
                        valid_login.style.opacity = '1';
                    }
                })
                .catch(error => {
                    console.error("Ошибка:", error);
                    passwordMessage.innerHTML = `<p class='mess_check'>Произошла ошибка проверки пароля!<i class='fa fa-wifi bad_icon'></i></p>`;
                });
        })
        .catch(error => {
            console.error("Ошибка:", error);
            Errorusername.innerHTML = `<p class='mess_check'>Произошла ошибка проверки пользователя! Error: ${error}<i class='fa fa-wifi bad_icon'></i></p>`;
        });
});

// Обработка диалога для восстановления пароля
document.querySelector('[data-log-forget]').addEventListener('click', () => {
    document.querySelector('dialog').showModal();
    document.querySelector('dialog').style.display = "flex";
});

document.querySelector('[data-log-close]').addEventListener('click', () => {
    document.querySelector('dialog').close();
    document.querySelector('dialog').style.display = "none";
});