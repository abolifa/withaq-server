<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Select;

class Selector extends Select
{
    public function setUp(): void
    {
        parent::setUp();

        $this->searchable()
            ->preload()
            ->native(false);
    }
}
