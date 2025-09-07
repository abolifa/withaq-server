<?php

namespace App\Filament\Resources\Outgoings\Pages;

use App\Filament\Resources\Outgoings\OutgoingResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewOutgoing extends ViewRecord
{
    protected static string $resource = OutgoingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
