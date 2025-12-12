<?php

namespace TGram;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use TGram\Abilities\{CanManageMessage, CanReceiveInformation, CanSendMedia};
use TGram\Enums\HttpVerb;
use TGram\Interfaces\Bot as IBot;


class Bot implements IBot
{
    use CanSendMedia, CanManageMessage, CanReceiveInformation;

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
            $body = $options;

            if ($method === HttpVerb::CREATABLE) {
                $body = [
                    "form_params" => $options
                ];
            }

            $response = $this->client->{$method->value}($endpoint, $body);

            return json_decode($response->getBody());
        } catch (RequestException $error) {
            return (object) [
                "ok" => false,
                "description" => $error->getMessage(),
            ];
        }
    }
}
