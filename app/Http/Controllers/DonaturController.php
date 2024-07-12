<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use App\Models\KasMasjid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DonaturController extends Controller
{
    public function donatur()
    {
        $donatur = Donatur::all();
        return view('donatur.donatur', ['donaturlist' => $donatur]);
    }

    public function create()
    {
        return view('donatur.donatur-add');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'alamat' => 'required|max:225',
            'total' => 'required|regex:/^\d+(\.\d{1,2})?$/'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }

        $donaturData = $request->only(['name', 'alamat']);
        $donaturData['total'] = str_replace(['Rp.', '.'], '', $request->input('total'));
        $donatur = Donatur::create($donaturData);

        $kasMasjidData = [
            'keterangan' => 'Uang donatur masjid',
            'jenis' => 'Pemasukan',
            'total' => $donaturData['total']
        ];
        KasMasjid::create($kasMasjidData);

        return redirect()->route('donatur');
    }

    public function edit(Request $request, $id)
    {
        $donatur = Donatur::find($id);
        return view('donatur.editdonatur', compact('donatur'));
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'total' => 'required|numeric'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }

        $data = $request->only(['name', 'alamat']);
        $data['total'] = str_replace(['Rp', '.'], '', $request->input('total'));

        Donatur::where('id', $id)->update($data);

        return redirect()->route('donatur');
    }

    public function delete(Request $request, $id)
    {
        $data = Donatur::find($id);

        if ($data->delete()) {
            // Jika perlu, tambahkan logika untuk menghapus data terkait di KasMasjid.
        }

        return redirect()->route('donatur');
    }
}