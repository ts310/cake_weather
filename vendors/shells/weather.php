<?php

App::import('Vendor', 'SimplePieAutoloader', array(
    'file'   => 'simplepie' . DS . 'SimplePieAutoloader.php',
    'plugin' => 'weather'
));
App::import('Vendor', 'simplepie_yahoo_weather.inc', array(
    'file'   => 'simplepie_yahoo_weather.inc',
    'plugin' => 'weather'
));

class WeatherShell extends Shell {

    private $apiURL = 'http://weather.yahooapis.com/forecastrss';

    public $uses = array('Weather.WeatherCity', 'Weather.WeatherCurrent', 'Weather.WeatherForecast');

    public function main() {
    }

    public function help() {
    }

    public function update() {
        $cities = $this->WeatherCity->find('all');
        if ($cities) {
            foreach ($cities as $key => $item) {
                $this->getCityFeed($item['WeatherCity']['id'], $item['WeatherCity']['woeid']);
            }
        }
        $this->cleanup();
    }

    public function getCityFeed($cityId, $cityWoeid) {
        $city = $this->WeatherCity->findById($cityId);
        try {
            $handle = fopen($this->apiURL . '?u=c&w=' . $cityWoeid, 'r');
            $contents = stream_get_contents($handle);
            fclose($handle);
            $response = trim($contents);
            if (!empty($response)) {
                $this->parseCityFeed($response, $cityId);
            }
            $log = sprintf('Finished importing %s at %s', $city['WeatherCity']['name'], date('Y-m-d H:i:s', time()));
            $this->out($log);
            // $this->log($log, 'weather_cron');
        } catch (Exception $e) {
            $this->out($e->getMessage());
        }
    }

    private function parseCityFeed($response, $cityId) {
        $feed = new SimplePie();
        $feed->set_raw_data($response);
        $feed->set_item_class('SimplePie_Item_YWeather');
        $feed->enable_cache(false);
        $feed->init();
        $weather = $feed->get_item(0);

        $data = array(
            'permalink'       => $feed->get_permalink(),
            'condition_image' => $weather->get_condition_image(),
            'title'           => $feed->get_title(),
            'conditions'      => $weather->get_condition(),
            'temperature'     => $weather->get_temperature(),
            'units_temp'      => $weather->get_units_temp(),
            'wind_chill'      => $weather->get_wind_chill(),
            'units_temp'      => $weather->get_units_temp(),
            'wind_speed'      => $weather->get_wind_speed(),
            'units_speed'     => $weather->get_units_speed(),
            'wind_direction'  => $weather->get_wind_direction(),
            'sunrise'         => $weather->get_sunrise(),
            'sunset'          => $weather->get_sunset(),
            'code'            => $weather->get_condition_code()
        );
        $this->WeatherCurrent->create();
        $created = $this->WeatherCurrent->getLastInsertId();
        $data['weather_city_id'] = $cityId;
        $current = $this->WeatherCurrent->save($data);
        if ($current) {
            $currentId = $this->WeatherCurrent->id;
            foreach ($weather->get_forecasts() as $forecast) {
                $forecast = array(
                    'weather_current_id' => $currentId,
                    'date'               => $forecast->get_date('Y-m-d'),
                    'low'                => $forecast->get_low(),
                    'high'               => $forecast->get_high(),
                    'label'              => $forecast->get_label()
                );
                $this->WeatherForecast->create();
                $this->WeatherForecast->save($forecast);
            }
        }
        return $created;
    }

    private function cleanup() {
        $expiration = '-10minutes';
        $this->WeatherCurrent->deleteAll(array(
            'WeatherCurrent.created <=' => date('Y-m-d H:i:s', strtotime($expiration))
        ));
    }

    public function add() {
        $data = array();
        $data['name'] = $this->in('Please enter city name');
        $data['display_name'] = $this->in('Please enter  display city name');
        $data['woeid'] = $this->in('Please enter Yahoo WOEID');
        $this->WeatherCity->create();
        $saved = $this->WeatherCity->save($data);
        if ($saved) {
            $this->out(sprintf('New city %s is added', $saved['WeatherCity']['name']));
        }
    }
}
