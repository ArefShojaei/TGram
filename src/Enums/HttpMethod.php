<?php

namespace TGram\Enums;

enum HttpMethod: string
{
    case READABLE = "get";

    case CREATABLE = "post";

    case UPDATABLE = "put";

    case EDITABLE = "path";

    case DELETABLE = "delete";
}
