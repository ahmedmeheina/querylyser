<?php

namespace AMeheina\Querylyser\Console;

use AMeheina\Querylyser\Models\LoggedQuery;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use AMeheina\Querylyser\QuerylyserFacade as Querylyser;

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

        $results = collect();

        $this->withProgressBar(LoggedQuery::all(), function ($query) use ($checks, $results){
            $checkResults = $checks->map(function ($checkClass) use ($checks, $query) {
                return new $checkClass($query);
            });
            $results->push([$query , $checkResults]);
        });

        Querylyser::generateReport($results);

        return 0;
    }
}
