<?php

namespace App\Filament\Resources\Employees\Schemas;

use App\Models\Employee;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EmployeeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns(2)
                    ->schema([
                        ImageEntry::make('photo_path')
                            ->placeholder('-')
                            ->circular()
                            ->columnSpan(2),
                        TextEntry::make('nip'),
                        TextEntry::make('name'),
                        TextEntry::make('type')
                            ->badge(),
                        TextEntry::make('position')
                            ->placeholder('-'),
                        TextEntry::make('subject')
                            ->placeholder('-'),
                        TextEntry::make('education')
                            ->placeholder('-'),
                        TextEntry::make('phone')
                            ->placeholder('-'),
                        TextEntry::make('email')
                            ->label('Email address')
                            ->placeholder('-'),

                        TextEntry::make('join_date')
                            ->date()
                            ->placeholder('-'),
                        IconEntry::make('is_active')
                            ->boolean(),
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('deleted_at')
                            ->dateTime()
                            ->visible(fn(Employee $record): bool => $record->trashed()),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
