<?php

namespace TGram\Providers;

use TGram\Enums\{MediaType, HttpMethod};

trait HasFileUploader
{
    private function sendFile(
        string $endpoint,
        string $file,
        MediaType $media,
        array $body
    ): object {
        $isLocalFile = file_exists($file);

        return $isLocalFile
            ? $this->sendInternalFile($endpoint, $file, $media, $body)
            : $this->sendExternalFile($endpoint, $file, $media, $body);
    }

    private function sendInternalFile(
        string $endpoint,
        string $file,
        MediaType $media,
        array $body
    ): object {
        $multipart = [
            [
                "name" => $media->value,
                "contents" => fopen($file, "r"),
                "filename" => basename($file),
            ],
        ];

        foreach ($body as $key => $value) {
            $multipart[] = [
                "name" => $key,
                "contents" => $value,
            ];
        }

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: $endpoint,
            params: ["multipart" => $multipart],
        );
    }

    private function sendExternalFile(
        string $endpoint,
        string $file,
        MediaType $media,
        array $body
    ): object {
        $payload = [$media->value => $file];

        foreach ($body as $key => $value) {
            $payload[$key] = $value;
        }

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: $endpoint,
            params: ["form_params" => $payload],
        );
    }
}
