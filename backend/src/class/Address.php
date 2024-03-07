<?php

namespace Products;

class Address
{
    private int $userId;
    private string $address;
    private ?string $addressDetails;
    private string $city;
    private string $region;
    private string $country;
    private ?string $phone;

    public function getUserId(): int
    {
        return $this->userId;
    }
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getAddress(): string
    {
        return $this->address;
    }
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getAddressDetails(): ?string
    {
        return $this->addressDetails;
    }
    public function setAddressDetails(?string $addressDetails): void
    {
        $this->addressDetails = $addressDetails;
    }

    public function getCity(): string
    {
        return $this->city;
    }
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getRegion(): string
    {
        return $this->region;
    }
    public function setRegion(string $region): void
    {
        $this->region = $region;
    }

    public function getCountry(): string
    {
        return $this->country;
    }
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }
}
