<?php

namespace App\Filament\Resources\LetterOfCredits\Pages;

use App\Filament\Resources\LetterOfCredits\LetterOfCreditResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLetterOfCredit extends ViewRecord
{
    protected static string $resource = LetterOfCreditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
