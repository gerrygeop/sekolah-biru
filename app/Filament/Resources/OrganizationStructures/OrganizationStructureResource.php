<?php

namespace App\Filament\Resources\OrganizationStructures;

use App\Filament\Resources\OrganizationStructures\Pages\ManageOrganizationStructures;
use App\Models\OrganizationStructure;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class OrganizationStructureResource extends Resource
{
    protected static ?string $model = OrganizationStructure::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleGroup;
    protected static string|UnitEnum|null $navigationGroup = 'Profil Sekolah';
    protected static string|null $label = 'Struktur Organisasi';
    protected static ?int $navigationSort = -15;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('position')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('nip'),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
                FileUpload::make('photo_path')
                    ->label('Foto')
                    ->directory('organization-structure-photos')
                    ->image()
                    ->maxSize(5024)
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->required()
                    ->columnSpanFull()
                    ->default(true),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('position'),
                TextEntry::make('name'),
                TextEntry::make('nip')
                    ->placeholder('-'),
                TextEntry::make('photo_path')
                    ->placeholder('-'),
                TextEntry::make('order')
                    ->numeric(),
                IconEntry::make('is_active')
                    ->boolean(),
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
                TextColumn::make('position')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('nip')
                    ->searchable(),
                TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean(),
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
            'index' => ManageOrganizationStructures::route('/'),
        ];
    }
}
