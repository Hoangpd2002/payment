<?php

namespace hoangpd\payment\Support;

class Crc16
{
    public static function of(string $input): string
    {
        $crc = 0xFFFF;

        for ($i = 0; $i < strlen($input); $i++) {
            $crc ^= ord($input[$i]) << 8;
            for ($j = 0; $j < 8; $j++) {
                $crc = ($crc & 0x8000)
                    ? (($crc << 1) ^ 0x1021)
                    : ($crc << 1);
                $crc &= 0xFFFF;
            }
        }

        return strtoupper(str_pad(dechex($crc), 4, '0', STR_PAD_LEFT));
    }
}
