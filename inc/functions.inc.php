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
    // amounts
    for ($j = 0; $j < count(PRICES); $j++) {
      array_push($amount, rand(MIN_AMOUNT, MAX_AMOUNT));
    }

    $sum = getSums($amount);

    // discount
    $discount = getDiscountedPercentage($sum);

    // total including tax
    $total = getTotalIncludingTax($sum, $discount);

    $order = [
      "id" => "order_" . $i + 1,
      "amount" => $amount,
      "discount" => $discount,
      "subTotal" => $total
    ];
    array_push($orderData, $order);
  }
  return $orderData;
}
function getSums($amount)
{
  $sum = 0;
  for ($i = 0; $i < count($amount); $i++) {
    $sum += $amount[$i] * array_values(PRICES)[$i];
  }
  return $sum;
}
function getDiscountedPercentage($sum)
{
  $rate = 0;
  foreach (DISCOUNT_RATES as $key => $val) {
    if ($sum < $key) {
      return $rate;
    }
    $rate = $val;
  }
  return $rate;
}
function getTotalIncludingTax($sum, $discount)
{
  return $sum * (1 - $discount) * (1 + TAX_PERCENTAGE);
}

function printOrder()
{
  $count = 1;
  do {
    $orderData = generateOrder();
    echo "\nOrder record: " . $count++ . "\n";
    echo "Order\tProduct A\tProduct B\tProduct C\tDiscount\tSub Total\n";

    foreach ($orderData as $order) { // each order
      // id
      echo $order["id"] . "\t";

      // each product
      foreach ($order["amount"] as $key => $amount) {
        echo $amount . "\t\t";
      }

      // discount
      echo $order["discount"] * 100 . "%\t";

      // order
      echo "$" . number_format($order["subTotal"], 2) . "\n";
    }

    echo "Do you want to add another record of order(Y/N)";
    $input = stream_get_line(STDIN, 1024, PHP_EOL);
  } while (strtoUpper($input) == "Y");
}
