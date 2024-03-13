<?php

namespace Products;

use Products\Command;

class CommandFactory
{
    public static function createCommandFromDatabase(
        int $commandId,
        int $userId,
        int $cartId,
        string $commandRef,
        float $commandTotal,
        int $commandAddressId,
    ): Command {
        $command = new Command();
        $command->setCommandId($commandId);
        $command->setUserId($userId);
        $command->setCartId($cartId);
        $command->setCommandRef($commandRef);
        $command->setCommandTotal($commandTotal);
        $command->setCommandAddressId($commandAddressId);
        return $command;
    }
}
