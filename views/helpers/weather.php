<?php

class WeatherHelper extends Helper {

    public $helpers = array('Html');

    public $codes = array(
        0    => 'tornado',
        1    => 'tropical storm',
        2    => 'hurricane',
        3    => 'severe thunderstorms',
        4    => 'thunderstorms',
        5    => 'mixed rain and snow',
        6    => 'mixed rain and sleet',
        7    => 'mixed snow and sleet',
        8    => 'freezing drizzle',
        9    => 'drizzle',
        10   => 'freezing rain',
        11   => 'showers',
        12   => 'showers',
        13   => 'snow flurries',
        14   => 'light snow showers',
        15   => 'blowing snow',
        16   => 'snow',
        17   => 'hail',
        18   => 'sleet',
        19   => 'dust',
        20   => 'foggy',
        21   => 'haze',
        22   => 'smoky',
        23   => 'blustery',
        24   => 'windy',
        25   => 'cold',
        26   => 'cloudy',
        27   => 'mostly cloudy (night)',
        28   => 'mostly cloudy (day)',
        29   => 'partly cloudy (night)',
        30   => 'partly cloudy (day)',
        31   => 'clear (night)',
        32   => 'sunny',
        33   => 'fair (night)',
        34   => 'fair (day)',
        35   => 'mixed rain and hail',
        36   => 'hot',
        37   => 'isolated thunderstorms',
        38   => 'scattered thunderstorms',
        39   => 'scattered thunderstorms',
        40   => 'scattered showers',
        41   => 'heavy snow',
        42   => 'scattered snow showers',
        43   => 'heavy snow',
        44   => 'partly cloudy',
        45   => 'thundershowers',
        46   => 'snow showers',
        47   => 'isolated thundershowers',
        3200 => 'not available'
        );

    public function icon($code = null, $options = array()) {
        if (!$code) {
            return;
        }
        $image = null;
        if (in_array($code, array(4))) {
            $image = 'thunderstorms';
        }
        if (in_array($code, array(26))) {
            $image = 'thunderstorms';
        }
        if (in_array($code, array(11,12))) {
            $image = 'showers';
        }
        if (in_array($code, array(27,28,29,30,33,34,44))) {
            $image = 'partly-cloudy';
        }
        if (in_array($code, array(32,36))) {
            $image = 'sunny';
        }
        if ($image) {
            $image = 'weather/' . $image;
            if (!empty($options['size'])) {
                if ($options['size'] == 'l') {
                    $image .= '@2x';
                }
            }
            $image .= '.png';
            return $this->Html->image($image, array('alt' => $this->codes[$code]));
        }
        if (!empty($options['image'])) {
            return $this->Html->image($options['image'], array('alt' => $this->codes[$code]));
        }
    }
}
