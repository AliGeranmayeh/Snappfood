<?php

namespace App\Enums;


enum PaymentStatusEnum : int {

    case UNPAID = 0;
    case PAID = 1;
}