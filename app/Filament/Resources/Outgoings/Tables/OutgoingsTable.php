<?php

namespace App\Filament\Resources\Outgoings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OutgoingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('issue_number')
                    ->label('الإشاري')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('issue_date')
                    ->label('التاريخ')
                    ->date('d/m/Y')
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('template.name')
                    ->label('القالب')
                    ->sortable()
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('to')
                    ->label('إلى')
                    ->sortable()
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('subject')
                    ->label('الموضوع')
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
