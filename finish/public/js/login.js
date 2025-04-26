document.addEventListener('DOMContentLoaded', function() {
    // Элементы форм
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const container = document.querySelector('.container');
    
    // Кнопки переключения
    const registerBtn = document.querySelector('.register-btn');
    const loginBtn = document.querySelector('.login-btn');
    
    // Диалог "Забыли пароль"
    const forgotPassword = document.getElementById('forgot-password');
    const dialog = document.querySelector('dialog');
    const closeDialog = document.getElementById('close-dialog');
    
    // Обработка переключения между формами
    registerBtn.addEventListener('click', () => {
        container.classList.add('active');
    });
    
    loginBtn.addEventListener('click', () => {
        container.classList.remove('active');
    });
    
    // Обработка диалога "Забыли пароль"
    forgotPassword.addEventListener('click', () => {
        dialog.showModal();
    });
    
    closeDialog.addEventListener('click', () => {
        dialog.close();
    });
    
    // Обработка отправки формы входа
    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();
        // Форма будет обрабатываться на стороне PHP
        loginForm.submit();
    });
    
    // Обработка отправки формы регистрации
    registerForm.addEventListener('submit', (e) => {
        e.preventDefault();
        // Форма будет обрабатываться на стороне PHP
        registerForm.submit();
    });
}); 