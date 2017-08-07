<?php namespace Bigandbrown\Pandadoc\Facades;

use Illuminate\Support\Facades\Facade;

class Pandadoc extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'pandadoc';
    }
}