<?php

namespace App\Filament\Resources\VirtualClasses\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class VirtualClassForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('grade')
                    ->options([7 => '7', '8', '9'])
                    ->required(),
                TextInput::make('class_name')
                    ->required(),
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                Select::make('type')
                    ->options(['link' => 'Link', 'file' => 'File', 'embed' => 'Embed'])
                    ->required(),
                TextInput::make('url')
                    ->url(),
                TextInput::make('file_path'),
                Textarea::make('embed_code')
                    ->columnSpanFull(),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('created_by')
                    ->relationship('author', 'name'),
                Toggle::make('is_published')
                    ->required(),
            ]);
    }
}
