<?php

namespace App\Repositories;

use App\Models\Reference;

class ReferenceRepository
{
    public function fetchAll($params)
    {
        $references = Reference::where(function ($query) use($params) {
            if(data_get($params, 'reference_id')) $query->whereIn('reference_id', data_get($params, 'reference_id'));
            if(data_get($params, 'reference_name')) $query->whereIn('reference_name', data_get($params, 'reference_name'). '%');
        })->get();

        return compact('references');
    }
}