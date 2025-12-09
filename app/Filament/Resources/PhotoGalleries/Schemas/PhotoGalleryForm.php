<?php

namespace App\Filament\Resources\PhotoGalleries\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PhotoGalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required(),
                        TextInput::make('slug')
                            ->required(),
                        Textarea::make('description')
                            ->columnSpanFull(),
                        FileUpload::make('image_path')
                            ->image()
                            ->required(),
                        TextInput::make('thumbnail_path'),
                        DatePicker::make('photo_date'),
                        Select::make('created_by')
                            ->relationship('author', 'name')
                            ->required(),
                        TextInput::make('order')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_published')
                            ->required()
                            ->columnSpanFull(),
                    ])
            ])
            ->columns(1);
    }
}
