<?php

namespace App\Filament\Resources\VideoGalleries;

use App\Filament\Resources\VideoGalleries\Pages\CreateVideoGallery;
use App\Filament\Resources\VideoGalleries\Pages\EditVideoGallery;
use App\Filament\Resources\VideoGalleries\Pages\ListVideoGalleries;
use App\Filament\Resources\VideoGalleries\Pages\ViewVideoGallery;
use App\Filament\Resources\VideoGalleries\Schemas\VideoGalleryForm;
use App\Filament\Resources\VideoGalleries\Schemas\VideoGalleryInfolist;
use App\Filament\Resources\VideoGalleries\Tables\VideoGalleriesTable;
use App\Models\VideoGallery;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VideoGalleryResource extends Resource
{
    protected static ?string $model = VideoGallery::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return VideoGalleryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VideoGalleryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VideoGalleriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVideoGalleries::route('/'),
            'create' => CreateVideoGallery::route('/create'),
            'view' => ViewVideoGallery::route('/{record}'),
            'edit' => EditVideoGallery::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
