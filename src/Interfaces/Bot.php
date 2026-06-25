<?php

namespace TGram\Interfaces;

interface Bot extends Http
{
    public function close(): object;

    public function logOut(): object;

    public function setName(
        string $name,
        ?string $language_code = null,
    ): object;

    public function getName(?string $language_code = null): object;

    public function setDescription(
        string $description,
        ?string $language_code = null,
    ): object;

    public function getDescription(?string $language_code = null): object;

    public function setShortDescription(
        string $short_description,
        ?string $language_code = null,
    ): object;

    public function getShortDescription(?string $language_code = null): object;

    public function getDefaultAdministratorRights(
        ?bool $for_channels = null,
    ): object;

    public function deleteDefaultAdministratorRights(
        ?bool $for_channels = null,
    ): object;
}
