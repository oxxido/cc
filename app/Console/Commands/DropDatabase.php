<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DropDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:clear {--refresh} {--seed} {--reseed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears all the tables.';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tables = [];

        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach (\DB::select('SHOW TABLES') as $k => $v) {
            $tables[] = array_values((array) $v)[0];
        }

        foreach ($tables as $table) {
            \Schema::drop($table);
            $this->info("Table {$table} has been dropped.");
        }

        if (\DB::getDriverName() == 'mysql') {
            foreach (\DB::select("SHOW PROCEDURE STATUS WHERE Db = '" . env('DB_DATABASE') . "'") as $k => $v) {
                $procedure = array_values((array) $v)[1];
                \DB::unprepared("DROP PROCEDURE IF EXISTS {$procedure}");
                $this->info("Procedure {$procedure} has been dropped.");
            }

            foreach (\DB::select("SHOW FUNCTION STATUS WHERE Db = '" . env('DB_DATABASE') . "'") as $k => $v) {
                $function = array_values((array) $v)[1];
                \DB::unprepared("DROP FUNCTION IF EXISTS {$function}");
                $this->info("Function {$function} has been dropped.");
            }
        }

        $refresh = $this->option('refresh');
        $seed    = $this->option('seed');

        if ($this->option('reseed')) {
            $refresh = true;
            $seed    = true;
        }

        if ($refresh) {
            \Artisan::call('migrate:refresh');
            if ($seed) {
                \Artisan::call('db:seed');
            }
        }

        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
