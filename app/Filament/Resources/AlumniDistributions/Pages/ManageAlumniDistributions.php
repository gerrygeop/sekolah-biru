<?php

namespace App\Filament\Resources\AlumniDistributions\Pages;

use App\Filament\Resources\AlumniDistributions\AlumniDistributionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageAlumniDistributions extends ManageRecords
{
    protected static string $resource = AlumniDistributionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
