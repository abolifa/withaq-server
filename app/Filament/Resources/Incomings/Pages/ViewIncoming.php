<?php

namespace App\Filament\Resources\Incomings\Pages;

use App\Filament\Resources\Incomings\IncomingResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewIncoming extends ViewRecord
{
    protected static string $resource = IncomingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
