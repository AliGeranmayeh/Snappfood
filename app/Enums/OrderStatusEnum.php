<?php

namespace App\Enums;

enum OrderStatusEnum: int{

    case CHECKING = 0;
    case PREPARING = 1;
    case SENDING = 2;
    case DELIVERED = 3;

}