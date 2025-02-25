<?php

namespace App;

require __DIR__ . '/../vendor/autoload.php';

use App\Bot\Bot;
use App\Bot\TelegramApi;
use App\Parser\ProtrackerParser;
use App\Utils\HttpClient;

$config = require __DIR__ . '/../config/config.php';

$httpClient = new HttpClient();
$parser = new ProtrackerParser();
$telegramApi = new TelegramApi($config['telegram_token']);
$bot = new Bot($httpClient, $telegramApi,$parser );

$content = file_get_contents('php://input');
$update = json_decode($content, true);

if (isset($update['message'])) {
    $chatId = $update['message']['chat']['id'];
    $text = $update['message']['text'];
    $bot->handleCommand($chatId, $text);
}
