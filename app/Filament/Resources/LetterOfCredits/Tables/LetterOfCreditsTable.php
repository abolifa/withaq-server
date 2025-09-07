<?php

namespace App\Filament\Resources\LetterOfCredits\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LetterOfCreditsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company.name')
                    ->label('الشركة')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('bankAccount.bank_name')
                    ->label('المصرف')
                    ->alignCenter()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('contact.name')
                    ->label('المستفيد')
                    ->sortable()
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('lc_number')
                    ->label('رقم الاعتماد')
                    ->sortable()
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('issue_date')
                    ->label('الاصدار')
                    ->alignCenter()
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('expiry_date')
                    ->label('الانتهاء')
                    ->alignCenter()
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('الحالة')
                    ->alignCenter()
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->formatStateUsing(fn($state) => match ($state) {
                        'draft' => 'مسودة',
                        'active' => 'نشط',
                        'expired' => 'منتهي',
                        'closed' => 'مغلق',
                        default => $state,
                    })->colors([
                        'primary' => 'draft',
                        'success' => 'active',
                        'danger' => 'expired',
                        'secondary' => 'closed',
                    ]),
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
