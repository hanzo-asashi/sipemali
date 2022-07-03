<?php

namespace App\Http\Controllers;

use App\Models\JenisObjekPajak;
use Illuminate\Http\Request;
use Setting;

class PengaturanController extends Controller
{
    public function index()
    {
        $pengaturan = Setting::all();
        $listObjekPajak = JenisObjekPajak::pluck('shortcode', 'id');
        $periodePenarikan = config('custom.periode_penarikan_pajak');

        return view('pengaturan.index', [
            'pengaturan'      => $pengaturan,
            'listObjekPajak'  => $listObjekPajak,
            'periode'  => $periodePenarikan,
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->except('_token');
        if ($image = $request->file('logo_aplikasi')) {
            $date = date('YmdHis').'.'.$image->getClientOriginalExtension();
            $image->storeAs('uploads', $date);
            $input['logo_aplikasi'] = $date;
        }

        foreach ($input as $key => $item) {
            setting()->set($key, $item);
        }
        session()->flash('success', 'Pengaturan berhasil disimpan');

        return back();
    }
}
