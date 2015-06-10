<?php namespace Modules\Contact\Facades;

use Illuminate\Support\Facades\Facade;

class ContactFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Modules\Contact\Repositories\ContactRepository';
    }
}
