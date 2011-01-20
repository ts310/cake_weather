<?php

class WeatherCity extends WeatherAppModel {
    public $actsAs = array(
        'Containable'
    );

    public $hasMany = array(
        'WeatherCurrent' => array(
            'className' => 'Weather.WeatherCurrent',
            'dependent' => true
        )
    );

    public $validate = array(
        'name' => array(
            'require' => array(
                'rule' => 'notEmpty',
                'message' => 'Name is required'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Same name already exists'
            )
        ),
        'display_name' => array(
            'require' => array(
                'rule' => 'notEmpty',
                'message' => 'Display name is required'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Same display name already exists'
            )
        ),
        'woeid' => array(
            'require' => array(
                'rule' => 'notEmpty',
                'message' => 'Weather ID is required'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Weather ID already exists'
            )
        )
    );
}

