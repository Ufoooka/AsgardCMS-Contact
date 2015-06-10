<?php namespace Modules\Contact\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface ContactRepository extends BaseRepository
{
    /**
     * Get all online contacts in the given language
     * @param string $lang
     * @return object
     */
    public function allOnlineInLang($lang);

    /**
     * Get a contact by its name if it's online
     * @param string $name
     * @return object
     */
    public function get($name);
}
