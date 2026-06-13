<?php

namespace App\Filament\Resources\MainPages\Pages;

use App\Filament\Resources\MainPages\MainPageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMainPage extends EditRecord
{
    protected static string $resource = MainPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
