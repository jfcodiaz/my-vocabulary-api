<?php
namespace App\Providers;

use App\Repositories\WordRepository;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Repositories\IWordRepository;

/**
 * Provides repository bindings for the application.
 * This service provider is responsible for binding interfaces to concrete
 * repository classes to ensure dependency inversion and ease of testing.
 */
class RepositoryServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Registers any application services.
     * This method binds the WordRepository to the IWordRepository interface.
     */
    public function register(): void
    {
        $this->app->bind(
            IWordRepository::class,
            WordRepository::class
        );
    }

    /**
    * Get the services provided by the provider.
    * Specifies that this provider provides IWordRepository binding.
    *
    * @return array<string>
    */
    public function provides(): array
    {
        return [IWordRepository::class];
    }

    /**
     * Bootstrap any application services.
     * This method is used for bootstrapping services that do not require specific actions when the application starts.
     */
    public function boot(): void
    {
    }
}
