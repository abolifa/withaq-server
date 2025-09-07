<?php

namespace App\Filament\Resources\Documents\Schemas;

use App\Enums\DocumentType;
use App\Filament\Infolists\Components\AttachementViewer;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class DocumentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('المعلومات الأساسية')
                    ->schema([
                        TextEntry::make('company.name')
                            ->label('الشركة'),
                        TextEntry::make('type')
                            ->label('النوع')
                            ->formatStateUsing(fn($state) => DocumentType::options()[$state] ?? $state),
                        TextEntry::make('issue_date')
                            ->label('تاريخ الإصدار')
                            ->date('d/m/Y'),
                        TextEntry::make('expiry_date')
                            ->label('تاريخ الانتهاء')
                            ->date('d/m/Y'),
                        TextEntry::make('number')
                            ->label('الرقم'),
                    ])
                    ->columns(5)
                    ->columnSpanFull(),

                AttachementViewer::make('document_path')
                    ->label('المرفقات')
                    ->columnSpanFull(),
            ]);
    }
}
