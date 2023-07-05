<?php

namespace App\Http;

class CheckNullableParams
{
    public static function checkNullable(mixed $params)
    {
        $result = false;
        if(is_array($params)){
            $result = array_filter($params, function($item) {
                return $item === null;
            });
        } else {
            $result = $params === null;
        }

        return $result;
    }
}
