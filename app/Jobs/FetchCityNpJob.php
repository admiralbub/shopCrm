<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\NpCity;
class FetchCityNpJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private int $page) {}


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $perPage = 100;

        $request = json_encode([
            "modelName" => "Address",
            "calledMethod" => "getCities",
            'methodProperties' => [
                'Page' => $this->page,
                'Limit' => $perPage,
            ]
            
        ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.novaposhta.ua/v2.0/json/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/json"));
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $response = curl_exec($ch);

        if ($response === false) {
            Log::error('Error with cURL: ' . curl_error($ch));
            return;
        }

        $response = json_decode($response);

        if (!isset($response->success) || !$response->success || empty($response->data)) {
            Log::error('API response error: ' . json_encode($response));
        } else {
            foreach ($response->data as $city) {
                $np = new NpCity();
                $np->Description = $city->SettlementTypeDescription.' '.$city->Description;
                $np->DescriptionRu = $city->SettlementTypeDescriptionRu.' '.$city->DescriptionRu;
                $np->Ref = $city->Ref;
                $np->save();
            }
        }

        // Dispatch the next page if data exists
        if (count($response->data) > 0) {
            dispatch(new FetchCityNpJob($this->page + 1));
        }
    }
}
