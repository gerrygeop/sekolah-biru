<?php

namespace App\Filament\Resources\VirtualClasses\Pages;

use App\Filament\Resources\VirtualClasses\VirtualClassResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVirtualClass extends CreateRecord
{
    protected static string $resource = VirtualClassResource::class;
}
