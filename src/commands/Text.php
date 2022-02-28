<?php


namespace commands;

// TODO переписать команды по сущностям, и потом новые сущности списка комманд

class Text extends Command {

    protected array $template = [
        'text' => 'default'
    ];

    public function __construct($chat_config, $command_config)
    {
        parent::__construct($chat_config, $command_config);
    }
}