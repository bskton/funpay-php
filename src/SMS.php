<?php

namespace Funpay;

class SMS
{
    function parse($str)
    {
        $pattern = '/\b\d{4}\b/';
        preg_match($pattern, $str, $code);

        $pattern = '/\b\d+[\,\.]\d{0,2}\b/';
        preg_match($pattern, $str, $sum);

        $pattern = '/\b\d{15}(?![\,\.])\b/';
        preg_match($pattern, $str, $num);

        return [
            'code' => $code[0],
            'sum' => $sum[0],
            'num' => $num[0]
        ];
    }
}