<?php

namespace App\Filament\Resources\VirtualClasses\Pages;

use App\Filament\Resources\VirtualClasses\VirtualClassResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVirtualClasses extends ListRecords
{
    protected static string $resource = VirtualClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
