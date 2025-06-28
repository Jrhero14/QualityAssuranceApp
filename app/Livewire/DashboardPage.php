<?php

namespace App\Livewire;

use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DashboardPage extends Component
{
    public $currentUrl = '/dashboard';

    public function render()
    {
        $totalOK = \App\Models\Checking::sum('OK');
        $totalNG = \App\Models\Checking::sum('NG');
        $totalPemeriksaan = $totalOK + $totalNG;

        // Set locale
        setlocale(LC_TIME, 'id_ID.utf8');

        $labels = [];
        $okData = [];
        $ngData = [];

        $now = Carbon::now()->startOfMonth();

        for ($i = -3; $i <= 3; $i++) {
            $targetMonth = $now->copy()->addMonths($i);

            $startOfMonth = $targetMonth->copy()->startOfMonth();
            $endOfMonth = $targetMonth->copy()->endOfMonth();

            // Query total OK dan NG untuk bulan itu
            $monthly = \App\Models\Checking::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->select(
                    DB::raw('SUM(`OK`) as total_ok'),
                    DB::raw('SUM(`NG`) as total_ng')
                )->first();

            // Nama bulan
            $labels[] = ucfirst(strftime('%B', $targetMonth->timestamp));

            // Masukkan data, default 0 jika null
            $okData[] = $monthly->total_ok ?? 0;
            $ngData[] = $monthly->total_ng ?? 0;
        }

        return view('livewire.dashboard-page', compact(
            'totalOK', 'totalNG', 'totalPemeriksaan',
            'labels', 'okData', 'ngData'
        ));
    }
}
