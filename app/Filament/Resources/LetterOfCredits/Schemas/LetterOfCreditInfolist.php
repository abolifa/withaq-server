<?php

namespace App\Filament\Resources\LetterOfCredits\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LetterOfCreditInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('company.name')
                    ->label('الشركة'),
                TextEntry::make('bankAccount.account_number')
                    ->label('حساب المصرف'),
                TextEntry::make('contact.name')
                    ->label('المستفيد'),
                TextEntry::make('lc_number')
                    ->label('رقم الاعتماد'),
                TextEntry::make('issue_date')
                    ->label('تاريخ الإصدار')
                    ->date('d/m/Y'),
                TextEntry::make('expiry_date')
                    ->label('تاريخ الانتهاء')
                    ->date('d/m/Y'),
                TextEntry::make('status')
                    ->label('الحالة')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'draft' => 'مسودة',
                        'active' => 'نشط',
                        'expired' => 'منتهي',
                        'closed' => 'مغلق',
                        default => $state,
                    }),
                TextEntry::make('amount')
                    ->label('المبلغ')
                    ->numeric(),
                TextEntry::make('currency')
                    ->label('العملة'),
            ])->columns(3);
    }
}
