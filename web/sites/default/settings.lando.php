<?php

/**
 * @file
 * Local settings for Lando dev env.
 *
 * Make sure you include this at the very bottom of the settings.php or
 * settings.local.php file so that it can override the settings as required
 * to make your site work on your lando env.
 */

/**
 * Prepare a LANDO_INFO constant.
 *
 * Contains info which you can see using the "lando info" command. Use the
 * values in this constant to connect to the right Lando services.
 */
if (!defined('LANDO_INFO') && isset($_ENV['LANDO_INFO'])) {
  define('LANDO_INFO', json_decode($_ENV['LANDO_INFO'], TRUE));
}

// When using lando.
if (defined('LANDO_INFO')) {
  // One of "internal" or "external". Usually, "internal".
  define('LANDO_DATABASE', 'internal');

  // Databases.
  $databases['default']['default'] = [
    // Since "mariadb" drivers are the same as "mysql", we hard-code "mysql".
    'driver' => 'mysql',
    'database' => LANDO_INFO['database']['creds']['database'],
    'username' => LANDO_INFO['database']['creds']['user'],
    'password' => LANDO_INFO['database']['creds']['password'],
    'host' => LANDO_INFO['database'][LANDO_DATABASE . '_connection']['host'],
    'port' => LANDO_INFO['database'][LANDO_DATABASE . '_connection']['port'],
    'prefix' => '',
    'collation' => 'utf8mb4_general_ci',
  ];
}
