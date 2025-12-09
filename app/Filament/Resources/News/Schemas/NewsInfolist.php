<?php

namespace App\Filament\Resources\News\Schemas;

use App\Models\News;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class NewsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns(2)
                    ->schema([
                        TextEntry::make('category.name')
                            ->label('Kategori'),
                        TextEntry::make('title'),
                        TextEntry::make('slug'),
                        TextEntry::make('excerpt')
                            ->label('Kutipan')
                            ->placeholder('-')
                            ->columnSpanFull(),
                        TextEntry::make('content')
                            ->columnSpanFull(),
                        ImageEntry::make('featured_image')
                            ->placeholder('-'),
                        TextEntry::make('publish_date')
                            ->date()
                            ->placeholder('-'),
                        TextEntry::make('status')
                            ->badge(),
                        TextEntry::make('author.name')
                            ->numeric()
                            ->placeholder('-'),
                        TextEntry::make('views')
                            ->numeric(),
                        IconEntry::make('is_featured')
                            ->boolean(),
                        IconEntry::make('is_pinned')
                            ->boolean(),
                        TextEntry::make('meta_title')
                            ->placeholder('-'),
                        TextEntry::make('meta_description')
                            ->placeholder('-')
                            ->columnSpanFull(),
                        TextEntry::make('meta_keywords')
                            ->placeholder('-'),
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('deleted_at')
                            ->dateTime()
                            ->visible(fn(News $record): bool => $record->trashed()),
                    ]),

                Section::make('Konten Berita')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('excerpt')
                            ->label('Kutipan')
                            ->placeholder('-')
                            ->columnSpanFull(),

                        TextEntry::make('content')
                            ->columnSpanFull(),
                    ]),

                Section::make('Metadata')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('meta_title')
                            ->placeholder('-'),
                        TextEntry::make('meta_description')
                            ->placeholder('-')
                            ->columnSpanFull(),
                        TextEntry::make('meta_keywords')
                            ->placeholder('-'),
                    ]),
            ])
            ->columns(1);
    }
}
