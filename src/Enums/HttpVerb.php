<?php

namespace TGram\Enums;


enum HttpVerb: string
{
    case READABLE = "get";

    case CREATABLE = "post";

    case UPDATEABLE = "put";

    case EDITABLE = "path";

    case DELETABLE = "delete";
}
