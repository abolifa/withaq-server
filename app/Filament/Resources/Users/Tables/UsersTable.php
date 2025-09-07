<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('الاسم')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('username')
                    ->label('اسم الدخول')
                    ->sortable()
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('email')
                    ->label('البريد')
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('الهاتف')
                    ->alignCenter()
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label('نشط؟')
                    ->alignCenter()
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
