<?php

namespace App\Models;

use App\Scopes\UserVisibilityScope;
use App\Traits\HasActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Expense extends Model
{
    use HasFactory;
    use HasActivity;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'amount',
        'entry_date'
    ];

    protected $casts = [
        'entry_date' => 'date'
    ];

    protected $with = ['category'];

    protected static function booted(): void
    {
        static::addGlobalScope(new UserVisibilityScope());
    }

    public function scopeSearch(Builder $query, string $value): Builder
    {
        return $query->where('title', 'like', '%'.$value.'%')
            ->orWhere('amount', 'like', '%'.$value.'%');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function TotalExpense(): float
    {
        return floatval($this->where('user_id', auth()->user()->id)->sum('amount'));
    }
}