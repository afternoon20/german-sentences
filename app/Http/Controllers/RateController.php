<?php

namespace App\Http\Controllers;

use App\Services\User\RegisterRateService;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function register(Request $request, RegisterRateService $registerRateService)
    {
        $params = $request->all();
        $registerRateService = $registerRateService->register($params);
        $jsonData = [
            'question_id' => $registerRateService['question']->question_id,
        ];

        return json_encode($jsonData, true);
    }
}
