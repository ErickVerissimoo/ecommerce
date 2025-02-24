<?php

namespace App\Dto;

class UserRequestDto
{
    public function __construct(public readonly string $email, public readonly  string $password) {
    }
}