<?php

class WeatherForecast extends WeatherAppModel {
    public $belongsTo = array(
        'WeatherCurrent' => array(
            'className' => 'Weather.WeatherCurrent'
        )
    );
}
