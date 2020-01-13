<?php

namespace Calculator;

class TaxCalculator {
    const DEFAULT_DAYS = 30;

    private $baseTax = 2.00;
    private $anticipationMonthlyTax;
    private $daysToReceive = 30;
    private $cashback = 1.00;
    private $tributes = 14.33;
    private $profit = 0;
    private $result;

    public function __construct(array $params = []) {
        foreach($params as $i => $param) {
            $method = 'set' . ucfirst(strtolower($i));
            if(!method_exists($this, $method)) {
                continue;
            }

            $this->$method($param);
        }
    }

    public function calculate() {
        if($this->cashback === null) {
            return $this->calculateWithoutCashback();
        }
        
        return $this->calculateWithCashback();
    }

    private function calculateWithoutCashback() {
        $tributesPercentage = $this->baseTax * ($this->tributes / 100);

        $this->result = $this->baseTax + $tributesPercentage;
        $this->calculateAnticipation();
        $this->calculateProfit();
    }

    private function calculateWithCashback() {
        $this->baseTax -= ($this->cashback / 2);
        $tributesPercentage = ($this->baseTax + $this->cashback) * ($this->tributes / 100);

        $this->result = $this->baseTax + $tributesPercentage;
        $this->calculateAnticipation();
        $this->calculateProfit();
    }

    private function calculateAnticipation() {
        $dailyAnticipation = $this->anticipationMonthlyTax / 30;
        if(!empty($dailyAnticipation) && $this->daysToReceive < self::DEFAULT_DAYS) {
            $this->result += ($this->result * ((($dailyAnticipation) * (self::DEFAULT_DAYS - $this->daysToReceive))/100));
        } else if(!empty($dailyAnticipation) && $this->daysToReceive > self::DEFAULT_DAYS) {
            $this->result -= ($this->result * ((($dailyAnticipation) * ($this->daysToReceive - self::DEFAULT_DAYS))/100));
        }
    }

    private function calculateProfit() {
        if(empty($this->profit)) {
            return;
        }

        $this->result += $this->result * ($this->profit / 100);
    }

    public function getBaseTax() {
        return $this->baseTax;
    }

    public function setBaseTax($baseTax) {
        $this->baseTax = $baseTax;
        return $this;
    }

    public function getAnticipationMonthlyTax() {
        return $this->anticipationMonthlyTax;
    }

    public function setAnticipationMonthlyTax($anticipationMonthlyTax) {
        $this->anticipationMonthlyTax = $anticipationMonthlyTax;
        return $this;
    }

    public function getDaysToReceive() {
        return $this->daysToReceive;
    }

    public function setDaysToReceive($daysToReceive) {
        $this->daysToReceive = $daysToReceive;
        return $this;
    }

    public function getCashback() {
        return $this->cashback;
    }

    public function setCashback($cashback) {
        $this->cashback = $cashback;
        return $this;
    }

    public function getResult() {
        return number_format($this->result, 2, '.', '');
    }

    public function setResult($result) {
        $this->result = $result;
        return $this;
    }

    public function getProfit() {
        return $this->profit;
    }

    public function setProfit($profit) {
        $this->profit = $profit;
        return $this;
    }

    public function getTributes() {
        return $this->tributes;
    }

    public function setTributes($tributes) {
        $this->tributes = $tributes;
        return $this;
    }
}