<?php

class WeatherController extends WeatherAppController {
    
    public $uses = array('Weather.WeatherCity');

    public function index() {
        $this->paginate['WeatherCurrent'] = array(
            'contain' => false
        );
        $data = $this->paginate('WeatherCurrent');
        $this->set('data', $data);
    }
}
