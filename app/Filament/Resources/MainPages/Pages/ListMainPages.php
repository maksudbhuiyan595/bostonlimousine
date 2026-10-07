<?php

namespace App\Filament\Resources\MainPages\Pages;

use App\Filament\Resources\MainPages\MainPageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMainPages extends ListRecords
{
    protected static string $resource = MainPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
