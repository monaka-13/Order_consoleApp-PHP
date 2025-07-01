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
      array_push($amount, rand(MIN_AMOUNT, MAX_AMOUNT));
    }
    $order = [
      "id" => "order_" . $i + 1,
      "amount" => $amount,
      "discount" => 15, // TODO
      "subTotal" => 495.04 // TODO
    ];
    array_push($orderData, $order);
  }
  return $orderData;
}

function printOrder($orderData)
{
$count=1;
  do {
    echo "\nOrder record: " . $count . "\n";
    echo "Order\tProduct A\tProduct B\tProduct C\tDiscount\tSub Total\n";

    foreach ($orderData as $key=>$order) {
      echo $order["id"] . "\t";
      foreach ($order["amount"] as $key => $val) {
        echo $val . "\t\t";
      }
      echo $order["discount"] . "\t\t";
      echo $order["subTotal"] . "\n";
    }
    echo "Do you want to add another record of order(Y/N)";
    $input = stream_get_line(STDIN, 1024, PHP_EOL);
    $count++;
  } while (strtoUpper($input) == "Y");
}
