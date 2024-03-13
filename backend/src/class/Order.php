<?php

namespace Products;

class Command
{
    private int $commandId;
    private int $userId;
    private int $cartId;
    private string $commandRef;
    private float $commandTotal;
    private int $commandAddressId;

    public function getCommandId(): int
    {
        return $this->commandId;
    }
    public function setCommandId(int $commandId): void
    {
        $this->commandId = $commandId;
    }
    public function getUserId(): int
    {
        return $this->userId;
    }
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }
    public function getCartId(): int
    {
        return $this->cartId;
    }
    public function setCartId(int $cartId): void
    {
        $this->cartId = $cartId;
    }
    public function getCommandRef(): string
    {
        return $this->commandRef;
    }
    public function setCommandRef(string $commandRef): void
    {
        $this->commandRef = $commandRef;
    }
    public function getCommandTotal(): float
    {
        return $this->commandTotal;
    }
    public function setCommandTotal(float $commandTotal): void
    {
        $this->commandTotal = $commandTotal;
    }
    public function getCommandAddressId(): int
    {
        return $this->commandAddressId;
    }
    public function setCommandAddressId(int $commandAddressId): void
    {
        $this->commandAddressId = $commandAddressId;
    }
}
