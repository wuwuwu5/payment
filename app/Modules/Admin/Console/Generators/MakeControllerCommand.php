<?php

namespace App\Modules\Admin\Console\Generators;

use Symfony\Component\Console\Input\InputOption;
use Caffeinated\Modules\Console\GeneratorCommand;

class MakeControllerCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module_controller
    	{slug : The slug of the module}
    	{name : The name of the controller class}
    	{model : The model of the model class}
    	{--prefix=: The prefix of the view prefix path}
    	{--resource : Generate a module resource controller class}
    	{--location= : The modules location to create the module controller class in}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module controller class';

    /**
     * String to store the command type.
     *
     * @var string
     */
    protected $type = 'Module controller';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/controller.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     * @throws \Caffeinated\Modules\Exceptions\ModuleNotFoundException
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return module_class($this->argument('slug'), 'Http\\Controllers', $this->option('location'));
    }

    /**
     * Build the class with the given name.
     *
     * @param string $name
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this
            ->replaceNamespace($stub, $name)
            ->replaceModelClassName($stub)
            ->replaceViewPrefixName($stub)
            ->replaceClass($stub, $name);
    }

    /**
     * 替换model名称
     *
     * @param $stub
     * @return $this
     */
    public function replaceModelClassName(&$stub)
    {
        $searches = [
            ['DummyModelClass'],
        ];

        foreach ($searches as $search) {
            $stub = str_replace(
                $search,
                $this->argument('model'),
                $stub
            );
        }

        return $this;
    }

    /**
     * 替换model名称
     *
     * @param $stub
     * @return $this
     */
    public function replaceViewPrefixName(&$stub)
    {
        $prefix = $this->option('prefix');

        if (empty($prefix)) {
            $prefix = $this->argument('slug') . "::";
        } else {
            $prefix = $this->argument('slug') . "::" . $prefix . ".";
        }

        $prefix = '"' . $prefix . '"';
        $searches = [
            ['ViewPrefix'],
        ];

        foreach ($searches as $search) {
            $stub = str_replace(
                $search,
                $prefix,
                $stub
            );
        }

        return $this;
    }
}
