<?php

namespace App\Services\User;

use App\Repositories\Question2FavoriteRepository as favoriteRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeleteFavoriteService
{
    public $deletefavoriteService;

    public favoriteRepository $favoriteRepository;

    public function __construct()
    {
        $this->favoriteRepository = new favoriteRepository();
    }

    public function delete($params)
    {
        $params = [
            'favorite_question_id' => $params['question_id'],
            'favorite_user_id' => Auth::user()->id,
        ];

        DB::beginTransaction();
        try {
            $this->deletefavoriteService = $this->favoriteRepository->delete($params);
            DB::commit();
        } catch (\Exception $e) {
            Log::error(print_r($e, true));
            DB::rollback();
        }

        return $this->deletefavoriteService;
    }
}
