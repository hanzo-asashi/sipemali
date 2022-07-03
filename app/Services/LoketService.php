<?php namespace App\Services;

use App\Models\BranchCounter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class LoketService
{
//    public BranchCounter $loket;
//
//    public function __construct(BranchCounter $loket)
//    {
//        $this->loket = $loket;
//    }

    public static function saveLoketData($data)
    {
        $validated = Validator::make($data, [
            'name' => 'required|max:100',
            'branch_code' => 'required|max:5',
            'description' => 'nullable|max:255',
        ])->validate();

        return BranchCounter::create($validated);
    }

    public static function updateLoketData($id, $data)
    {
        $validated = Validator::make($data, [
            'name' => 'required|max:100',
            'branch_code' => 'required|max:5',
            'description' => 'nullable|max:255',
        ])->validate();

        return BranchCounter::find($id)->update($validated);
    }
}
