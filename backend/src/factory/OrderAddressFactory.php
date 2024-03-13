<?php

namespace Products;

use Products\CommandAddress;

class CommandAddressFactory
{
    public static function createCommandAddressFromDatabase(
        int $commandAddressId,
        string $commandFullname,
        string $address,
        ?string $addressDetails,
        string $city,
        string $region,
        string $country,
        ?string $phone,
    ): CommandAddress {
        $commandAddress = new CommandAddress();
        $commandAddress->setCommandAddressId($commandAddressId);
        $commandAddress->setCommandFullname($commandFullname);
        $commandAddress->setAddress($address);
        $commandAddress->setAddressDetails($addressDetails);
        $commandAddress->setCity($city);
        $commandAddress->setRegion($region);
        $commandAddress->setCountry($country);
        $commandAddress->setPhone($phone);
        return $commandAddress;
    }
}
