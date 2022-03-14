<?php


namespace commands\group;


use commands\base\CallbackButton;
use commands\base\Command;

class Keyboard extends Command {

    protected array $template = Array(
        'text' => 'keyboard',
        'reply_markup' => [
            'inline_keyboard' => [],
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ]
    );

    public function __construct($buttons)
    {
        parent::__construct($buttons);
    }

    protected function prepareKeyboardRow($row): array {
        return array_map(fn($button): array => $button->getRequestData(), $row);
    }

    protected function prepareConfigToTemplate($rows) {
        $keyboard = array_map(fn(array $row): array => $this->prepareKeyboardRow($row), $rows);
        $this->template['reply_markup']['inline_keyboard'] = $keyboard;
        $reply = json_encode($this->template['reply_markup']);
        $this->template['reply_markup'] = $reply;
        echo "TEMPLATE FINAL: ...\n";
        var_dump($this->template);
        echo "TEMPLATE_END FINAL: ...\n";
    }
}