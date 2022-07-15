<?php

namespace Ameheina\Querylyser;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Ameheina\Querylyser\Commands\QuerylyserCommand;

class QuerylyserServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('querylyser')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_querylyser_table')
            ->hasCommand(QuerylyserCommand::class);
    }
}
