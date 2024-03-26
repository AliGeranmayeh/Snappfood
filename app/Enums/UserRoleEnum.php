<?php


namespace App\Enums;

enum UserRoleEnum :int
{
    case OWNER = 0;

    case ADMIN = 1;

    case SHOPPER = 2;

}