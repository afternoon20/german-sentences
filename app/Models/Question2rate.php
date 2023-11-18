<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Packages\Classes\Models\HasCompositePrimaryKey;

class Question2rate extends Model
{
    use HasCompositePrimaryKey;

    protected $table = 'question2rates';

    protected $primaryKey = ['rate_question_id', 'rate_user_id'];

    public $incrementing = false;

    protected $fillable = ['rate_question_id', 'rate_user_id'];

    const CREATED_AT = 'rate_created_at';

    const UPDATED_AT = 'rate_updated_at';
}
