<?php

namespace App\Filament\Resources\AcademicYears\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AcademicYearForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns(2)
                    ->schema([
                        TextInput::make('year')
                            ->placeholder('2024/2025')
                            ->required(),
                        Group::make()
                            ->columnSpanFull()
                            ->schema([
                                DatePicker::make('start_date')
                                    ->required(),
                                DatePicker::make('end_date')
                                    ->required(),
                            ])->columns(2),
                        Toggle::make('is_active')
                            ->required()
                            ->columnSpanFull(),
                    ])
            ])->columns(1);
    }
}
