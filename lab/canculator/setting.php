<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);

  if (isset($data['action'])) {
    switch ($data['action']) {
      case 'calculate':
        $result = calculate($data['num1'], $data['num2'], $data['operation']);
        echo json_encode(['result' => $result]);
        break;
      case 'clear':
        echo json_encode(['result' => '0']);
        break;
      default:
        echo json_encode(['error' => 'Invalid action']);
    }
  }
}

function calculate($num1, $num2, $operation): float|string
{
  switch ($operation) {
    case '+':
      return $num1 + $num2;
    case '-':
      return $num1 - $num2;
    case '*':
      return $num1 * $num2;
    case '/':
      return $num2 != 0 ? $num1 / $num2 : "Error";
    default:
      return "Error";
  }
}
?>