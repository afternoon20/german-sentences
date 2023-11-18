<?php

namespace App\Services\User;

use App\Repositories\Question2FavoriteRepository as FavoriteRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegisterFavoriteService
{
    public $fetchListService;

    public FavoriteRepository $favoriteRepository;

    public function __construct()
    {
        $this->favoriteRepository = new FavoriteRepository();
    }

    public function register($params)
    {
        $params = [
            'favorite_question_id' => $params['question_id'],
            'favorite_user_id' => Auth::user()->id,
        ];

        DB::beginTransaction();
        try {
            $this->fetchListService = $this->favoriteRepository->create($params);
            DB::commit();
        } catch (\Exception $e) {
            Log::error(print_r($e, true));
            DB::rollback();
        }

        return $this->fetchListService;
    }
}
