<?php

namespace App\Exports;

use App\Models\Payment;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class PaymentExport implements FromCollection
{
    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        return Payment::all();
    }
}
