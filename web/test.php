<?php
// Read the configuration.
$module_data = \Drupal::config('core.extension')->get('webserver_auth');

// Unset the modules you do not need.
unset($module_data['migrate_ui']);
unset($module_data['migrate_api']);

// Write the configuration.
\Drupal::configFactory()->getEditable('core.extension')->set('webserver_auth', $module_data)->save();

