<?php

namespace Products;

use Products\OrderAddress;

class OrderAddressFactory
{
    public static function createOrderAddressFromDatabase(
        int $orderAddressId,
        string $orderFullname,
        string $address,
        ?string $addressDetails,
        string $city,
        string $region,
        string $country,
        ?string $phone,
    ): OrderAddress {
        $orderAddress = new OrderAddress();
        $orderAddress->setOrderAddressId($orderAddressId);
        $orderAddress->setOrderFullname($orderFullname);
        $orderAddress->setAddress($address);
        $orderAddress->setAddressDetails($addressDetails);
        $orderAddress->setCity($city);
        $orderAddress->setRegion($region);
        $orderAddress->setCountry($country);
        $orderAddress->setPhone($phone);
        return $orderAddress;
    }
}
