<?php

namespace App\Dto;

readonly class UserRequestDto
{
    public function __construct(public  string $email, public  string $password) {
    }
}