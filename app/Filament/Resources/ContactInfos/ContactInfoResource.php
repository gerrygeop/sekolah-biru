<?php

namespace App\Filament\Resources\ContactInfos;

use App\Filament\Resources\ContactInfos\Pages\ManageContactInfos;
use App\Models\ContactInfo;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class ContactInfoResource extends Resource
{
    protected static ?string $model = ContactInfo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhone;
    protected static string|UnitEnum|null $navigationGroup = 'Profil Sekolah';
    protected static string|null $label = 'Info Kontak';
    protected static ?int $navigationSort = -12;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('address'),
                TextInput::make('phone')
                    ->tel(),
                TextInput::make('whatsapp'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('facebook_url')
                    ->url(),
                TextInput::make('instagram_url')
                    ->url(),
                TextInput::make('youtube_url')
                    ->url(),
                TextInput::make('twitter_url')
                    ->url(),
                Textarea::make('google_maps_embed')
                    ->columnSpanFull(),
                TextInput::make('latitude'),
                TextInput::make('longitude'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('address')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('whatsapp')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('facebook_url')
                    ->searchable(),
                TextColumn::make('instagram_url')
                    ->searchable(),
                TextColumn::make('youtube_url')
                    ->searchable(),
                TextColumn::make('twitter_url')
                    ->searchable(),
                TextColumn::make('latitude')
                    ->searchable(),
                TextColumn::make('longitude')
                    ->searchable(),
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
            'index' => ManageContactInfos::route('/'),
        ];
    }
}
