<?php

namespace App\Filament\Resources\Incomings\Schemas;

use App\Filament\Infolists\Components\AttachementViewer;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class IncomingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('المعلومات الأساسية')
                    ->schema([
                        TextEntry::make('issue_number')
                            ->label('الرقم الإشاري'),
                        TextEntry::make('issue_date')
                            ->label('تاريخ الإصدار')
                            ->date('d/m/Y'),
                        TextEntry::make('from')
                            ->label('مرسل من'),
                        TextEntry::make('followUp.id')
                            ->label('تاربع للخطاب'),
                    ])->columns(4)
                    ->columnSpanFull(),

                AttachementViewer::make('document_path')
                    ->label('المرفقات')
                    ->columnSpanFull(),
            ]);
    }
}
