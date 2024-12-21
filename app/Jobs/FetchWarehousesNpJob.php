<?php
namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\NpWarehouse;
use App\Deliver\Novaposhta;

class FetchWarehousesNpJob implements ShouldQueue
{
    use Queueable;
    
    /**
     * Access Point JSON URL (Changed to protected to allow access).
     */
    private $accessPointJSON;

    public function __construct($accessPointJSON)
    {
        $this->accessPointJSON = $accessPointJSON;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $page = 1; // Номер страницы
        $limit = 50; // Количество записей на странице
        $hasMoreData = true; // Флаг для проверки наличия следующих страниц
    
        while ($hasMoreData) {
            $request = json_encode([
                "modelName" => "AddressGeneral",
                "calledMethod" => "getWarehouses",
                "methodProperties" => [
                    "Page" => $page,
                    "Limit" => $limit
                ]
            ]);
    
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->accessPointJSON);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
            curl_setopt($ch, CURLOPT_POST, 1);
    
            $response = curl_exec($ch);
    
            if ($response === false) {
                throw new \Exception('Error with cURL: ' . curl_error($ch));
            }
    
            $response = json_decode($response);
    
            if (!isset($response->success) || !$response->success || empty($response->data)) {
                throw new \Exception('API response error: ' . json_encode($response));
            }
    
            foreach ($response->data as $warehouse) {
                $np = new NpWarehouse();
                $np->Description = $warehouse->Description;
                $np->DescriptionRu = $warehouse->DescriptionRu ?? '';
                $np->Ref = $warehouse->Ref;
                $np->CityRef = $warehouse->CityRef;
                $np->save();
            }
    
            // Проверяем, есть ли ещё данные
            $hasMoreData = count($response->data) === $limit;
            $page++;
        }
        return 'Data successfully imported!';
    }
}