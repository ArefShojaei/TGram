<?php

namespace TGram;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use TGram\Abilities\CanReceiveInformation;
use TGram\Enums\HttpMethod;
use TGram\Interfaces\Bot as IBot;

abstract class Bot implements IBot
{
    use CanReceiveInformation;

    private const API_BASE_URL = "https://api.telegram.org/bot";

    private Client $client;

    public function __construct(string $token)
    {
        $this->client = new Client([
            "base_uri" => self::API_BASE_URL . $token . "/",
        ]);
    }

    final public function request(
        HttpMethod $method,
        string $endpoint,
        array $params = []
    ): object {
        try {
            $response = $this->client->{$method->value}($endpoint, $params);

            return json_decode($response->getBody());
        } catch (RequestException | Exception $error) {
            return (object) [
                "ok" => false,
                "description" => $error->getMessage(),
                "error_code" => $error->getCode(),
            ];
        }
    }
}
