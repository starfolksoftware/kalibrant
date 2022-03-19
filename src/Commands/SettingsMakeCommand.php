<?php

namespace StarfolkSoftware\Kalibrant\Commands;

use Illuminate\Console\GeneratorCommand;

class SettingsMakeCommand extends GeneratorCommand
{
    protected $name = 'make:settings';

    protected $description = 'Create a new setting class';

    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle(): bool|null
    {
        return parent::handle();
    }

    protected function getStub()
    {
        return __DIR__ . '/stubs/settings.stub';
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)
            ->replaceSettingsGroup($stub)
            ->replaceClass($stub, $name);
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Settings';
    }

    private function replaceSettingsGroup(string &$stub): self
    {
        $stub = str_replace('{{ slug }}', str($this->getNameInput())->snake()->slug(), $stub);

        return $this;
    }
}
