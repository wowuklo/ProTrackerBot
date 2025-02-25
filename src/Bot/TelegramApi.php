<?php

namespace App\Bot;

class TelegramApi
{

    public function __construct(readonly string $token) {

    }

    public function sendMessage(int $chatId, string $message): void
    {
        $url = "https://api.telegram.org/bot{$this->token}/sendMessage";
        $url .= "?chat_id={$chatId}&text=" . urlencode($message);

        $response = file_get_contents($url);
        if ($response === false) {
            throw new \RuntimeException("Couldn't send message");
        }
    }

}