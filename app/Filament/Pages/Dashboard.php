<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public static function canAccess(): bool
    {
        // Allow all users to access the dashboard. 
        // We will control widget visibility individually instead.
        return true;
    }
}
