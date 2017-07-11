<?php

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

$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;

if (file_exists($app_root . '/' . $site_path . '/settings.local.php')) {
    include $app_root . '/' . $site_path . '/settings.dev.php';
}