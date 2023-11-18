<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question2favorite extends Model
{
    protected $table = 'question2favorites';
    protected $primaryKey = ['favorite_question_id', 'favorite_user_id'];
    public $incrementing = false;
    protected $fillable = ['favorite_question_id', 'favorite_user_id'];
    const CREATED_AT = 'favorite_created_at';
    const UPDATED_AT = 'favorite_updated_at';
}
