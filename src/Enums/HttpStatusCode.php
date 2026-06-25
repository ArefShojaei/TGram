<?php

namespace TGram\Enums;

enum HttpStatusCode: int
{
    case OK = 200;

    case FORBIDDEN = 403;

    case INTERNAL_SERVER_ERROR = 500;
}
