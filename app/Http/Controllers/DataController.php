<?php

namespace App\Http\Controllers;

use App\Services\RandomUser;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function __invoke()
    {
        $limit = request()->limit ?? 10;

        $data = (new RandomUser($limit))->get();

        return $this->setResponse('Success', $data);
    }

    protected function setResponse($status, $content)
    {
        $data = [
            'status' => $status,
            'data' => $content
        ];

        if($status === "Error")
            throw new HttpException(404, $content['ErrorMessage']);

        return response()->xml($data);

    }
}
