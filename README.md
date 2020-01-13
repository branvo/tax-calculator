# SDK para cálculo de taxas flexíveis

## Inicializando o objeto

```$calculator = new \Calculator\TaxCalculator([
    'baseTax' => 2.00,
    'anticipationMonthlyTax' => 5.00,
    'daysToReceive' => 30,
    'cashback' => 1.00,
    'tributes' => 6.00,
    'profit' => 4.00
]);```

## Parâmetros do construtor

 1. baseTax: Taxa mínima, pode ser considerar a taxa paga para o adquirente;
 2. anticipationMonthlyTax: Taxa cobrada ao mês para antecipar, ou seja, receber em menos de 30 dias;
 3. daysToReceive: Dias para recebimento dos valores;
 4. cashback: Porcentagem que o estabelecimento irá fornecer de cashback. Se for NULL, não considerará o cashback no cálculo.
 5. tributes: Porcentagem de impostos pagos.
 6. profit: Porcentagem de lucro desejado.