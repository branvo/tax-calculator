<?php

require '../vendor/autoload.php';

$params = ['anticipationMonthlyTax' => 4.99, 'cashback' => 1.00, 'daysToReceive' => 30, 'profit' => 0.00];
$calculator = new \Calculator\TaxCalculator($params);

$calculator->calculate();
$tax = $calculator->getResult();

$valor = 100;

echo '<h2>Simulação APP:</h2>';

echo '<h4>Parâmetros:</h4>';

echo '<pre>';
var_dump($params);
echo '</pre><br/>';

echo 'Valor: ' . $valor . '<br/>';
echo 'Taxa do cartão: ' . $calculator->getResult() . '<br/>';
echo 'Cashback: ' . $calculator->getCashback() . '<br/>';
echo 'Total de taxa paga pelo cliente (Valor * (Taxa+Cashback)): ' . ($valor * (($tax + $calculator->getCashback())/100)) . '<br/>';
echo 'Total de taxa paga pela branvo (Valor * Taxa Cielo): ' . ($valor * 0.02) . '<br/>';
echo 'Receita branvo (Valor * (Taxa+Cashback/2)): ' . ($valor * (($tax + $calculator->getCashback() / 2)/100)) . '<br/>';

$imposto = number_format(($valor * (($tax + $calculator->getCashback() / 2)/100))*($calculator->getTributes()/100), 2, '.', '');

echo 'Imposto (Receita branvo * 14.33%): ' . $imposto . '<br/>';
echo 'Receita branvo sem imposto (Receita branvo - total pago pela branvo): ' . (($valor * (($tax + $calculator->getCashback() / 2)/100)) - ($valor * 0.02)) . '<br/>';
echo 'Lucro branvo (Receita branvo - total pago pela branvo - imposto): ' . (($valor * (($tax + $calculator->getCashback() / 2)/100)) - ($valor * 0.02) - $imposto) . '<br/>';
