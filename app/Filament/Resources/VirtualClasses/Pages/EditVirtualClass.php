<?php

namespace App\Filament\Resources\VirtualClasses\Pages;

use App\Filament\Resources\VirtualClasses\VirtualClassResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditVirtualClass extends EditRecord
{
    protected static string $resource = VirtualClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
