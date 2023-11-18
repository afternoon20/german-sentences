<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    public static $columns = [];
    public static $finds = [];

    // TODO:where句の生成
    public static function generateWhereQuery()
    {

    }

    // TODO:SQLの実行と整形を行う
    public static function executeQueryAndgetObjects()
    {

    }

    public static function pregenerateWhereQuery()
    {
    }


}
