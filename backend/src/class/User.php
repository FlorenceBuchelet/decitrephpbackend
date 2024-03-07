<?php

namespace Products;

class User
{
    private int $userId;
    private string $gender;
    private string $firstname;
    private string $lastname;
    private string $email;

    public function getUserId(): int
    {
        return $this->userId;
    }
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }
    public function getGender(): string
    {
        return $this->gender;
    }
    public function setGender(string $gender): void 
    {
        $this->gender = $gender;
    }
    public function getFirstname(): string
    {
        return $this->firstname;
    }
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }
    public function getLastname(): string
    {
        return $this->lastname;
    }
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
