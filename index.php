<?php
/**
 * @author Oleg Kurganov [xxxlegoleg@gmail.com]
 * @since PHP 7.4
 */

require_once 'helper/autoload.php';

use core\Database;
use core\Api;

$_CONFIG = require 'config/bot.php';
$DB_CONFIG = require 'config/db.php';

$db_client = null;

if ($DB_CONFIG) {
    $db = new Database($DB_CONFIG);
    $db_client = $db->connect();
}

$api = new Api($_CONFIG, $db_client);

$api->start();