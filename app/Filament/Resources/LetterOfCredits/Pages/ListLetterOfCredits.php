<?php

namespace App\Filament\Resources\LetterOfCredits\Pages;

use App\Filament\Resources\LetterOfCredits\LetterOfCreditResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLetterOfCredits extends ListRecords
{
    protected static string $resource = LetterOfCreditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
