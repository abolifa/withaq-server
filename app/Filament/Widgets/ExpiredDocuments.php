<?php

namespace App\Filament\Widgets;

use App\Enums\DocumentType;
use App\Models\Document;
use Carbon\Carbon;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class ExpiredDocuments extends TableWidget
{
    protected static ?string $heading = 'مستندات على وشك الانتهاء';
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(fn(): Builder => Document::query()
                ->where(function ($q) {
                    $q->where('expiry_date', '<', Carbon::now())
                        ->orWhereBetween('expiry_date', [Carbon::now(), Carbon::now()->addMonth()]);
                })
            )
            ->emptyStateHeading('لا توجد مستندات')
            ->columns([
                TextColumn::make('company.name')
                    ->label('الشركة')
                    ->sortable(),
                TextColumn::make('type')
                    ->label('النوع')
                    ->formatStateUsing(fn($state) => DocumentType::options()[$state] ?? $state)
                    ->badge()
                    ->color(fn($state) => DocumentType::colors()[$state] ?? 'secondary')
                    ->alignCenter()
                    ->sortable(),
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
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
