<?php

/**
 * @author Oleg Kurganov [xxxlegoleg@gmail.com]
 * @since PHP 7.4
 */

namespace core;

use Error;

class Api {
    private $bot_name;

    private $bot_key;

    private $hook_url;

    private $chat_id;

    private $request;

    private $db_client;

    public function __construct($configuration, $db_client) {
        $this->bot_name = $configuration["bot_name"];
        $this->bot_key = $configuration["bot_key"];
        $this->hook_url = $configuration["hook_url"];
        $this->request = new Request($configuration["bot_key"]);
        $this->db_client = $db_client;
    }

    public function register(): void {
        $data = Array(
            "url" => $this->hook_url,
        );
        $result = $this->request->handleMessage('setWebhook', $data);
        var_dump($result);
    }

    public function delete(): void {
        $result = $this->request->handleMessage('deleteWebhook', null);
        var_dump($result);
    }

    public function start(): void {
        $analyzer = $this->initInputThread();

        try {
            $analyzer->analyze();
        } catch (Error $e) {
            file_put_contents('logs/bot_errors.txt', '$data: '.print_r($e, 1)."\n", FILE_APPEND);
        }
    }

    public function sendCommand($command): void {
        $finalCommand = $this->presetChatCommand($command);
        $this->request->handleMessage('sendMessage', $finalCommand);
    }

    public function getApiInfo(): array {
        return Array(
            "bot_name" => $this->bot_name,
            "bot_key" => $this->bot_key,
            "hook_url" => $this->hook_url,
            "request" => $this->request,
        );
    }

    private function initInputThread(): Analyzer {
        /**
         * Initialize input thread
         */
        $data = json_decode(file_get_contents('php://input'), TRUE);
        $data = $data['message'] ?: $data['callback_query'];
        $this->chat_id = $data['chat']['id'];

        /**
         * Save instance to globals
         */
        $GLOBALS['apiClient'] = $this;

        file_put_contents('logs/messages.txt', '$data: '.print_r($data, 1)."\n", FILE_APPEND);
        return new Analyzer($data);
    }

    private function presetChatCommand($command): array {
        $preset = $command;
        $preset['chat_id'] = $this->chat_id;
        return $preset;
    }
}