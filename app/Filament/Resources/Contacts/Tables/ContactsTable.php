<?php

namespace App\Filament\Resources\Contacts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')
                    ->label('النوع')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'customer' => 'عميل',
                        'beneficiary' => 'مستفيد',
                        'authority' => 'جهة حكومية',
                        'other' => 'أخرى',
                        default => $state,
                    })
                    ->searchable()
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'customer' => 'success',
                        'beneficiary' => 'info',
                        'authority' => 'warning',
                        'other' => 'gray',
                        default => 'secondary',
                    })
                    ->sortable(),
                TextColumn::make('name')
                    ->label('الاسم')
                    ->sortable()
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('email')
                    ->label('البريد')
                    ->sortable()
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('الهاتف')
                    ->sortable()
                    ->alignCenter()
                    ->searchable(),
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
