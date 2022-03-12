<?php

namespace StarfolkSoftware\Settings\Commands;

use Illuminate\Console\Command;

class SettingsCommand extends Command
{
    public $signature = 'laravel-settings';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
