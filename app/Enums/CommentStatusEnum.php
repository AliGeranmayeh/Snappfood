<?php

namespace App\Enums;


enum CommentStatusEnum: string
{
    case CONFIRM_REQUEST = 'confirm_request';
    case CONFIRMED = 'confirm';
    case DELETE_REQUEST = 'delete_request';
}