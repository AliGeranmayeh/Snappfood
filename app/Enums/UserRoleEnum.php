<?php


namespace App\Enums;

enum UserRoleEnum :string
{
    case OWNER = 'owner';

    case ADMIN = 'admin';

    case SHOPPER = 'shopper';

}