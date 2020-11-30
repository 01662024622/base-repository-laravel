<?php

namespace Repository;

use Illuminate\Support\ServiceProvider;
use Repository\Console\RepositoryMakeCommand;
use Repository\Console\RepositoryOnlyMakeCommand;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $commands = [
        RepositoryMakeCommand::class,
        RepositoryOnlyMakeCommand::class
    ];
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }
}