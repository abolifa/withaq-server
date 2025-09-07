<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('الاسم')
                    ->columnSpanFull()
                    ->required(),
                Select::make('type')
                    ->label('نوع جهة الاتصال')
                    ->options([
                        'customer' => 'عميل',
                        'beneficiary' => 'مستفيد',
                        'authority' => 'جهة حكومية',
                        'other' => 'أخرى',
                    ])
                    ->native(false)
                    ->required(),
                TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->email(),
                TextInput::make('phone')
                    ->label('رقم الهاتف')
                    ->tel(),
                TextInput::make('address')
                    ->label('العنوان'),
            ]);
    }
}
