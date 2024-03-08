<?php

namespace Products;

use Products\Order;

class OrderFactory
{
    public static function createOrderFromDatabase(
        int $orderId,
        int $userId,
        int $cartId,
        string $orderRef,
        float $orderTotal,
        int $orderAddressId,
    ): Order {
        $order = new Order();
        $order->setOrderId($orderId);
        $order->setUserId($userId);
        $order->setCartId($cartId);
        $order->setOrderRef($orderRef);
        $order->setOrderTotal($orderTotal);
        $order->setOrderAddressId($orderAddressId);
        return $order;
    }
}
