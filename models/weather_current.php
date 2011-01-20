<?php

class WeatherCurrent extends WeatherAppModel {
    public $belongsTo = array(
        'WeatherCity' => array(
            'className' => 'Weather.WeatherCity'
        )
    );
    public $hasMany = array(
        'WeatherForecast' => array(
            'className' => 'Weather.WeatherForecast',
            'dependent' => true
        )
    );
}
