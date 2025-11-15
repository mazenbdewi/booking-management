<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class StaffBookingsCount extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        return auth()->user()?->hasRole('super_admin');
    }

    protected function getTableQuery(): Builder
    {
        return User::query()
            ->whereHas('roles', fn ($q) => $q->where('name', 'staff'))
            ->withCount('bookings');
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->label('Staff Name')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('bookings_count')
                ->label('Total Created Bookings')
                ->badge()
                ->color('primary')
                ->sortable(),
        ];
    }
}
