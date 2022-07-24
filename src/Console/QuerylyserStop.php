<?php

namespace AMeheina\Querylyser\Console;

use Illuminate\Console\Command;

class QuerylyserStop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'querylyser:stop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stop listening to queries and run analysis';

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
        $this->info('Querylyser stopped...');
        $this->info('Analysing your queries...');

        return 0;
    }
}
