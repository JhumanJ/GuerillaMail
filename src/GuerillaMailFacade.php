<?php

namespace JhumanJ\GuerillaMail;

use Illuminate\Support\Facades\Facade;

/**
 * Description of Eurostar Facade Accessor
 */
class GuerillaMailFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'guerilla-mail';
    }
}