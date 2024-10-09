<?php

namespace Modules\Common\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Modules\Administrator\Database\Seeders\AdministratorDatabaseSeeder;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     */
    protected $description = 'Run installation migration, seeder, atbp.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // create administrator
        Artisan::call(
            command: 'db:seed',
            parameters: [
                'class' => AdministratorDatabaseSeeder::class,
            ],
        );

        // sync permission
        Artisan::call(
            command: 'app:permission:sync',
        );
    }
}
