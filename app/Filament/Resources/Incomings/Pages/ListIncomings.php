<?php

namespace App\Filament\Resources\Incomings\Pages;

use App\Filament\Resources\Incomings\IncomingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIncomings extends ListRecords
{
    protected static string $resource = IncomingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
