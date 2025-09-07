<?php

namespace App\Filament\Resources\Companies\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CompaniesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
//                TextColumn::make('id'),
                TextColumn::make('name')
                    ->label('الإسم')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('الهاتف')
                    ->sortable()
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('email')
                    ->label('البريد')
                    ->sortable()
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('address')
                    ->label('العنوان')
                    ->sortable()
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('ceo')
                    ->label('المدير')
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
