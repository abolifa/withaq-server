<?php

namespace App\Filament\Resources\Outgoings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OutgoingInfolist
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
                        TextEntry::make('qr_code')
                            ->label('رمز QR Code'),
                        TextEntry::make('contact.name')
                            ->label('المستلم')
                            ->numeric(),
                        TextEntry::make('template.name')
                            ->label('القالب'),
                        TextEntry::make('to')
                            ->label('إلى'),
                        TextEntry::make('subject')
                            ->label('الموضوع'),
                    ])->columns(3)
                    ->columnSpanFull(),
                Section::make('الرسالة')
                    ->schema([
                        ViewEntry::make('body')
                            ->label('نص الرسالة')
                            ->view('preview.outgoing')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
                Section::make('المرفقات')
                    ->schema([
                        ViewEntry::make('attachments')
                            ->label('المرفقات')
                            ->view('preview.attachments'),
                    ])->columnSpanFull()
                    ->columns(1)
                    ->hidden(fn($record) => empty($record->attachments)),
            ]);
    }
}
