<?php

namespace TGram;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use TGram\Utils\Settings;
use TGram\Enums\HttpMethod;
use TGram\Interfaces\Bot as IBot;
use TGram\Abilities\{CanProvideBotManagement, CanReceiveInformation};

abstract class Bot implements IBot
{
    use CanReceiveInformation, CanProvideBotManagement;

    private const API_BASE_URL = "https://api.telegram.org/bot";

    private Client $client;

    public function __construct(string $token)
    {
        $this->client = new Client([
            "base_uri" => self::API_BASE_URL . $token . "/",
            'timeout' => Settings::get('http.timeout', 0),
            'connect_timeout' => Settings::get('http.connect_timeout', 0),
        ]);
    }

    final public function request(
        HttpMethod $method,
        string $endpoint,
        array $params = [],
    ): object {
        try {
            $response = $this->client->{$method->value}($endpoint, $params);

            return json_decode($response->getBody());
        } catch (RequestException $error) {
            return (object) [
                "ok" => false,
                "description" => $error->getMessage(),
                "error_code" => $error->getCode(),
            ];
        }
    }
}
