<?php
/**
 * @author Oleg Kurganov [xxxlegoleg@gmail.com]
 * @since PHP 7.4
 */

use core\commands\base\Text;

/**
 * Get Api instance
 */
$api = $GLOBALS['apiClient'];

$text = new Text('test command');

$admin = new Text('admin command');

/**
 * Initialize handlers
 */
$testCommand = function () use ($text, $api) {
    $api->sendCommand($text->getRequestData());
};

$adminCommand = function () use ($admin, $api) {
    $api->sendCommand($admin->getRequestData());
};

return $commands = [
    '/test' => $testCommand,
    '/admin' => $adminCommand
];