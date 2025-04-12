// Основные переменные
let firstNumber = '';
let operation = '';
let waitingForSecondNumber = false;
let currentX = 0;
let currentY = 0;
const calculator = document.querySelector('.calculator');
const display = document.querySelector('.display');

// Функции для работы с дисплеем
function updateDisplay(value, operator = '') {
 if (operator) {
  display.textContent = `${value} ${operator}`;
 } else {
  display.textContent = value;
 }
}

// Функция для отправки запроса на сервер
async function sendRequest(action, data = {}) {
 try {
  const response = await fetch('setting.php', {
   method: 'POST',
   headers: {
    'Content-Type': 'application/json',
   },
   body: JSON.stringify({ action, ...data })
  });
  const result = await response.json();
  return result.result;
 } catch (error) {
  console.error('Error:', error);
  return 'Error';
 }
}

// Обработчики кнопок
function handleNumber(number) {
 if (waitingForSecondNumber) {
  updateDisplay(number);
  waitingForSecondNumber = false;
 } else {
  const displayValue = display.textContent;
  updateDisplay(displayValue === '0' ? number : displayValue + number);
 }
}

function handleOperator(op) {
 const inputValue = display.textContent.split(' ')[0]; // Получаем только число без оператора
 if (firstNumber === '') {
  firstNumber = inputValue;
 } else if (operation && !waitingForSecondNumber) {
  calculate();
 }
 waitingForSecondNumber = true;
 // Конвертируем символы операций для сервера
 operation = op === '×' ? '*' : op === '÷' ? '/' : op;
 updateDisplay(inputValue, op); // Показываем число и оператор
}

async function calculate() {
 if (operation && !waitingForSecondNumber) {
  const secondNumber = display.textContent.split(' ')[0];

  // Проверка деления на ноль
  if (operation === '÷' && secondNumber === '0') {
   updateDisplay('Error');
   firstNumber = '';
   operation = '';
   waitingForSecondNumber = false;
   return;
  }

  const result = await sendRequest('calculate', {
   num1: firstNumber,
   num2: secondNumber,
   operation: operation
  });

  // Проверка на ошибку в результате
  if (result === 'Error') {
   updateDisplay('Error');
  } else {
   updateDisplay(result);
  }

  firstNumber = '';
  operation = '';
  waitingForSecondNumber = false;
 }
}

async function handleClear() {
 const result = await sendRequest('clear');
 updateDisplay(result);
 firstNumber = '';
 operation = '';
 waitingForSecondNumber = false;
}

// 3D функции
function rotateX() {
 currentX += 15;
 calculator.style.transform = `rotateX(${currentX}deg) rotateY(${currentY}deg)`;
}

function rotateY() {
 currentY += 15;
 calculator.style.transform = `rotateX(${currentX}deg) rotateY(${currentY}deg)`;
}

function resetRotation() {
 currentX = 0;
 currentY = 0;
 calculator.style.transform = `rotateX(${currentX}deg) rotateY(${currentY}deg)`;
}

// Обработчики событий
document.querySelectorAll('button:not(.control-btn)').forEach(button => {
 button.addEventListener('click', () => {
  if (button.classList.contains('operator')) {
   handleOperator(button.textContent);
  } else if (button.classList.contains('equals')) {
   calculate();
  } else if (button.classList.contains('clear')) {
   handleClear();
  } else {
   handleNumber(button.textContent);
  }
 });
});

const checkbox_StatusRotation = document.getElementById('StatusRotation');

// Функция для обработки движения мыши
function handleMouseMove(e) {
 const x = -(window.innerWidth / 2 - e.clientX) / 5;
 const y = (window.innerHeight / 2 - e.clientY) / 5;
 calculator.style.transform = `rotateX(${currentX + y}deg) rotateY(${currentY + x}deg)`;
}

function StatusRotation() {
 if (checkbox_StatusRotation.checked) {
  // Включаем эффект
  document.addEventListener('mousemove', handleMouseMove);
 } else {
  // Выключаем эффект
  document.removeEventListener('mousemove', handleMouseMove);
 }
}

const checkbox_autoRotation = document.getElementById('autoRotation');


function autoRotation() {
 if (checkbox_autoRotation.checked) {
  calculator.style.animation = `autoRotation 10s linear infinite`;
 } else {
  calculator.style.animation = 'none';
 }
}

StatusRotation();//включаем эффект
autoRotation();//включаем автоповорот