<?php

namespace App\Filament\Widgets;

use Filament\Widgets\PieChartWidget;
use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class IncomeChart extends PieChartWidget
{
    protected static ?string $heading = 'Income';
    protected static string $color = 'success'; // Menggunakan warna hijau untuk pendapatan

    protected function getData(): array
    {
        // Ambil data pendapatan langsung dari database
        $data = Income::selectRaw('MONTH(entry_date) as month, SUM(amount) as total')
            ->whereBetween('entry_date', [now()->startOfYear(), now()->endOfYear()])
            ->groupByRaw('MONTH(entry_date)')
            ->get()
            ->keyBy('month');

        // Inisialisasi array untuk semua bulan (Januari - Desember)
        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::create(now()->year, $month, 1)->format('F');
        })->toArray();

        // Inisialisasi data pendapatan dengan 0 untuk setiap bulan
        $incomes = array_fill(0, 12, 0); // Perbaiki typo dari $Incomes menjadi $incomes

        // Isi data pendapatan dari hasil query
        foreach ($data as $row) {
            $monthIndex = $row->month - 1; // Indeks bulan (0-11)
            $incomes[$monthIndex] = floatval($row->total);
        }

        // Warna gradien untuk efek modern (palet hijau untuk pendapatan)
        $baseColors = [
    '#FFD700', 
    '#FFA500', 
    '#FFCA28', 
    '#FF5722', 
    '#F06292', 
    '#E91E63', 
    '#AB47BC', 
    '#5C6BC0',
    '#42A5F5', 
    '#26C6DA', 
    '#66BB6A', 
    '#FF8A65',
];
        $gradientColors = array_map(function ($color) {
            return "rgba(" . implode(',', sscanf($color, '#%02x%02x%02x')) . ", 0.7)"; // Efek transparansi
        }, $baseColors);

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan per Bulan', // Perbaiki label
                    'data' => $incomes,
                    'backgroundColor' => $gradientColors,
                    'borderColor' => array_map(function ($color) {
                        return "rgba(" . implode(',', sscanf($color, '#%02x%02x%02x')) . ", 1)"; // Border lebih tegas
                    }, $baseColors),
                    'borderWidth' => 2,
                    'hoverBackgroundColor' => array_map(function ($color) {
                        return "rgba(" . implode(',', sscanf($color, '#%02x%02x%02x')) . ", 0.9)"; // Efek hover
                    }, $baseColors),
                    'hoverOffset' => 8, // Efek hover lebih menonjol
                ],
            ],
            'labels' => $months,
            'options' => [
                'plugins' => [
                    'legend' => [
                        'position' => 'bottom', // Posisi legenda di bawah untuk tampilan modern
                        'labels' => [
                            'font' => [
                                'size' => 14,
                            ],
                            'color' => '#333',
                        ],
                    ],
                    'tooltip' => [
                        'backgroundColor' => '#fff',
                        'titleColor' => '#333',
                        'bodyColor' => '#666',
                        'borderColor' => '#ddd',
                        'borderWidth' => 1,
                    ],
                ],
                'animation' => [
                    'animateRotate' => true,
                    'animateScale' => true, // Efek animasi saat memuat
                ],
            ],
        ];
    }
}