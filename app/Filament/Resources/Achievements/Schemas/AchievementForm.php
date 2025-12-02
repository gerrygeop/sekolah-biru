<?php

namespace App\Filament\Resources\Achievements\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AchievementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                Select::make('category')
                    ->options(['akademik' => 'Akademik', 'olahraga' => 'Olahraga', 'seni' => 'Seni', 'lainnya' => 'Lainnya'])
                    ->required(),
                Select::make('level')
                    ->options([
            'sekolah' => 'Sekolah',
            'kecamatan' => 'Kecamatan',
            'kabupaten' => 'Kabupaten',
            'provinsi' => 'Provinsi',
            'nasional' => 'Nasional',
            'internasional' => 'Internasional',
        ])
                    ->required(),
                TextInput::make('achievement_rank'),
                TextInput::make('student_name'),
                TextInput::make('student_class'),
                DatePicker::make('achievement_date')
                    ->required(),
                FileUpload::make('image_path')
                    ->image(),
                TextInput::make('created_by')
                    ->numeric(),
                Toggle::make('is_published')
                    ->required(),
            ]);
    }
}
