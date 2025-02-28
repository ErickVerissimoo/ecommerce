<?php

namespace App\Dto;

readonly class UserRequestDto
{
    public function __construct(public  string $username, public  string $password) {
    }
}