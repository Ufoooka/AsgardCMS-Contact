<?php namespace Modules\Contact\Repositories\Cache;

use Modules\Contact\Repositories\ContactRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheContactDecorator extends BaseCacheDecorator implements ContactRepository
{
    public function __construct(ContactRepository $contact)
    {
        parent::__construct();
        $this->entityName = 'contact.contacts';
        $this->repository = $contact;
    }

    /**
     * Get all online contacts in the given language
     * @param string $lang
     * @return object
     */
    public function allOnlineInLang($lang)
    {
        return $this->cache
            ->tags($this->entityName, 'global')
            ->remember("{$this->locale}.{$this->entityName}.allOnlineInLang", $this->cacheTime,
                function () use ($lang) {
                    return $this->repository->allOnlineInLang($lang);
                }
            );
    }

    /**
     * Get a contact by its name if it's online
     * @param string $name
     * @return object
     */
    public function get($name)
    {
        return $this->cache
            ->tags($this->entityName, 'global')
            ->remember("{$this->locale}.{$this->entityName}.get", $this->cacheTime,
                function () use ($name) {
                    return $this->repository->get($name);
                }
            );
    }
}
