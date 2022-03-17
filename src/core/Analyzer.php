<?php
/**
 * @author Oleg Kurganov [xxxlegoleg@gmail.com]
 * @since PHP 7.4
 */

namespace core;

use core\commands\base\Text;

class Analyzer {
    private $data;

    private array $chat_config;

    public $INPUTS;

    public function __construct($data) {
        /**
         * All inputs from /inputs folder were here
         */
        $this->INPUTS = require_once($_SERVER['DOCUMENT_ROOT'] . '/src/inputs/index.php');
        $this->data = $data;
        $this->chat_config = Array(
            'chat_id' => $data['chat']['id'],
        );
    }

    public function analyze(): void {
        $data = $this->data;
        $message = mb_strtolower(($data['text'] ?: $data['data']),'utf-8');
        $this->analyzeInput($message);
    }

    private function analyzeInput($message): void {
        $api = $GLOBALS['apiClient'];

        $default = new Text('Слушай, такой комманды нету, соре');

        if (array_key_exists($message, $this->INPUTS)) {
            $handler = $this->INPUTS[$message];

            if (is_callable($handler)) {
                $handler();
            }
        } else {
            $api->sendCommand($default->getRequestData());
        }

    }
}