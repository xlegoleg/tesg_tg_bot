<?php
require_once 'helper/autoload.php';

$_CONFIG = require 'config/bot.php';

$api = new core\Api($_CONFIG, null);

$api->delete();