<?php

namespace App\Enums;


enum CommentStatusEnum: int
{
    case CONFIRM_REQUEST = 0;
    case CONFIRMED = 1;
    case DELETE_REQUEST = 2;
}