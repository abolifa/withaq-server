<?php

namespace App\Filament\Resources\Outgoings\Pages;

use App\Filament\Resources\Outgoings\OutgoingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOutgoings extends ListRecords
{
    protected static string $resource = OutgoingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
