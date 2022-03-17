<?php
/**
 * @author Oleg Kurganov [xxxlegoleg@gmail.com]
 * @since PHP 7.4
 */

namespace core\commands\base;


class LinkButton extends Command {
    protected array $template = [
        'text' => 'default',
        'url' => 'https://google.com'
    ];

    public function __construct($text, $url)
    {
        parent::__construct($text, $url);
    }

    protected function prepareConfigToTemplate(...$configuration) {
        $this->template['text'] = $configuration[0];
        $this->template['url'] = $configuration[1];
    }
}