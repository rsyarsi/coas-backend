<?php

return [

    "parameters" => [

        "include" => "include",
        "fields" => "fields",
        "append" => "append",

        "filter" => "filter",
        "sort" => "order",
    ],

    "count_suffix" => "Count",

    "request_data_source" => "query_string",

    "disable_invalid_filter_query_exception" => env("APP_ENV", "production") === "production" ? true : false,

];
