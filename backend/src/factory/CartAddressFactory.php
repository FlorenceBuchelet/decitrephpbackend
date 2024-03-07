<?php

namespace Products;

use Products\Address;

class AddressFactory
{
    public static function createAddressFromDatabase(
        int $cartAddressId,
        string $cartFullname,
        string $address,
        ?string $addressDetails,
        string $city,
        string $region,
        string $country,
        ?string $phone,
        int $cartId,
    ): Address {
        $fullAddress = new Address();
        $fullAddress->setCartAddressId($cartAddressId);
        $fullAddress->setCartFullname($cartFullname);
        $fullAddress->setAddress($address);
        $fullAddress->setAddressDetails($addressDetails);
        $fullAddress->setCity($city);
        $fullAddress->setRegion($region);
        $fullAddress->setCountry($country);
        $fullAddress->setPhone($phone);
        $fullAddress->setCartId($cartId);
        return $fullAddress;
    }
}
