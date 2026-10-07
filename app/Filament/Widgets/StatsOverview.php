<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Vehicle;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected ?string $pollingInterval = '15s';
    protected static ?int $sort = 1;

    public static function canView(): bool
    {
        return auth()->user()->can('ViewAny:Booking');
    }

    protected function getStats(): array
    {
        $user = auth()->user();
        $isDriver = $user->can('DriverPermission') && !$user->hasRole('super_admin');

        $bookingsQuery = Booking::query();
        if ($isDriver) {
            $bookingsQuery->where('driver_id', $user->id);
        }

        $stats = [
            Stat::make('Total Bookings', (clone $bookingsQuery)->count())
                ->description('All time bookings')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Total Revenue', '$' . number_format((clone $bookingsQuery)->where('status', 'completed')->sum('total_fare'), 2))
                ->description('From completed trips')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('primary'),
            Stat::make('Pending Requests', (clone $bookingsQuery)->where('status', 'pending')->count())
                ->description('Needs attention')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
        ];

        // Drivers don't need to see Active Vehicles
        if (!$isDriver) {
            $stats[] = Stat::make('Active Vehicles', Vehicle::where('is_active', true)->count())
                ->description('Ready for service')
                ->icon('heroicon-o-truck');
        }

        return $stats;
    }
}
