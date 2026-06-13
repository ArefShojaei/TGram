<?php

namespace TGram\Abilities;

use TGram\Enums\HttpMethod;
use TGram\Exceptions\ValidationException;

trait CanProvideBotManagement
{
    public function close(): object
    {
        return $this->request(method: HttpMethod::CREATABLE, endpoint: "close");
    }

    public function logOut(): object
    {
        return $this->request(
            method: HttpMethod::CREATABLE,
            endpoint: "logOut",
        );
    }

    public function setName(string $name, ?string $language_code = null): object
    {
        if (empty(trim($name))) {
            throw new ValidationException("Bot name cannot be empty");
        }

        $body = [
            "form_params" => [
                "name" => $name,
                "language_code" => $language_code,
            ],
        ];

        return $this->request(
            method: HttpMethod::CREATABLE,
            endpoint: "setMyName",
            params: $body,
        );
    }

    public function getName(?string $language_code = null): object
    {
        $body = [
            "form_params" => [
                "language_code" => $language_code,
            ],
        ];

        return $this->request(
            method: HttpMethod::READABLE,
            endpoint: "getMyName",
            params: $body,
        );
    }

    public function setDescription(
        string $description,
        ?string $language_code = null,
    ): object {
        if (empty(trim($description))) {
            throw new ValidationException("Bot description cannot be empty");
        }

        $body = [
            "form_params" => [
                "description" => $description,
                "language_code" => $language_code,
            ],
        ];

        return $this->request(
            method: HttpMethod::CREATABLE,
            endpoint: "setMyDescription",
            params: $body,
        );
    }

    public function getDescription(?string $language_code = null): object
    {
        $body = [
            "form_params" => [
                "language_code" => $language_code,
            ],
        ];

        return $this->request(
            method: HttpMethod::READABLE,
            endpoint: "getMyDescription",
            params: $body,
        );
    }

    public function setShortDescription(
        string $short_description,
        ?string $language_code = null,
    ): object {
        if (empty(trim($short_description))) {
            throw new ValidationException("Short description cannot be empty");
        }

        $body = [
            "form_params" => [
                "short_description" => $short_description,
                "language_code" => $language_code,
            ],
        ];

        return $this->request(
            method: HttpMethod::CREATABLE,
            endpoint: "setMyShortDescription",
            params: $body,
        );
    }

    public function getShortDescription(?string $language_code = null): object
    {
        $body = [
            "form_params" => [
                "language_code" => $language_code,
            ],
        ];

        return $this->request(
            method: HttpMethod::READABLE,
            endpoint: "getMyShortDescription",
            params: $body,
        );
    }

    public function getDefaultAdministratorRights(
        ?bool $for_channels = null,
    ): object {
        $body = [
            "form_params" => [
                "for_channels" => $for_channels,
            ],
        ];

        return $this->request(
            method: HttpMethod::READABLE,
            endpoint: "getMyDefaultAdministratorRights",
            params: $body,
        );
    }

    public function deleteDefaultAdministratorRights(
        ?bool $for_channels = null,
    ): object {
        $body = [
            "form_params" => [
                "for_channels" => $for_channels,
            ],
        ];

        return $this->request(
            method: HttpMethod::DELETABLE,
            endpoint: "deleteMyDefaultAdministratorRights",
            params: $body,
        );
    }
}
