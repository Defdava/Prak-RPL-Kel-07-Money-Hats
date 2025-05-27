<?php

namespace App\Filament\Widgets;

use Filament\Widgets\PieChartWidget;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ExpenseChart extends PieChartWidget
{
    protected static ?string $heading = 'Expense';
    protected static string $color = 'danger';

    protected function getData(): array
    {
        // Ambil data pengeluaran langsung dari database
        $data = Expense::selectRaw('MONTH(entry_date) as month, SUM(amount) as total')
            ->whereBetween('entry_date', [now()->startOfYear(), now()->endOfYear()])
            ->groupByRaw('MONTH(entry_date)')
            ->get()
            ->keyBy('month');

        // Inisialisasi array untuk semua bulan (Januari - Desember)
        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::create(now()->year, $month, 1)->format('F');
        })->toArray();

        // Inisialisasi data pengeluaran dengan 0 untuk setiap bulan
        $incomes = array_fill(0, 12, 0); // Perbaiki typo dari $Incomes menjadi $incomes

        // Isi data pengeluaran dari hasil query
        foreach ($data as $row) {
            $monthIndex = $row->month - 1; // Indeks bulan (0-11)
            $incomes[$monthIndex] = floatval($row->total);
        }

        // Warna gradien untuk efek modern
        $baseColors = [
    '#EF5350', // Merah Muda (sedikit merah untuk peringatan)
    '#78909C', // Abu-abu Biru - netral dan profesional
    '#607D8B', // Biru Tua - serius dan terorganisir
    '#8D6E63', // Cokelat Muda - stabilitas
    '#B0BEC5', // Abu-abu Muda - netral
    '#455A64', // Abu-abu Tua - formal
    '#FF8A65', // Oranye Tua - peringatan ringan
    '#9575CD', // Ungu Tua - kehati-hatian
    '#4E342E', // Cokelat Tua - soliditas
    '#546E7A', // Slate - modern dan tenang
    '#FF7043', // Oranye Terang - sedikit energi
    '#263238', // Abu-abu Gelap - formalitas
];
        $gradientColors = array_map(function ($color) {
            return "rgba(" . implode(',', sscanf($color, '#%02x%02x%02x')) . ", 0.7)"; // Efek transparansi
        }, $baseColors);

        return [
            'datasets' => [
                [
                    'label' => 'Pengeluaran per Bulan',
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