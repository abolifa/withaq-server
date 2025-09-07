<?php

namespace App\Filament\Resources\Outgoings\Pages;

use App\Filament\Resources\Outgoings\OutgoingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOutgoing extends CreateRecord
{
    protected static string $resource = OutgoingResource::class;
}
