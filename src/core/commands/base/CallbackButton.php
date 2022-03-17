<?php


namespace core\commands\base;


class CallbackButton extends Command {

    protected array $template = [
        'text' => 'default',
        'callback_data' => 'default'
    ];

    public function __construct($text, $callback)
    {
        parent::__construct($text, $callback);
    }

    protected function prepareConfigToTemplate(...$configuration) {
        $this->template['text'] = $configuration[0];
        $this->template['callback_data'] = $configuration[1];
    }
}