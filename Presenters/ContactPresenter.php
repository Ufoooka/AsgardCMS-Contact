<?php namespace Modules\Contact\Presenters;

use Laracasts\Presenter\Presenter;

class ContactPresenter extends Presenter
{
    /**
     * Get a bootstrap label of the contact is online or offline
     * @return string
     */
    public function onlineLabel()
    {
        if ($this->entity->online) {
            return '<span class="label label-success">Online</span>';
        }

        return '<span class="label label-default">Offline</span>';
    }
}
