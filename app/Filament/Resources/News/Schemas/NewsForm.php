<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Berita')
                            ->columns(2)
                            ->collapsible()
                            ->schema([
                                TextInput::make('title')
                                    ->required(),
                                TextInput::make('slug')
                                    ->required(),

                                DatePicker::make('publish_date'),
                                Select::make('status')
                                    ->options([
                                        'draft' => 'Draft',
                                        'published' => 'Published'
                                    ])
                                    ->default('draft')
                                    ->required(),
                            ]),

                        Section::make('Konten')
                            ->columns(1)
                            ->collapsible()
                            ->schema([
                                Textarea::make('excerpt')
                                    ->label('Kutipan')
                                    ->columnSpanFull(),
                                RichEditor::make('content')
                                    ->required()
                                    ->columnSpanFull(),
                                FileUpload::make('featured_image')
                                    ->image(),
                            ]),

                        Section::make('Metadata')
                            ->columns(1)
                            ->collapsible()
                            ->schema([
                                TextInput::make('meta_title'),
                                Textarea::make('meta_description')
                                    ->columnSpanFull(),
                                TextInput::make('meta_keywords'),
                            ])
                    ])->columnSpan(2),

                Section::make('Informasi Tambahan')
                    ->collapsible()
                    ->schema([
                        Select::make('category_id')
                            ->required()
                            ->relationship('category', 'name'),
                        Select::make('author_id')
                            ->relationship('author', 'name')
                            ->required(),
                        TextInput::make('views')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_featured')
                            ->required(),
                        Toggle::make('is_pinned')
                            ->required(),
                    ])
                    ->columnSpan(1),
            ])
            ->columns(3);
    }
}
