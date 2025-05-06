<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Widgets\Widget;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Activity;
use Squire\Models\Currency;

class RecentActivity extends Widget implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static string $view = 'filament.widgets.recent-activity';

    protected int | string | array $columnSpan = 'full';

    protected function formatAmount($value)
    {
        $currency = auth()->user()->currency ?? 'idr';

        if ($currency === 'idr') {
            return 'Rp ' . number_format($value, 0, ',', '.');
        }
        return '$' . number_format($value, 2);
    }

    //NAMBAHIN is_active 1 biar nampilin yang active aja
    protected function getTableQuery(): Builder
    {
        return Activity::latest()
            ->whereHasMorph('subject', ['App\Models\Income', 'App\Models\Expense'], function (Builder $query) {
                $query->whereHas('category', fn (Builder $query) => $query
                    ->whereNull('deleted_at')
                    ->where('is_active', true)
                );
            })
            ->take(10);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('subject.title')
                ->label('Title')
                ->default('N/A'),
            Tables\Columns\BadgeColumn::make('subject_type')
                ->enum([
                    'expense' => 'Expense',
                    'income' => 'Income',
                ])
                ->colors([
                    'danger' => 'expense',
                    'success' => 'income',
                ])
                ->label('Type'),
            Tables\Columns\TextColumn::make('subject.category.name')
                ->label('Category')
                ->default('N/A'),
            Tables\Columns\TextColumn::make('subject.amount')
                ->getStateUsing(fn ($record): string => $record->subject ? $this->formatAmount($record->subject->amount) : 'N/A')
                ->label('Amount'),
            Tables\Columns\TextColumn::make('subject.entry_date')
                ->label('Entry Date')
                ->getStateUsing(fn ($record): string => $record->subject && $record->subject->entry_date 
                    ? \Carbon\Carbon::parse($record->subject->entry_date)->toFormattedDateString() 
                    : 'N/A'),
        ];
    }
}