<?php 

namespace App\Enums;

enum AddressStatusEnum: string {
    case SET = 'set';

    case UNSET = 'unset';
}