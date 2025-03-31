<?php

function solveEquation($equation)
{
    // Убираем пробелы из уравнения
    $equation = str_replace(' ', '', $equation);

    // Разделяем уравнение на левые и правые части
    list($left, $right) = explode('=', $equation);

    $unknown = null;
    $value = null;

    if (preg_match('/X/', $left)) {
        // Находим 'X' в левой части
        $unknown = 'left';
        $leftResult = calculateRightSide($right);
        $value = solveForX($left, $leftResult);
    } elseif (preg_match('/X/', $right)) {
        // Находим 'X' в правой части
        $unknown = 'right';
        $rightResult = calculateLeftSide($left);
        $value = solveForX($right, $rightResult);
    } else {
        return "Необходимо указать переменную X в уравнении.";
    }

    return [
        'unknownSide' => $unknown,
        'X' => $value,
    ];
}

function calculateRightSide($expression)
{
    // Решаем правую часть выражения
    eval ("\$result = $expression;");
    return $result;
}

function calculateLeftSide($expression)
{
    // Решаем левую часть выражения
    eval ("\$result = $expression;");
    return $result;
}

function solveForX($expression, $result)
{
    // Найдем значение X в выражении
    if (preg_match('/X\*(\d+)/', $expression, $matches)) {
        return $result / $matches[1];
    } elseif (preg_match('/(\d+)\*X/', $expression, $matches)) {
        return $result / $matches[1];
    } elseif (preg_match('/X\+(\d+)/', $expression, $matches)) {
        return $result - $matches[1];
    } elseif (preg_match('/(\d+)\+X/', $expression, $matches)) {
        return $result - $matches[1];
    } elseif (preg_match('/-(X)/', $expression)) {
        return -($result);
    } elseif (preg_match('/(\d+)-(X)/', $expression, $matches)) {
        return $matches[1] - $result;
    } elseif (preg_match('/(\d+)\/X/', $expression, $matches)) {
        return $matches[1] / $result;
    } elseif (preg_match('/X\/(\d+)/', $expression, $matches)) {
        return $result * $matches[1];
    }
    return null;
}

// Примеры уравнений
$equations = [
    "X + 3 = 7",
    "27 - X = 17",
    "6/X = 2",
    "X/8=6",
    "22 * X = 220",
    "X * 7 = 49",
    "10 + X = 33",
    "X + 67 = 129",
    "4 * X = 36",
    "X * 9 = 56",
];

foreach ($equations as $eq) {
    $result = solveEquation($eq);
    echo "Уравнение: $eq. Значение X: " . $result['X'] . "\n";
}
?>