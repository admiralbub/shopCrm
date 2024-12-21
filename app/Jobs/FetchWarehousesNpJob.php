<?php
namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\NpWarehouse;
use App\Deliver\Novaposhta;
use Illuminate\Support\Facades\Http;
class FetchWarehousesNpJob implements ShouldQueue
{
    use Queueable;
    
    /**
     * Access Point JSON URL (Changed to protected to allow access).
     */
    private $warehouses;

    public function __construct($warehouses)
    {
        $this->warehouses = $warehouses;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        foreach ($this->warehouses as $warehouse) {
            // Пример сохранения в модель Warehouse
            $np = new NpWarehouse();
            $np->Description = $warehouse['Description'];
            $np->DescriptionRu = $warehouse['DescriptionRu'] ?? '';
            $np->Ref = $warehouse['Ref'];
            $np->CityRef = $warehouse['CityRef'] ;
            $np->save();
    
        }
    }
}