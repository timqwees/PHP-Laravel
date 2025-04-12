<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>TimeQwees Calculator</title>
 <link rel="stylesheet" href="/src/style.css">
</head>

<body>
 <canvas id="gradient-canvas"></canvas>
 <div class="content-absolute">
  <div class="content">
   <div class="calculator">
    <div class="face face-front">
     <div class="display">0</div>
     <div class="buttons">
      <button class="number span-two clear">AC</button>
      <button class="number operator">×</button>
      <button class="number operator">÷</button>
      <button class="number">7</button>
      <button class="number">8</button>
      <button class="number">9</button>
      <button class="number operator">-</button>
      <button class="number">4</button>
      <button class="number">5</button>
      <button class="number">6</button>
      <button class="number operator">+</button>
      <button class="number">1</button>
      <button class="number">2</button>
      <button class="number">3</button>
      <button class="number equals">=</button>
      <button class="number span-two">0</button>
      <button class="number">.</button>
     </div>
    </div>
    <div class="face face-back">
     <h1>TimeQwees</h1>
    </div>
    <div class="face face-right"></div>
    <div class="face face-left"></div>
    <div class="face face-top"></div>
    <div class="face face-bottom"></div>
   </div>
  </div>

  <div class=" controls">
   <!-- content position -->
   <div class="position">
    <button class="control-btn" onclick="rotateX()">Поворот X</button>
    <button class="control-btn" onclick="rotateY()">Поворот Y</button>
    <button class="control-btn" onclick="resetRotation()">Сброс</button>
   </div>
   <!-- content move -->
   <div class="mover_timqwees_fantastic">
    <div class="item_timqwees_fantastic_position">
     <label for="StatusRotation">Управлять перемещением</label>
     <input type="checkbox" id="StatusRotation" onchange="StatusRotation()">
    </div>
    <div class="item_timqwees_fantastic_position">
     <label for="StatusRotation">Просмотр</label>
     <input type="checkbox" id="autoRotation" onchange="autoRotation()" checked>
    </div>
   </div>
  </div>
 </div>

 <span class="timqwees_sign">by your favourite TimQwees Technology</span>

 <!-- scripts -->
 <script defer src="/src/timqwees.js"></script>
 <script defer src="/src/canvas.js"></script>
</body>

</html>