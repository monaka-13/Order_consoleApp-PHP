<?php

function getHeader()
{
  echo "----------\nProduct order calculator app by " . DEVELOPER . "\n----------\n";
}
function generateOrder()
{
  $orderData = [];
  for ($i = 0; $i < NUMBER_OF_ORDER; $i++) {
    $amount = [];
    for ($j = 0; $j < count(PRICES); $j++) {
      $amount[] = rand(MIN_AMOUNT, MAX_AMOUNT);
    }
    $order = [
      'id' => "order_" . $i + 1,
      'amount' => $amount
    ];
    array_push($orderData, $order);
  }
  return $orderData;
}
?>