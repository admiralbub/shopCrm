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

    public function __construct()
    {
     
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $page = 1;
        $perPage = 100; // Количество отделений на странице

        do {
            $response = Http::get('https://api.novaposhta.ua/v2.0/json/', [
                'modelName' => 'Address',
                'calledMethod' => 'getWarehouses',
                'methodProperties' => [
                    'Page' => $page,
                    'Limit' => $perPage,
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();

                // Добавляем каждый элемент в очередь для обработки
                foreach ($data['data'] as $branch) {
                    $np = new NpWarehouse();
                    $np->Description = $warehouse->Description;
                    $np->DescriptionRu = $warehouse->DescriptionRu ?? '';
                    $np->Ref = $warehouse->Ref;
                    $np->CityRef = $warehouse->CityRef;
                    $np->save();
                }

                $page++;
            } else {
                $this->error('Ошибка при получении данных с API: ' . $response->body());
                break;
            }

        } while (count($data['data']) > 0);  // Пагинация продолжается, пока есть данные

        $this->info('Данные о отделениях успешно добавлены в очередь.');
    }
}