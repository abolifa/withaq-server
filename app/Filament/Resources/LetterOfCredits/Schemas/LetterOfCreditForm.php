<?php

namespace App\Filament\Resources\LetterOfCredits\Schemas;

use App\Filament\Forms\Components\Selector;
use App\Models\BankAccount;
use App\Models\Contact;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class LetterOfCreditForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Selector::make('company_id')
                    ->label('الشركة')
                    ->relationship('company', 'name')
                    ->reactive()
                    ->required(),
                Selector::make('bank_account_id')
                    ->label('حساب المصرف')
                    ->options(function ($record, Get $get) {
                        $companyId = $get('company_id') ?? $record?->company_id;
                        if (!$companyId) {
                            return [];
                        }

                        return BankAccount::where('company_id', $companyId)
                            ->get()
                            ->mapWithKeys(fn($acc) => [
                                $acc->id => "$acc->bank_name - $acc->branch_name - $acc->account_number",
                            ])
                            ->toArray();
                    })
                    ->reactive()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, Set $set) {
                        $record = BankAccount::find($state);
                        if ($record) {
                            $set('currency', $record->currency);
                        } else {
                            $set('currency', null);
                        }
                    }),
                Selector::make('contact_id')
                    ->label('المستفيد')
                    ->options(fn() => Contact::where('type', 'beneficiary')->pluck('name', 'id')->toArray())
                    ->required(),
                TextInput::make('currency')
                    ->label('العملة'),
                TextInput::make('lc_number')
                    ->label('رقم الاعتماد')
                    ->columnSpanFull()
                    ->required(),
                DatePicker::make('issue_date')
                    ->label('تاريخ الاصدار')
                    ->default(Carbon::now()),
                DatePicker::make('expiry_date')
                    ->label('تاريخ الانتهاء'),
                Select::make('status')
                    ->label('الحالة')
                    ->options([
                        'draft' => 'مسودة',
                        'active' => 'نشط',
                        'expired' => 'منتهي',
                        'closed' => 'مغلق',
                    ])
                    ->default('draft')
                    ->required(),
                TextInput::make('amount')
                    ->label('قيمة الاعتماد')
                    ->numeric(),
            ]);
    }
}
