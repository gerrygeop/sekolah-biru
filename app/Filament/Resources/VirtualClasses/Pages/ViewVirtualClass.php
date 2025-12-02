<?php

namespace App\Filament\Resources\VirtualClasses\Pages;

use App\Filament\Resources\VirtualClasses\VirtualClassResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewVirtualClass extends ViewRecord
{
    protected static string $resource = VirtualClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
