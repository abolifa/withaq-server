<?php

namespace App\Filament\Resources\BankAccounts\Schemas;

use App\Filament\Forms\Components\Selector;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BankAccountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Selector::make('company_id')
                    ->label('الشركة')
                    ->relationship('company', 'name')
                    ->required(),
                TextInput::make('bank_name')
                    ->label('إسم المصرف')
                    ->required(),
                TextInput::make('branch_name')
                    ->label('إسم الفرع'),
                TextInput::make('account_number')
                    ->label('رقم الحساب')
                    ->required(),
                Select::make('account_type')
                    ->label('نوع الحساب')
                    ->options([
                        'normal' => 'حساب جاري',
                        'savings' => 'حساب إدخار',
                        'card' => 'حساب بطاقة',
                    ])
                    ->native(false)
                    ->default('normal')
                    ->required(),
                Selector::make('currency')
                    ->label('العملة')
                    ->options([
                        'LYD' => 'دينار ليبي',
                        'USD' => 'دولار أمريكي',
                        'EUR' => 'يورو',
                        'GBP' => 'جنيه إسترليني',
                        'AED' => 'درهم إماراتي',
                        'SF' => 'فرنك سويسري',
                    ])
                    ->native(false)
                    ->default('LYD'),
                TextInput::make('iban')
                    ->label('رمز الآيبان'),
                TextInput::make('swift_code')
                    ->label('رمز السويفت'),
            ]);
    }
}
