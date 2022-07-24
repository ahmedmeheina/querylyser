<?php

namespace AMeheina\Querylyser\Console;

use Illuminate\Console\Command;

class QuerylyserStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'querylyser:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start listening to queries';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Querylyser started...');

        return 0;
    }
}
