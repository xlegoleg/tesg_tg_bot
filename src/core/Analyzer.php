<?php


namespace core;


use commands\Keyboard;
use commands\Text;

class Analyzer {
    private $data;

    private array $chat_config;

    public function __construct($data) {
        $this->data = $data;
        $this->chat_config = Array(
            'chat_id' => $data['chat']['id'],
        );
    }

    public function analyze(): array {
        $data = $this->data;
        $message = mb_strtolower(($data['text'] ?: $data['data']),'utf-8');
        return $this->getDataFromCommands($message);
    }

    private function getDataFromCommands($message): array
    {
        $key = new Keyboard($this->chat_config, [
            1, 2, 3
        ]);
        $text = new Text($this->chat_config, [
            'text' => 'test variant',
        ]);
        if ($message === 'test') {
            return $text->getRequestData();
        }
        if ($message === 'keyboard') {
            return $key->getRequestData();
        }
        return Array(
            'chat_id' => $this->chat_config['chat_id'],
            'text' => 'КУКУ'
        );
    }
}