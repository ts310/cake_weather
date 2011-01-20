<?php

class WeatherController extends WeatherAppController {
    
    public $uses = array('Weather.WeatherCity' , 'Weather.WeatherCurrent');

    public function index() {
        $this->paginate['WeatherCurrent'] = array(
            'contain' => false,
            'limit' => 5
        );
        $data = $this->paginate('WeatherCurrent');
        $this->set('data', $data);
    }

    public function delete($id) {
        $data = $this->_getWeatherCurrent($id);
        $deleted = $this->WeatherCurrent->delete($id);
        if ($deleted) {
            $this->redirect(array('action' => 'index'));
        }
    }

    private function _getWeatherCurrent($id = null) {
        $data = $this->WeatherCurrent->findById($id);
        if (!$data) {
           $this->redirect(array('action' => 'index')); 
        }
        return $data;
    }
}
