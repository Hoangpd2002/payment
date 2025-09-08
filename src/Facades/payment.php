<?php

namespace hoangpd\payment\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \hoangpd\payment\payment
 */
class payment extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \hoangpd\payment\payment::class;
    }
}
