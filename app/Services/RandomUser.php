<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;

class RandomUser
{
    protected $limit;

    public function __construct($limit=10)
    {
        $this->limit = $limit;
    }

    public function get()
    {
        $apiUrl = config('services.random_user.api_url');
        $users = [];

        for ($i=0; $i < $this->limit; $i++){
            $user = data_get((new HttpClient($apiUrl))->get(), 'results.0');

            $users[] = [
                'full_name' => data_get($user,'name.first').data_get($user,'name.last'),
                'phone' => data_get($user, 'phone'),
                'email' => data_get($user, 'email'),
                'country' => data_get($user, 'location.country'),
            ];
        }

        return $users;
    }
}
