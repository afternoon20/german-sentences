<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use SoftDeletes;

    protected $table = 'questions';
    protected $primaryKey = 'question_id';
    public $incrementing = true;
    const CREATED_AT = 'question_created_at';
    const UPDATED_AT = 'question_updated_at';
    const DELETED_AT = 'question_deleted_at';
}
