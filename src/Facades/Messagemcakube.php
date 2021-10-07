<?php

namespace Ristekusdi\McaKubemqLaravel\Facades;

use Illuminate\Support\Facades\Facade;

class Messagemcakube extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'kubemq-message';
    }
}
