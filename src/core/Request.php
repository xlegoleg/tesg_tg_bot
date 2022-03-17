<?php
/**
 * @author Oleg Kurganov [xxxlegoleg@gmail.com]
 * @since PHP 7.4
 */

namespace core;


class Request
{
    private $bot_key;

    public function __construct($bot_key) {
        $this->bot_key = $bot_key;
    }

    public function handleMessage($method, $data) {
        $curl = curl_init();
        $sendCommand = $data;
        curl_setopt_array($curl, [
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://api.telegram.org/bot' . $this->bot_key . '/' . $method,
            CURLOPT_POSTFIELDS => $sendCommand,
        ]);
        file_put_contents('logs/command_log.txt', '$data: '.print_r($sendCommand, 1)."\n", FILE_APPEND);
        $result = curl_exec($curl);
        curl_close($curl);
        return (json_decode($result, 1) ? json_decode($result, 1) : $result);
    }
}