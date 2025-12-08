<?php

namespace TGram;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use TGram\Enums\HttpVerb;
use TGram\Interfaces\Bot as IBot;


class Bot implements IBot
{
    private const API_BASE_URL = "https://api.telegram.org/bot";

    private Client $client;


    public function __construct(string $token)
    {
        $this->client = new Client([
            "base_uri" => self::API_BASE_URL . $token . "/",
        ]);
    }

    private function request(
        string $endpoint,
        HttpVerb $method = HttpVerb::READABLE,
        array $options = [],
    ): object {
        try {
            $response = $this->client->{$method->value}($endpoint, $options);

            return json_decode($response->getBody());
        } catch (RequestException $error) {
            return (object) [
                "ok" => false,
                "description" => $error->getMessage(),
            ];
        }
    }

    public function getMe(): object
    {
        return $this->request("getMe");
    }

    public function getUpdates(array $options = []): object
    {
        return $this->request(
            endpoint: "getUpdates",
            options: $options,
        );
    }

    public function sendMessage(
        int $chatId,
        string $text,
        array $options = [],
    ): object {
        $body = [
            "form_params" => [
                "chat_id" => $chatId,
                "text" => $text,
                "parse_mode" => "HTML",
                ...$options,
            ],
        ];

        return $this->request(
            method: HttpVerb::CREATABLE,
            endpoint: "sendMessage",
            options: $body,
        );
    }
}
