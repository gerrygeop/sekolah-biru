<?php

namespace App\Filament\Resources\StudentStatistics\Pages;

use App\Filament\Resources\StudentStatistics\StudentStatisticResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageStudentStatistics extends ManageRecords
{
    protected static string $resource = StudentStatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
