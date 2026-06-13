<?php

namespace App\Filament\Resources\MainPages;

use App\Filament\Resources\MainPages\Pages\CreateMainPage;
use App\Filament\Resources\MainPages\Pages\EditMainPage;
use App\Filament\Resources\MainPages\Pages\ListMainPages;
use App\Filament\Resources\MainPages\Schemas\MainPageForm;
use App\Filament\Resources\MainPages\Tables\MainPagesTable;
use App\Models\MainPage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MainPageResource extends Resource
{
    protected static ?string $model = MainPage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentDuplicate;
    protected static \UnitEnum|string|null $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return MainPageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MainPagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMainPages::route('/'),
            'create' => CreateMainPage::route('/create'),
            'edit' => EditMainPage::route('/{record}/edit'),
        ];
    }
}
