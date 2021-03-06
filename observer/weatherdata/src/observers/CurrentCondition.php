<?php
/**
 * Concrete observers can be any class that implements the Observer interface.
 * Each observer registers with a concrete subject to receive updates.
 *
 * This display element shows the current measurements from the WeatherData
 * Object
 */
namespace observers;

use subject\WeatherData;

class CurrentCondition implements DisplayElementInterface, ObserverInterface
{
    private $temperature;
    private $humidity;
    private $pressure;
    private $weatherData;
    
    public function __construct(WeatherData $wd)
    {
        $this->weatherData = $wd;
        $this->weatherData->registerObserver($this);
    }

    public function update($temperature, $humidity, $pressure)
    {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        
        $this->display();
    }

    public function display()
    {
        echo "\n";
        echo "Current conditions: " . $this->temperature .
                "F, Humidity: " . $this->humidity .
                "% and Pressure: " . $this->pressure;
    }
}
