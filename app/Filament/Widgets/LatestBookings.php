<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LatestBookings extends TableWidget
{
    // protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 4;

    public static function canView(): bool
    {
        return auth()->user()->can('ViewAny:Booking');
    }

    public function table(Table $table): Table
    {
        $user = auth()->user();
        $isDriver = $user->can('DriverPermission') && !$user->hasRole('super_admin');

        $query = Booking::query()->latest()->limit(5);
        if ($isDriver) {
            $query->where('driver_id', $user->id);
        }

        return $table
            ->query($query)
            ->columns([
                TextColumn::make('booking_no')->label('Booking #'),
                TextColumn::make('passenger_name'),
                TextColumn::make('pickup_date')->date(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'confirmed' => 'success',
                        'pending' => 'warning',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
