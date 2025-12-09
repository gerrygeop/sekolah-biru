<?php

namespace App\Filament\Resources\Achievements\Schemas;

use App\Models\Achievement;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AchievementInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns(2)
                    ->schema([
                        TextEntry::make('title'),
                        TextEntry::make('slug'),
                        TextEntry::make('description')
                            ->placeholder('-')
                            ->columnSpanFull(),
                        TextEntry::make('category')
                            ->badge(),
                        TextEntry::make('level')
                            ->badge(),
                        TextEntry::make('achievement_rank')
                            ->placeholder('-'),
                        TextEntry::make('student_name')
                            ->placeholder('-'),
                        TextEntry::make('student_class')
                            ->placeholder('-'),
                        TextEntry::make('achievement_date')
                            ->date(),
                        ImageEntry::make('image_path')
                            ->placeholder('-'),
                        TextEntry::make('created_by')
                            ->numeric()
                            ->placeholder('-'),

                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('deleted_at')
                            ->dateTime()
                            ->visible(fn(Achievement $record): bool => $record->trashed()),

                        IconEntry::make('is_published')
                            ->boolean(),
                    ])
            ])->columns(1);
    }
}
