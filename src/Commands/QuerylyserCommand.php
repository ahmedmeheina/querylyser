<?php

namespace Ameheina\Querylyser\Commands;

use Illuminate\Console\Command;

class QuerylyserCommand extends Command
{
    public $signature = 'querylyser';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
