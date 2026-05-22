<?php

namespace TGram\Interfaces\Command;

use TGram\Enums\Scope;

interface CommandManager
{
    public function setCommands(
        array $commands,
        Scope $scope = Scope::DEFAULT,
    ): ?object;

    public function getCommands(Scope $scope = Scope::DEFAULT): ?object;

    public function deleteCommands(Scope $scope = Scope::DEFAULT): ?object;
}
