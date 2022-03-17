<?php
/**
 * @author Oleg Kurganov [xxxlegoleg@gmail.com]
 * @since PHP 7.4
 */

require_once 'helper/autoload.php';

$_CONFIG = require 'config/bot.php';

$api = new core\Api($_CONFIG, null);

var_dump($api->getApiInfo());

$api->register();