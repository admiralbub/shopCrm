<?php

namespace App\Jobs;

use CURLFile;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendToSalesDrive implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $handler;
    private $data;

    /**
     * Create a new job instance.
     *
     * @param $handler
     * @param $data
     */
    public function __construct($handler, $data)
    {
        $this->handler = $handler;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        $client = new Client([
            'base_uri' => 'https://growex.salesdrive.me',
            'timeout' => 10.0,
        ]);

        $form = [];
        $this->salesdriveBuildQuery($this->data, $form);
        $formData = $this->createFormData($form);

        try {
            $response = $client->post($this->handler, [
                'multipart' => $formData,
            ]);
        } catch (\Exception $exception) {
            //
        }
    }

    /**
     * @param $form
     * @return array
     */
    private function createFormData($form)
    {
        $result = [];
        foreach ($form as $name => $contents) {
            $result[] = [
                'name' => $name,
                'contents' => $contents,
            ];
        }

        return $result;
    }

    /**
     * @param $arrays
     * @param array $new
     * @param null $prefix
     */
    private function salesdriveBuildQuery($arrays, &$new = [], $prefix = null)
    {
        if (is_object($arrays)) {
            $arrays = get_object_vars($arrays);
        }
        foreach ($arrays AS $key => $value) {
            $k = isset($prefix) ? $prefix . "[" . $key . "]" : $key;
            (is_array($value) || (is_object($value) && !($value instanceof CurlFile))) ? $this->salesdriveBuildQuery($value, $new, $k) : $new[$k] = $value;
        }
    }
}
