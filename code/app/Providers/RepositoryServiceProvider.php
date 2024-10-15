<?php
namespace App\Providers;

use App\Repositories\{
    WordRepository,
    UserWordRepository,
    WordTypeRepository,
    DefinitionRepository,
};

use App\Contracts\Repositories\{
    IWordRepository,
    IUserWordRepository,
    IWordTypeRepository,
    IDefintionRepository,
};

use Illuminate\Support\ServiceProvider;

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
            abstract: IWordRepository::class,
            concrete: WordRepository::class
        );

        $this->app->bind(
            abstract: IUserWordRepository::class,
            concrete: UserWordRepository::class
        );

        $this->app->bind(
            abstract: IWordTypeRepository::class,
            concrete: WordTypeRepository::class
        );

        $this->app->bind(
            abstract: IDefintionRepository::class,
            concrete: DefinitionRepository::class
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
        return [
            IWordRepository::class,
            IUserWordRepository::class,
            IWordTypeRepository::class,
            IDefintionRepository::class,
        ];
    }

    /**
     * Bootstrap any application services.
     * This method is used for bootstrapping services that do not require specific actions when the application starts.
     */
    public function boot(): void
    {
    }
}
