<?php
// auto-fix HTTPS if behind a load balancer
if (getenv('HTTPS') !== 'on' && getenv('HTTP_X_FORWARDED_PROTO') === 'https') {
  $_SERVER['HTTPS'] = 'on';
}
// Settings for OpenShift S2I deployment
$databases['default']['default'] = array (
  'database' => $_ENV['DB_NAME'],
  'username' => $_ENV['DB_USERNAME'],
  'password' => $_ENV['DB_PASSWORD'],
  'host' => $_ENV['DB_HOST'],
  'port' => '',
  'driver' => $_ENV['DB_TYPE'],
  'prefix' => '',
);
$settings['hash_salt'] = $_ENV['DRUPAL_HASH_SALT'];
$settings['install_profile'] = 'agov';


