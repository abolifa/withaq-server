<?php

namespace App\Filament\Resources\BankAccounts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BankAccountInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('company.name')
                    ->label('الشركة'),
                TextEntry::make('bank_name')
                    ->label('إسم المصرف'),
                TextEntry::make('branch_name')
                    ->label('إسم الفرع'),
                TextEntry::make('account_number')
                    ->label('رقم الحساب'),
                TextEntry::make('account_type')
                    ->label('نوع الحساب')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'normal' => 'حساب جاري',
                        'savings' => 'حساب إدخار',
                        'card' => 'حساب بطاقة',
                        default => $state,
                    }),
                TextEntry::make('currency')
                    ->label('العملة')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'LYD' => 'دينار ليبي',
                        'USD' => 'دولار أمريكي',
                        'EUR' => 'يورو',
                        'GBP' => 'جنيه إسترليني',
                        'AED' => 'درهم إماراتي',
                        'SF' => 'فرنك سويسري',
                        default => $state,
                    }),
                TextEntry::make('iban')
                    ->label('رمز الآيبان'),
                TextEntry::make('swift_code')
                    ->label('رمز السويفت'),
            ])->columns(3);
    }
}
