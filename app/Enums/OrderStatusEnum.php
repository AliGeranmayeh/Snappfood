<?php

namespace App\Enums;

enum OrderStatusEnum: string{

    case CHECKING = 'checking';
    case PREPARING = 'preparing';
    case SENDING = 'sending';
    case DELIVERED = 'delivered';

}