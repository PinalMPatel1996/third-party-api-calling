<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;

class BoredActivities
{
    protected $limit;

    public function __construct($limit=10)
    {
        $this->limit = $limit;
    }

    public function get()
    {
        $apiUrl = config('services.bored_activity.api_url');
        $activities = [];

        for ($i=0; $i < $this->limit; $i++){
            $activity = (new HttpClient($apiUrl))->get();
            $activities[] = [
                'activity' => data_get($activity,'activity'),
                'key' => data_get($activity, 'key'),
                'type' => data_get($activity, 'type')
            ];
        }

        return collect($activities)->sortBy('type');
    }
}
