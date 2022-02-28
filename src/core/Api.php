<?php


namespace core;

use Error;

class Api {
    private $bot_name;

    private $bot_key;

    private $hook_url;

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
        $analyzer = $this->initInputAnalyzerData();
        try {
            $sendCommand = $analyzer->analyze();
        } catch (Error $e) {
            $sendCommand = [];
            file_put_contents('bot_errors.txt', '$data: '.print_r($e, 1)."\n", FILE_APPEND);
        }
        $this->request->handleMessage('sendMessage', $sendCommand);
    }

    public function getApiInfo(): array {
        return Array(
            "bot_name" => $this->bot_name,
            "bot_key" => $this->bot_key,
            "hook_url" => $this->hook_url,
            "request" => $this->request,
        );
    }

    private function initInputAnalyzerData(): Analyzer {
        $data = json_decode(file_get_contents('php://input'), TRUE);
        $data = $data['message'] ?: $data['callback_query'];
        file_put_contents('log.txt', '$data: '.print_r($data, 1)."\n", FILE_APPEND);
        return new Analyzer($data);
    }
}