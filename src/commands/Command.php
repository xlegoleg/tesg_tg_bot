<?php


namespace commands;


use interfaces\ICommand;

abstract class Command implements ICommand {
    protected $chat_id;

    protected array $template;

    public function __construct($chat_config, $command_config) {
        $this->chat_id = $chat_config['chat_id'];
        $this->template = $this->prepareConfigToTemplate($command_config);
    }

    public function getRequestData(): array {
        $chatSettings = ['chat_id' => $this->chat_id];
        return array_merge($chatSettings, $this->template);
    }

    protected function prepareConfigToTemplate($command_config): array {
        return array_merge($this->template, $command_config);
    }
}