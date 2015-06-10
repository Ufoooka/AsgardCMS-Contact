<?php namespace Modules\Contact\Entities;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Contact extends Model
{
    use PresentableTrait;

    protected $presenter = 'Modules\Contact\Presenters\ContactPresenter';
    protected $table = 'contacts';
    protected $fillable = ['name', 'body'];
}
