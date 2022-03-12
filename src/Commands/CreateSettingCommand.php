<?php

namespace StarfolkSoftware\Setting\Commands;

use Illuminate\Console\Command;

class CreateSettingCommand extends Command
{
    public $signature = 'setting:create {name}';

    public $description = 'Scaffolds a new setting file';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
