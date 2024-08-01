<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Role ;
class GetDiscordRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discord:fetchroles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call the discord server api to get the roles of the specific server by their server id.';

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
        Role::fetchDiscordRoles();
    }
}
