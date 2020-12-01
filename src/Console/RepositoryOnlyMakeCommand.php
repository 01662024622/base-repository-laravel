<?php

namespace Repository\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class RepositoryOnlyMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:repositoryOnly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new only class for Repository class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'RepositoryClass';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (parent::handle() === false && !$this->option('force')) {
            return;
        }
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/repository.stub';
    }

    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);
        $interface=str_replace('Impl', '', $class);
        $namespace=str_replace('Impl', '', $this->argument('name'));
        $stub=str_replace(['DummyInterface','{{ interface }}','{{interface}}'], $interface, $stub);
        $stub=str_replace(['DummyNamespaceInterface','{{ NamespaceInterface }}','{{NamespaceInterface}}'], $namespace, $stub);
        return str_replace(['DummyClass', '{{ class }}', '{{class}}'], $class, $stub);
    }
    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Repositories\Impl';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Create the class even if the repository already exists.'],
        ];
    }
}