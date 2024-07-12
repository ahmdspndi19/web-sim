<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Donatur;
use App\Models\KasMasjid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\MockObject\Stub\ReturnSelf;

class KasMasjidController extends Controller
{ public function index()
    {       
       $data = KasMasjid::all();
        
        // Mengirimkan data ke view
        return view("KasMasjid.kasmasjid", compact("data"));
    }

    public function create()
    {   
        
        return view("KasMasjid.createmasuk");
    }
    
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
        'keterangan' => 'required|string|max:255',
        'jenis' => 'required|in:Pemasukan,Pengeluaran',
        'total' => 'required|regex:/^\d+(\.\d{1,2})?$/'
    ]);

    if ($validate->fails()) {
        return redirect()->back()->withInput()->withErrors($validate);
    }

    $data = $request->only(['keterangan', 'jenis']);
    $data['total'] = str_replace(['Rp.', '.'], '', $request->input('total'));

    KasMasjid::create($data);
    return redirect()->route('kasmasjid');
    }

    //From Donatur
    

    public function edit(Request $request, $id)
    {
        $data = KasMasjid::find($id);
        return view('KasMasjid.editkas', compact('data'));
    }
    
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validate = Validator::make($request->all(), [
        'keterangan' => 'required|string|max:255',
        'jenis' => 'required|in:Pemasukan,Pengeluaran',
        'total' => 'required|numeric'
    ]);

    if ($validate->fails()) {
        return redirect()->back()->withInput()->withErrors($validate);
    }

    $data = $request->only(['keterangan', 'jenis']);
    $data['total'] = str_replace(['Rp', '.'], '', $request->input('total'));
    
    KasMasjid::where('id',$id)->update($data);

    return redirect()->route('kasmasjid');
    }
    
    public function delete(Request $request, $id)
    {
        $data = KasMasjid::find($id);

        if ($data->delete()) {
    }
    return redirect()->route('kasmasjid');
    }

    public function getChartData()
    {
        // Mengambil data pemasukan dan pengeluaran setiap bulan
        $monthlyData = KasMasjid::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, jenis, SUM(total) as total')
            ->groupBy('year', 'month', 'jenis')
            ->get()
            ->groupBy(['year', 'month', 'jenis']);

        // Mengambil data pemasukan dan pengeluaran setiap pekan
        $weeklyData = KasMasjid::selectRaw('YEAR(created_at) as year, WEEK(created_at) as week, jenis, SUM(total) as total')
            ->groupBy('year', 'week', 'jenis')
            ->get()
            ->groupBy(['year', 'week', 'jenis']);

        return response()->json([
            'monthly' => $monthlyData,
            'weekly' => $weeklyData,
        ]);
    }
}