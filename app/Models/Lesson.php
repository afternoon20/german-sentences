<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use SoftDeletes;

    protected $table = 'lessons';
    protected $primaryKey = 'lesson_id';
    public $incrementing = true;
    const CREATED_AT = 'lesson_created_at';
    const UPDATED_AT = 'lesson_updated_at';
    const DELETED_AT = 'lesson_deleted_at';

}
