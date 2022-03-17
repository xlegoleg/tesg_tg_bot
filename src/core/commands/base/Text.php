<?php


namespace core\commands\base;

// TODO переписать команды по сущностям, и потом новые сущности списка комманд

class Text extends Command {

    protected array $template = [
        'text' => 'default'
    ];

    public function __construct($text)
    {
        parent::__construct($text);
    }

    protected function prepareConfigToTemplate(...$configuration) {
        $this->template['text'] = $configuration[0];
    }
}