<?php

namespace App\Repositories;

use App\Models\Question2favorite as Favorite;

class Question2FavoriteRepository
{
    public function create($params)
    {
        $favorite = Favorite::firstOrNew([
            'favorite_question_id' => $params['favorite_question_id'],
            'favorite_user_id' => $params['favorite_user_id'],
        ]);
        $favorite->save();

        return compact('favorite');
    }

    public function delete($params)
    {
        $favorite = Favorite::where([
            'favorite_question_id' => $params['favorite_question_id'],
            'favorite_user_id' => $params['favorite_user_id'],
        ])->firstOrFail();

        //NOTE: 複合キーの削除に対応していないため再度モデル取得して削除
        Favorite::where([
            'favorite_question_id' => $params['favorite_question_id'],
            'favorite_user_id' => $params['favorite_user_id'],
        ])->delete();

        return compact('favorite');
    }
}
