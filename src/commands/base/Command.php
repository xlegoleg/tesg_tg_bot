<?php


namespace commands\base;


use interfaces\ICommand;

abstract class Command implements ICommand {
    protected array $template;

    public function __construct(...$configuration) {
        $this->prepareConfigToTemplate(...$configuration);
    }

    public function getRequestData(): array {
        return $this->template;
    }

    protected function prepareConfigToTemplate(...$configuration) {
    }
}