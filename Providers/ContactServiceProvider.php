<?php namespace Modules\Contact\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Modules\Contact\Entities\Contact;
use Modules\Contact\Repositories\Cache\CacheContactDecorator;
use Modules\Contact\Repositories\Eloquent\EloquentContactRepository;

class ContactServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->registerFacade();
    }

    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Contact\Repositories\ContactRepository',
            function () {
                $repository = new EloquentContactRepository(new Contact());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new CacheContactDecorator($repository);
            }
        );
    }

    private function registerFacade()
    {
        $aliasLoader = AliasLoader::getInstance();
        $aliasLoader->alias('Contact', 'Modules\Contact\Facades\ContactFacade');
    }
}
