<?php

if (! function_exists('dj')) {
    function dj($data = [], $stopExecution = true) : void
    {
        if ($stopExecution) {
            @header('Content-Type: application/json');
        }
        echo @json_encode($data);
        if ($stopExecution) {
            exit;
        }
    }
}

if (! function_exists('format_money')) {
    function format_money($value) : string
    {
        return (string) number_format($value, 2, '.', '');
    }
}
