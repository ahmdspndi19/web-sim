<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Acara;
use App\Models\Donatur;
use App\Models\KasMasjid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = KasMasjid::all();
        $saldo = $this->calculateSaldo();
        $weeklyReport = $this->getWeeklyReport();
        $weeklyEvents = $this->getWeeklyEvents();
        $jumlahDonatur = Donatur::count();
        $jumlahAcara = Acara::count();
        $upcomingEvents = $this->getUpcomingEvents();

        return view("dashboard-admin", compact("data", "saldo", "user", "weeklyReport",
                                                 "weeklyEvents","jumlahDonatur","upcomingEvents",
                                                "jumlahAcara"));
    }

    private function calculateSaldo()
    {
        $totalPemasukan = KasMasjid::where('jenis', 'Pemasukan')->sum('total');
        $totalPengeluaran = KasMasjid::where('jenis', 'Pengeluaran')->sum('total');

        $saldo = $totalPemasukan - $totalPengeluaran;

        return [
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'saldo' => $saldo
        ];
    }

    private function getWeeklyReport()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $weeklyPemasukan = KasMasjid::where('jenis', 'Pemasukan')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->sum('total');

        $weeklyPengeluaran = KasMasjid::where('jenis', 'Pengeluaran')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->sum('total');

        return [
            'weeklyPemasukan' => $weeklyPemasukan,
            'weeklyPengeluaran' => $weeklyPengeluaran,
        ];
    }

    private function getWeeklyEvents()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        return Acara::whereBetween('tanggal', [$startOfWeek, $endOfWeek])
            ->get()
            ->map(function ($event) {
                $event->start_time = Carbon::parse($event->start_time)->format('H:i');
                $event->end_time = Carbon::parse($event->end_time)->format('H:i');
                $event->dayName = Carbon::parse($event->tanggal)->locale('id')->isoFormat('dddd');

                return $event;
            });
    }

    private function getUpcomingEvents()
    {
        $today = Carbon::now();
        
        return Acara::where('tanggal', '>', $today)
            ->orderBy('tanggal', 'asc')
            ->get()
            ->map(function ($event) {
                $event->dayName = Carbon::parse($event->tanggal)->locale('id')->isoFormat('dddd');
                $event->start_time = Carbon::parse($event->start_time)->format('H:i');
                $event->end_time = Carbon::parse($event->end_time)->format('H:i');
                return $event;
            });
    }
}