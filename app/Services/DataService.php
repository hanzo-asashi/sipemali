<?php

namespace App\Services;

use App\Utilities\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class DataService
{
    protected static function getModel($model): String
    {
        return Helpers::getModelInstance($model);
    }

    public static function saveData($model, $data)
    {
        $model = Helpers::getModelInstance($model);
        $validated = Validator::make($data, [
            'name' => 'required|max:100',
            'branch_code' => 'required|max:5',
            'description' => 'nullable|max:255',
        ])->validate();

        return $model::create($validated);
    }
}
