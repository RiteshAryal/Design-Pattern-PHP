<?php
namespace decorators;

use components\Beverage;

class Soy extends CondimentDecorator
{
    /* @var components\Beverage */
    protected $beverage;
    
    public function __construct(Beverage $beverage)
    {
        $this->beverage = $beverage;
    }
    
    public function getDescription()
    {
        return $this->beverage->getDescription() . ", Soy";
    }
    
    public function cost()
    {
        return .15 + $this->beverage->cost();
    }
}
