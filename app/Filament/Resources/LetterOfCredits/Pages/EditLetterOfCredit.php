<?php

namespace App\Filament\Resources\LetterOfCredits\Pages;

use App\Filament\Resources\LetterOfCredits\LetterOfCreditResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLetterOfCredit extends EditRecord
{
    protected static string $resource = LetterOfCreditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
