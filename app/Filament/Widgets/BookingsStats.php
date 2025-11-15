<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BookingsStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Pending Bookings', Booking::where('status', 'pending')->count())
                ->description('Bookings awaiting approval')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('Accepted Bookings', Booking::where('status', 'accepted')->count())
                ->description('Confirmed bookings')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Canceled Bookings', Booking::where('status', 'canceled')->count())
                ->description('Bookings that were canceled')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger'),
        ];
    }
}
