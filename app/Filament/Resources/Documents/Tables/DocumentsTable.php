<?php

namespace App\Filament\Resources\Documents\Tables;

use App\Enums\DocumentType;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DocumentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company.name')
                    ->label('الشركة')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('type')
                    ->label('النوع')
                    ->formatStateUsing(fn($state) => DocumentType::options()[$state] ?? $state)
                    ->badge()
                    ->color(fn($state) => DocumentType::colors()[$state] ?? 'secondary')
                    ->alignCenter()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('issue_date')
                    ->label('الإصدار')
                    ->date('d/m/Y')
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('expiry_date')
                    ->label('الصلاحية')
                    ->date('d/m/Y')
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('number')
                    ->label('الرقم')
                    ->alignCenter()
                    ->sortable()
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
