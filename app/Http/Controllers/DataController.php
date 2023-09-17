<?php

namespace App\Http\Controllers;

use App\Services\BoredActivities;
use App\Services\RandomUser;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function __invoke()
    {
        $limit = request()->limit??10;

        $users = (new RandomUser($limit))->get();

        if(sizeof($users) < $limit){
            $activities = (new BoredActivities($limit))->get();

            if(sizeof($activities) < $limit){
                $errorMessage = ['ErrorMessage'=> "Unable to fetch enough users data."];

                return $this->setResponse('Error', $errorMessage);
            }
            return $this->setResponse('Success', $activities);
        }else{
            return $this->setResponse('Success', $users);
        }
    }

    protected function setResponse($status, $content){
        $data = [
            'status' => $status,
            'data' => $content
        ];

        return response()->xml($data);
    }
}
