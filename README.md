# SDK em PHP para cálculo de taxas flexíveis

## Instalação

```
composer require branvo/tax-calculator
```

## Inicializando o objeto

```php
<?php

require_once './vendor/autoload.php';

$calculator = new \Calculator\TaxCalculator([
    'baseTax' => 2.00,
    'anticipationMonthlyTax' => 5.00,
    'daysToReceive' => 30,
    'cashback' => 1.00,
    'tributes' => 6.00,
    'profit' => 4.00
]);
```

## Parâmetros do construtor

 1. `baseTax`: Taxa mínima, pode ser considerar a taxa paga para o adquirente;
 2. `anticipationMonthlyTax`: Taxa cobrada ao mês para antecipar, ou seja, receber em menos de 30 dias;
 3. `daysToReceive`: Dias para recebimento dos valores;
 4. `cashback`: Porcentagem que o estabelecimento irá fornecer de cashback. Se for NULL, não considerará o cashback no cálculo.
 5. `tributes`: Porcentagem de impostos pagos.
 6. `profit`: Porcentagem de lucro desejado.

## Obtendo o resultado do cálculo

```php
$calculator->calculate();
var_dump($calculator->getResult());

// e.g. '2.29'
```

## Exemplos

Para exemplos, veja a pasta `examples`