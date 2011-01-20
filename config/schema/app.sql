#weather sql generated on: 2011-01-20 22:25:01 : 1295529901

DROP TABLE IF EXISTS `weather_cities`;
DROP TABLE IF EXISTS `weather_currents`;
DROP TABLE IF EXISTS `weather_forecasts`;


CREATE TABLE `weather_cities` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`display_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`woeid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`id`))	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `weather_currents` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`weather_city_id` int(11) DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,
	`permalink` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`condition_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`conditions` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`temperature` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`units_temp` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`wind_chill` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`wind_speed` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`units_speed` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`wind_direction` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`sunrise` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`sunset` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY `weather_city_id` (`weather_city_id`))	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `weather_forecasts` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`weather_current_id` int(11) DEFAULT NULL,
	`low` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`high` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`date` date DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY `weather_current_id` (`weather_current_id`))	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

