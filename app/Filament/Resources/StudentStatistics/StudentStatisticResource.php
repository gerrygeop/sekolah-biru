<?php

namespace App\Filament\Resources\StudentStatistics;

use App\Filament\Resources\StudentStatistics\Pages\ManageStudentStatistics;
use App\Models\StudentStatistic;
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

class StudentStatisticResource extends Resource
{
    protected static ?string $model = StudentStatistic::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('academic_year_id')
                    ->required()
                    ->numeric(),
                Select::make('grade')
                    ->options([7 => '7', '8', '9'])
                    ->required(),
                TextInput::make('male_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('female_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('total_classes')
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
                TextEntry::make('grade')
                    ->badge(),
                TextEntry::make('male_count')
                    ->numeric(),
                TextEntry::make('female_count')
                    ->numeric(),
                TextEntry::make('total_classes')
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
                TextColumn::make('grade')
                    ->badge(),
                TextColumn::make('male_count')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('female_count')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_classes')
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
            'index' => ManageStudentStatistics::route('/'),
        ];
    }
}
