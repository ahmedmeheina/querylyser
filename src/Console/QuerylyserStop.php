<?php

namespace AMeheina\Querylyser\Console;

use AMeheina\Querylyser\Models\LoggedQuery;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

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
        Cache::forget('LogQueries');

        $this->info('Querylyser stopped...');
        $this->info('Analysing your queries...');

        $checks = Querylyser::loadChecks();

        $this->withProgressBar(LoggedQuery::all(), function ($query) use ($checks) {
            dump($query->statement_with_bindings);
            $checks->each(function ($check) {
                dump($check);
            });
        });

        return 0;
    }
}
