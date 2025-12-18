<?php

namespace TGram\Providers;

use TGram\Enums\{MediaType, HttpMethod};


trait HasFileUploader
{
    private function sendFile(
        string $endpoint,
        string $file,
        MediaType $media,
        array $body,
        ?string $thumbnail = null,
    ): void {
        $isLocalFile = file_exists($file);

        $isLocalFile
            ? $this->sendInternalFile(
                $endpoint,
                $file,
                $media,
                $body,
                $thumbnail,
            )
            : $this->sendExternalFile(
                $endpoint,
                $file,
                $media,
                $body,
                $thumbnail,
            );
    }

    private function sendInternalFile(
        string $endpoint,
        string $file,
        MediaType $media,
        array $body,
        ?string $thumbnail = null,
    ): void {
        $multipart = [
            [
                "name" => $media->value,
                "contents" => fopen($file, "r"),
                "filename" => basename($file)
            ]
        ];

        foreach ($body as $key => $value) {
            $multipart[] = [
                "name" => $key,
                "contents" => $value
            ];
        }


        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: $endpoint,
            params: ["multipart" => $multipart],
        );
    }

    private function sendExternalFile(
        string $endpoint,
        string $file,
        MediaType $media,
        array $body,
        ?string $thumbnail = null,
    ): void {
        $payload = [$media->value => $file];

        foreach ($body as $key => $value) {
            $payload[$key] = $value;
        }


        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: $endpoint,
            params: ["form_params" => $payload],
        );
    }
}
