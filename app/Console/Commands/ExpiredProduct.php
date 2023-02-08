<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\WareHouse;
use App\Jobs\ProductExpried;

class ExpiredProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expired:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $dateExpired = Carbon::now()->subDay()->toDateString();
        $expiredProducts = WareHouse::where('expired_date', $dateExpired)->pluck('id')->toArray();
        foreach($expiredProducts as $productId){
            dispatch(new ProductExpried($productId));
        }
    }
}
