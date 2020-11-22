<?php

namespace App\Console\Commands;

use App\Anime;
use App\Helpers\Parser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AutoFixMix extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mix:fix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change src anime in mix.tj';

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
     * @return mixed
     */
    public function handle()
    {
        //
        Log::info('Start autoFix');
        $parser = new Parser();
        $anime = Anime::select('rly_path', 'id')
            ->where('src', 'LIKE', '%'.'http://mix.tj/uploads/'.'%')
            ->where('rly_path', '!=', '')
            ->where('auto_correction', 1)
            ->get();
        foreach ($anime as $item){
            $src = $parser->autoFixMix('http://mix.tj'.$item->rly_path);
            if (!$src){
                continue;
            }
          Anime::where('id', $item->id)
              ->update(['src' => $src]);
        }
    }
}
