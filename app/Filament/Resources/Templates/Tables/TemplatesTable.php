<?php

namespace App\Filament\Resources\Templates\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TemplatesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('الإسم')
                    ->searchable(),
                TextColumn::make('greeting')
                    ->label('التحية')
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('closing')
                    ->label('الخاتمة')
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('commissioner')
                    ->label('المفوض')
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
