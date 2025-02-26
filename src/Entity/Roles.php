<?php

namespace App\Entity;

enum Roles: string
{
    case ADM="ROLE_ADMIN";
    case USER="ROLE_USER";
}