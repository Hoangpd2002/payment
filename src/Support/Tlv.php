<?php

namespace hoangpd\payment\Support;

class Tlv
{
    public static function pack(string $id, string $value): string
    {
        $len = str_pad((string) strlen($value), 2, '0', STR_PAD_LEFT);

        return $id.$len.$value;
    }

    public static function packList(string $id, array $pairs): string
    {
        $content = implode('', $pairs);

        return self::pack($id, $content);
    }
}