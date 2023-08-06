<?php

namespace App\Console\Commands;

use App\Models\Character as Character;
use App\Models\Episode;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ApiSeeding extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apiseeding';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seedig database from rick api';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Episode::query()->truncate();
        Character::query()->truncate();
        Artisan::call('db:seed --class=EpisodeSeeder');
        Artisan::call('db:seed --class=CharacterSeeder');
    }
}
