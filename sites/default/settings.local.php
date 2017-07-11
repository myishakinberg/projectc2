<?php
/**
 * Created by PhpStorm.
 * User: myishakinberg
 * Date: 6/16/17
 * Time: 10:39 AM
 */

$databases['default']['default'] = array (
    'database' => 'projectc',
    'username' => 'root',
    'password' => 'password',
    'prefix' => '',
    'host' => 'localhost',
    'port' => '3306',
    'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
    'driver' => 'mysql',
);
$settings['container_yamls'][] = DRUPAL_ROOT . '/sites/default/services.dev.yml';
