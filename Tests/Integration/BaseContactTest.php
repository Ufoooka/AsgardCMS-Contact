<?php namespace Modules\Contact\Tests\Integration;

use Orchestra\Testbench\TestCase;

abstract class BaseContactTest extends TestCase
{
    /**
     * @var \Modules\Contact\Repositories\ContactRepository
     */
    protected $contact;

    public function setUp()
    {
        parent::setUp();

        $this->resetDatabase();

        $this->contact = app('Modules\Contact\Repositories\ContactRepository');
    }

    protected function getPackageProviders($app)
    {
        return [
            'Pingpong\Modules\ModulesServiceProvider',
            'Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider',
            'Modules\Core\Providers\CoreServiceProvider',
            'Modules\Contact\Providers\ContactServiceProvider',
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'LaravelLocalization' => 'Mcamara\LaravelLocalization\Facades\LaravelLocalization',
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['path.base'] = __DIR__ . '/..';
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', array(
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ));
        $app['config']->set('translatable.locales', ['en', 'fr']);
    }

    private function resetDatabase()
    {
        // Relative to the testbench app folder: vendors/orchestra/testbench/src/fixture
        $migrationsPath = realpath('Database/Migrations');
        $artisan = $this->app->make('Illuminate\Contracts\Console\Kernel');
        // Makes sure the migrations table is created
        $artisan->call('migrate', [
            '--database' => 'sqlite',
            '--realpath' => $migrationsPath,
        ]);
        // We empty all tables
        $artisan->call('migrate:reset', [
            '--database' => 'sqlite',
        ]);
        // Migrate
        $artisan->call('migrate', [
            '--database' => 'sqlite',
            '--realpath'     => $migrationsPath,
        ]);
    }
}
