<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Filament\Forms\Components\BooleanField;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('الإسم')
                    ->required(),
                TextInput::make('username')
                    ->label('إسم الدخول')
                    ->required(),
                TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->email(),
                TextInput::make('phone')
                    ->label('رقم الهاتف')
                    ->tel()
                    ->required(),
                TextInput::make('password')
                    ->label('كلمة المرور')
                    ->password()
                    ->required(),
                BooleanField::make('is_active')
                    ->label('نشط؟')
                    ->required(),
            ]);
    }
}
