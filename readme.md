## Pinnacle Estate Laravel 5.1

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

ALTER TABLE `properties` ADD `is_paid` INT(11) NOT NULL DEFAULT '0' AFTER `status`, ADD `payment_id` INT(11) NULL DEFAULT NULL AFTER `is_paid`, ADD `plan_type` INT(11) NULL DEFAULT NULL AFTER `payment_id`;

CREATE TABLE `pinnacle_estate`.`payments` ( `id` INT NOT NULL AUTO_INCREMENT , `txnid` VARCHAR(30) NOT NULL , `payment_amount` INT(11) NOT NULL , `payment_status` VARCHAR(255) NOT NULL , `user_id` INT(11) NOT NULL , `status` TINYINT NOT NULL , `created_at` TIMESTAMP NOT NULL , `updated_at` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;


CREATE TABLE `pinnacle_estate`.`plans` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) NOT NULL , `price` INT(11) NOT NULL , `created_at` TIMESTAMP NOT NULL , `updated_at` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


ALTER TABLE `plans` ADD `type` ENUM('sale','rent','','') NOT NULL DEFAULT 'rent' AFTER `price`;

INSERT INTO `plans` (`id`, `title`, `price`, `created_at`, `updated_at`) VALUES (NULL, 'INTRODUCTION  PACK', '199', CURRENT_TIMESTAMP, '0000-00-00 00:00:00.000000');

INSERT INTO `plans` (`id`, `title`, `price`, `created_at`, `updated_at`) VALUES (NULL, 'Management Pack', '5', CURRENT_TIMESTAMP, '0000-00-00 00:00:00.000000');


INSERT INTO `plans` (`id`, `title`, `price`, `type`, `created_at`, `updated_at`) VALUES (NULL, 'Bronze Package', '299', 'sale', CURRENT_TIMESTAMP, '0000-00-00 00:00:00.000000'), (NULL, 'Silver Package', '499', 'sale', CURRENT_TIMESTAMP, '0000-00-00 00:00:00.000000');

INSERT INTO `plans` (`id`, `title`, `price`, `type`, `created_at`, `updated_at`) VALUES (NULL, 'Gold Package', '599', 'sale', CURRENT_TIMESTAMP, '0000-00-00 00:00:00.000000');