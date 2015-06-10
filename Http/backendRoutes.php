<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['prefix' =>'/contact'], function (Router $router) {
        $router->bind('contacts', function ($id) {
            return app('Modules\Contact\Repositories\ContactRepository')->find($id);
        });
        $router->resource('contacts', 'ContactController', ['except' => ['show'], 'names' => [
            'index' => 'admin.contact.contact.index',
            'create' => 'admin.contact.contact.create',
            'store' => 'admin.contact.contact.store',
            'edit' => 'admin.contact.contact.edit',
            'update' => 'admin.contact.contact.update',
            'destroy' => 'admin.contact.contact.destroy',
        ]]);
// append

});
