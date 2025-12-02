<?php

namespace App\Filament\Resources\AlumniDistributions;

use App\Filament\Resources\AlumniDistributions\Pages\ManageAlumniDistributions;
use App\Models\AlumniDistribution;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AlumniDistributionResource extends Resource
{
    protected static ?string $model = AlumniDistribution::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('academic_year_id')
                    ->required()
                    ->numeric(),
                TextInput::make('school_name')
                    ->required(),
                Select::make('school_type')
                    ->options(['sma' => 'Sma', 'smk' => 'Smk', 'ma' => 'Ma', 'lainnya' => 'Lainnya'])
                    ->required(),
                TextInput::make('student_count')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('academic_year_id')
                    ->numeric(),
                TextEntry::make('school_name'),
                TextEntry::make('school_type')
                    ->badge(),
                TextEntry::make('student_count')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('academic_year_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('school_name')
                    ->searchable(),
                TextColumn::make('school_type')
                    ->badge(),
                TextColumn::make('student_count')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageAlumniDistributions::route('/'),
        ];
    }
}
