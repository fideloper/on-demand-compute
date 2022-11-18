<?php

namespace App\Facades;

use App\Fly as ConcreteFly;
use Illuminate\Support\Facades\Facade;

class Fly extends Facade
{
    protected static function getFacadeAccessor() {
        return ConcreteFly::class;
    }
}
