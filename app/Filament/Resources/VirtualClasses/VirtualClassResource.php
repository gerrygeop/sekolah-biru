<?php

namespace App\Filament\Resources\VirtualClasses;

use App\Filament\Resources\VirtualClasses\Pages\CreateVirtualClass;
use App\Filament\Resources\VirtualClasses\Pages\EditVirtualClass;
use App\Filament\Resources\VirtualClasses\Pages\ListVirtualClasses;
use App\Filament\Resources\VirtualClasses\Pages\ViewVirtualClass;
use App\Filament\Resources\VirtualClasses\Schemas\VirtualClassForm;
use App\Filament\Resources\VirtualClasses\Schemas\VirtualClassInfolist;
use App\Filament\Resources\VirtualClasses\Tables\VirtualClassesTable;
use App\Models\VirtualClass;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VirtualClassResource extends Resource
{
    protected static ?string $model = VirtualClass::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return VirtualClassForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VirtualClassInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VirtualClassesTable::configure($table);
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
            'index' => ListVirtualClasses::route('/'),
            'create' => CreateVirtualClass::route('/create'),
            'view' => ViewVirtualClass::route('/{record}'),
            'edit' => EditVirtualClass::route('/{record}/edit'),
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
