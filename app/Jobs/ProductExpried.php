<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Products;
use Carbon\Carbon;
use App\WareHouse;
use App\Inventory;

class ProductExpried implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $warehouse = WareHouse::find($this->id);
        Inventory::create([
            'product_id' => $warehouse->product_id,
            'number' => $warehouse->number,
            'expired_date' => $warehouse->expired_date,
        ]);

    }
}
