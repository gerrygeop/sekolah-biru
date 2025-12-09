<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns(2)
                    ->schema([
                        TextInput::make('nip')
                            ->required(),
                        TextInput::make('name')
                            ->required(),
                        Select::make('type')
                            ->options(['guru' => 'Guru', 'staff' => 'Staff', 'tenaga_kependidikan' => 'Tenaga kependidikan'])
                            ->required(),
                        TextInput::make('position'),
                        TextInput::make('subject'),
                        TextInput::make('education'),
                        TextInput::make('phone')
                            ->tel(),
                        TextInput::make('email')
                            ->label('Email address')
                            ->email(),
                        DatePicker::make('join_date'),
                        FileUpload::make('photo_path')
                            ->label('Photo')
                            ->image()
                            ->directory('employees')
                            ->maxSize(5024)
                            ->nullable()
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
