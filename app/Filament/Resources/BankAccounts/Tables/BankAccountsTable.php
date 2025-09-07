<?php

namespace App\Filament\Resources\BankAccounts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BankAccountsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company.name')
                    ->label('الشركة')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('bank_name')
                    ->label('المصرف')
                    ->sortable()
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('branch_name')
                    ->label('الفرع')
                    ->sortable()
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('account_number')
                    ->label('رقم الحساب')
                    ->sortable()
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('account_type')
                    ->label('نوع الحساب')
                    ->sortable()
                    ->alignCenter()
                    ->searchable()
                    ->formatStateUsing(fn($state) => match ($state) {
                        'normal' => 'حساب جاري',
                        'savings' => 'حساب إدخار',
                        'card' => 'حساب بطاقة',
                        default => $state,
                    })->badge()
                    ->color(fn($state) => match ($state) {
                        'normal' => 'success',
                        'savings' => 'info',
                        'card' => 'warning',
                        default => 'secondary',
                    }),
                TextColumn::make('currency')
                    ->label('العملة')
                    ->sortable()
                    ->alignCenter()
                    ->searchable()
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'LYD' => 'success',
                        'USD' => 'info',
                        'EUR' => 'primary',
                        'GBP' => 'warning',
                        'AED' => 'gray',
                        'SF' => 'danger',
                        default => 'secondary',
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
