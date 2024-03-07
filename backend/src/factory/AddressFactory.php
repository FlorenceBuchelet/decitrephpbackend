<?php

namespace Products;

use Products\Address;

class AddressFactory
{
    public static function createAddressFromDatabase(
        int $userId,
        string $address,
        ?string $addressDetails,
        string $city,
        string $region,
        string $country,
        ?string $phone,
    ): Address {
        $fullAddress = new Address();
        $fullAddress->setUserId($userId);
        $fullAddress->setAddress($address);
        $fullAddress->setAddressDetails($addressDetails);
        $fullAddress->setCity($city);
        $fullAddress->setRegion($region);
        $fullAddress->setCountry($country);
        $fullAddress->setPhone($phone);
        return $fullAddress;
    }
}
