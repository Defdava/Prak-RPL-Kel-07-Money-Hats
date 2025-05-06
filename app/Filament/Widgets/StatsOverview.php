<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Income;
use App\Models\Expense;
use Squire\Models\Currency;
use Illuminate\Database\Eloquent\Builder;

class StatsOverview extends BaseWidget
{
    protected float $total_income = 0;
    protected float $total_expense = 0;
    protected float $total_revenue = 0;

    protected function formatAmount($value)
    {
        $currency = auth()->user()->currency ?? 'id';
        return Currency::find($currency)->format($value, true);
    }

    protected function getCards(): array
    {
        // Ngitung totals buat active kategorii (is_active = 1 (itu berarti muncul yhh))
        $this->total_income = Income::whereHas('category', fn (Builder $query) => $query->where('is_active', true))
            ->where('user_id', auth()->user()->id)
            ->sum('amount');

        $this->total_expense = Expense::whereHas('category', fn (Builder $query) => $query->where('is_active', true))
            ->where('user_id', auth()->user()->id)
            ->sum('amount');

        $this->total_revenue = $this->total_income - $this->total_expense;

        return [
            Card::make('Total Income', $this->formatAmount($this->total_income)),
            Card::make('Total Expense', $this->formatAmount($this->total_expense)),
            Card::make('Total Revenue', $this->formatAmount($this->total_revenue))
                ->description($this->total_revenue > 0 ? 'Profit' : 'Loss')
                ->descriptionIcon($this->total_revenue > 0 ? 'heroicon-s-trending-up' : 'heroicon-s-trending-down')
                ->color($this->total_revenue > 0 ? 'success' : 'danger'),
        ];
    }
}