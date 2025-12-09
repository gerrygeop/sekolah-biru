<?php

namespace App\Filament\Resources\VideoGalleries\Schemas;

use App\Models\VideoGallery;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VideoGalleryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns(2)
                    ->schema([
                        ImageEntry::make('thumbnail_url')
                            ->placeholder('-')
                            ->columnSpanFull(),
                        TextEntry::make('title'),
                        TextEntry::make('slug'),
                        TextEntry::make('description')
                            ->placeholder('-')
                            ->columnSpanFull(),
                        TextEntry::make('youtube_url'),
                        TextEntry::make('youtube_id'),

                        TextEntry::make('video_date')
                            ->date()
                            ->placeholder('-'),
                        TextEntry::make('created_by')
                            ->numeric()
                            ->placeholder('-'),
                        TextEntry::make('order')
                            ->numeric(),
                        IconEntry::make('is_published')
                            ->boolean(),
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('deleted_at')
                            ->dateTime()
                            ->visible(fn(VideoGallery $record): bool => $record->trashed()),
                    ])
            ])
            ->columns(1);
    }
}
