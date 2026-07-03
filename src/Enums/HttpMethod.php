<?php

namespace TGram\Enums;

enum HttpMethod: string
{
    case READABLE = "get";

    case CREATABLE = "post";
}
