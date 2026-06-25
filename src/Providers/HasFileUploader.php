<?php

namespace TGram\Providers;

use TGram\Enums\{MediaType, HttpMethod};
use TGram\Exceptions\FileException;

trait HasFileUploader
{
    private function sendFile(
        string $endpoint,
        string $file,
        MediaType $media,
        array $body = [],
    ): object {
        if (empty($file)) {
            throw new FileException("File path cannot be empty");
        }

        $isLocalFile = $this->isLocalFile($file);

        if ($isLocalFile && !file_exists($file)) {
            throw new FileException("Local file does not exist: {$file}");
        }

        if ($isLocalFile && !is_readable($file)) {
            throw new FileException("Local file is not readable: {$file}");
        }

        return $isLocalFile
            ? $this->sendInternalFile($endpoint, $file, $media, $body)
            : $this->sendExternalFile($endpoint, $file, $media, $body);
    }

    private function isLocalFile(string $file): bool
    {
        // Check if it's a URL
        return !filter_var($file, FILTER_VALIDATE_URL);
    }

    private function sendInternalFile(
        string $endpoint,
        string $file,
        MediaType $media,
        array $body,
    ): object {
        try {
            $handle = fopen($file, "r");

            if ($handle === false) {
                throw new FileException("Failed to open file: {$file}");
            }

            $multipart = [
                [
                    "name" => $media->value,
                    "contents" => $handle,
                    "filename" => basename($file),
                ],
            ];

            // Add body parameters
            foreach ($body as $key => $value) {
                if ($value !== null) {
                    $multipart[] = [
                        "name" => $key,
                        "contents" => $value,
                    ];
                }
            }

            $response = $this->bot->request(
                method: HttpMethod::CREATABLE,
                endpoint: $endpoint,
                params: ["multipart" => $multipart],
            );

            return $response;
        } finally {
            // ✅ Always close the file handle
            if (isset($handle) && is_resource($handle)) {
                fclose($handle);
            }
        }
    }

    private function sendExternalFile(
        string $endpoint,
        string $file,
        MediaType $media,
        array $body,
    ): object {
        $payload = [$media->value => $file];

        foreach ($body as $key => $value) {
            if ($value !== null) {
                $payload[$key] = $value;
            }
        }

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: $endpoint,
            params: ["form_params" => $payload],
        );
    }
}
