<?php

namespace App\Exports;

use App\Models\Customers;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomerExport implements FromCollection
{
    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        return Customers::all();
    }
}
