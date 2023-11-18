<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use SoftDeletes;

    protected $table = 'references';
    protected $primaryKey = 'reference_id';
    public $incrementing = true;
    const CREATED_AT = 'reference_created_at';
    const UPDATED_AT = 'reference_updated_at';
    const DELETED_AT = 'reference_deleted_at';
}
