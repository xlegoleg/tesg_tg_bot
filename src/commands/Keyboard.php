<?php


namespace commands;


class Keyboard extends Command {

    protected array $template = Array(
        'text' => 'keyboard',
        'reply_markup' => [
            'keyboard' => [],
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ]
    );

    public function __construct($chat_config, $command_config)
    {
        parent::__construct($chat_config, $command_config);
    }

    protected function prepareConfigToTemplate($command_config): array {
        $template = $this->template;
        //$template['reply_markup'] = json_encode($keyboard, JSON_FORCE_OBJECT);
        $keyboard = [
            [['text'=>'Кнопка 1'],['text'=>'Кнопка 2']] // Первый ряд кнопок
            ,['Простая кнопка',['text'=>'Кнопка 4']] // Второй ряд кнопок
        ];
        $template['reply_markup']['keyboard'] = $keyboard;
        $template['reply_markup'] = json_encode($template['reply_markup']);
        return $template;
    }
}