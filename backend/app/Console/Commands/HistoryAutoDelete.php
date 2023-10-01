<?php

namespace App\Console\Commands;

use App\Models\History;
use Carbon\Carbon;
use Illuminate\Console\Command;

class HistoryAutoDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:history-auto-delete';

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
        History::where("created_at", ">", Carbon::now()->addDay()->format('Y-m-d'))->delete();
    }
}
