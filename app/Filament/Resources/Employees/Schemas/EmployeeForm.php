<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
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
                TextInput::make('photo_path'),
                DatePicker::make('join_date'),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
