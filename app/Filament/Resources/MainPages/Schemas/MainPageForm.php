<?php

namespace App\Filament\Resources\MainPages\Schemas;

use App\Models\MainPage;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class MainPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Page Settings')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->label('URL Slug')
                            ->required()
                            ->unique(MainPage::class, 'slug', ignoreRecord: true),
                    ])->columns(2)->columnSpanFull(),

                Section::make('Simple Hero Content')
                    ->description('Configure the cover image and headings for a standard page layout.')
                    ->collapsed()
                    ->schema([
                        TextInput::make('hero_heading')
                            ->label('Hero Heading'),
                        Textarea::make('hero_subheading')
                            ->label('Hero Subheading')
                            ->rows(2),
                        FileUpload::make('cover_image')
                            ->label('Cover Image')
                            ->image()
                            ->disk('public')
                            ->directory('main-pages/covers'),
                    ])->columnSpanFull(),

                Section::make('Advanced Dynamic Sections')
                    ->description('Build custom page layouts by adding dynamic content blocks below.')
                    ->collapsed()
                    ->schema([
                        Builder::make('content_blocks')
                            ->label('Page Blocks')
                            ->blocks([
                                Block::make('rich_text')
                                    ->label('Rich Text Body')
                                    ->icon('heroicon-m-document-text')
                                    ->schema([
                                        RichEditor::make('body')->required(),
                                    ]),
                                Block::make('cta_banner')
                                    ->label('Call to Action Banner')
                                    ->icon('heroicon-m-megaphone')
                                    ->schema([
                                        TextInput::make('title')->required(),
                                        TextInput::make('button_text'),
                                        TextInput::make('button_url'),
                                    ])->columns(2),
                                Block::make('image_gallery')
                                    ->label('Image Gallery')
                                    ->icon('heroicon-m-photo')
                                    ->schema([
                                        FileUpload::make('images')
                                            ->multiple()
                                            ->image()
                                            ->directory('main-pages/galleries'),
                                    ]),
                            ])
                            ->columnSpanFull(),
                    ])->columnSpanFull(),

                Section::make('Visibility')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Active Status')
                            ->default(true)
                            ->onColor('success'),
                    ])->columnSpanFull(),
            ]);
    }
}
