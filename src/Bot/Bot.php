<?php

namespace App\Bot;

use App\Parser\ProtrackerParser;
use App\Utils\HttpClient;
class Bot
{

    public function __construct(
        private readonly HttpClient $httpClient,
        private readonly TelegramApi $telegramApi,
        private readonly ProtrackerParser $parser
    )
    {
    }

    public function handleCommand(int $chatId, string $command): void
    {
        if ($command === '/meta') {
            $url = "https://dota2protracker.com/";
            $html = $this->httpClient->get($url);
            $heroes = $this->parser->parseMetaHeroes($html);

            $response = 'Текущие метовые герои: \n';
            foreach ($heroes as $hero) {
                $response .= "- ". $hero . "\n";
            }
            $this->telegramApi->sendMessage($chatId, $response);
        } else {
            $this->telegramApi->sendMessage($chatId, "Используйте команду /meta для поиска метовых героев");
        }
    }

}