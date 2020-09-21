<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Response::macro('success', function ($data, $messages = [], $status = 200){
            if(!is_array($messages)) $messages = [$messages];
            if($data instanceof JsonResource)
            {
                $data->additional(['success' => true, 'message' => $messages]);
                return $data->response()->setStatusCode($status);
            }
            else
            {
                return Response::json([
                    'data' => $data,
                    'success' => true,
                    'message' => $messages,
                ], $status);
            }
        });

        Response::macro('error', function ($messages = [], $status = 400) {
            if(!is_array($messages)) $messages = [$messages];
            return Response::json([
                'success'  => false,
                'messages' => $messages,
            ], $status);
        });
    }
}
