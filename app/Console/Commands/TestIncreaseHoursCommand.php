<?php

namespace App\Console\Commands;

use App\Actions\IncreaseHoursAction;
use Illuminate\Console\Command;

class TestIncreaseHoursCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:increase-hours';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $res=IncreaseHoursAction::handle('eolmedogonzalez@gmail.com',16);
        dd($res->getStatusCode());
    }
}
