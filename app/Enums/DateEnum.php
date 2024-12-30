<?php

namespace App\Enums;

enum DateEnum: string
{
    case DATE_FORMAT = 'Y-m-d';
    case DATE_TIME_FORMAT = 'd-m-Y H:i';

    case UTC_TIMEZONE = 'UTC';
}
