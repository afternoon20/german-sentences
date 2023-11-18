<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\User\RegisterFavoriteService;
use App\Services\User\DeleteFavoriteService;

class FavoriteController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function register(Request $request, RegisterFavoriteService $registerFavoriteService)
    {
        $params = $request->all();
        $registerFavoriteService = $registerFavoriteService->register($params);
        $jsonData = [
            'favorite_question_id' => $registerFavoriteService['favorite']->favorite_question_id,
            'favorite_user_id' => $registerFavoriteService['favorite']->favorite_user_id,
        ];
        
        return json_encode($jsonData, true);
    }

    public function delete(Request $request, DeleteFavoriteService $deleteFavoriteService)
    {
        
        $params = $request->all();
        $deleteFavoriteService = $deleteFavoriteService->delete($params);
        $jsonData = [
            'favorite_question_id' => $deleteFavoriteService['favorite']->favorite_question_id,
            'favorite_user_id' => $deleteFavoriteService['favorite']->favorite_user_id,
        ];

        return json_encode($jsonData, true);
    }
}
