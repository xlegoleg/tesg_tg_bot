<?php


namespace core;


use commands\base\CallbackButton;
use commands\base\LinkButton;
use commands\base\Text;
use commands\group\Keyboard;

class Analyzer {
    private $data;

    private array $chat_config;

    public $INPUTS;

    public function __construct($data) {
        $this->INPUTS = require_once($_SERVER['DOCUMENT_ROOT'] . '/src/inputs/index.php');
        $this->data = $data;
        $this->chat_config = Array(
            'chat_id' => $data['chat']['id'],
        );
    }

    public function analyze(): array {
        $data = $this->data;
        $message = mb_strtolower(($data['text'] ?: $data['data']),'utf-8');
        $command = $this->getDataFromCommands($message);
        return $this->presetChatCommand($command);
    }

    private function getDataFromCommands($message): array {
        $default = new Text('Слушай, такой комманды нету, соре');

        if (array_key_exists($message, $this->INPUTS)) {
            $command = $this->INPUTS[$message];
            return $command->getRequestData();
        }
        return $default->getRequestData();
    }

    private function presetChatCommand($command): array {
        $preset = $command;
        $preset['chat_id'] = $this->chat_config['chat_id'];
        return $preset;
    }
}