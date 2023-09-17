<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;

class HttpClient
{
    protected $apiEndPoint;

    public function __construct($apiEndPoint)
    {
        $this->apiEndPoint = $apiEndPoint;
    }

    public function get()
    {
        try {
            $response = Http::get($this->apiEndPoint);

            if($response->ok()){
                return $response->json($key = null, $default = []);
            }
        }catch (\Exception $exception){
            return error_log($exception->getMessage());
        }
    }
}
