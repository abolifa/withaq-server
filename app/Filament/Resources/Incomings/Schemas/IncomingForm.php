<?php

namespace App\Filament\Resources\Incomings\Schemas;

use App\Filament\Forms\Components\Selector;
use App\Helpers\CommonHelpers;
use App\Models\Incoming;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class IncomingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('issue_number')
                    ->label('الرقم الإشاري')
                    ->default(CommonHelpers::getIssueNumber(new Incoming()))
                    ->required(),
                DatePicker::make('issue_date')
                    ->label('تاريخ الإشعار')
                    ->default(now())
                    ->required(),
                Selector::make('from_contact_id')
                    ->label('جهة الإرسال')
                    ->relationship('contact', 'name'),
                TextInput::make('from')
                    ->label('المرسل'),
                Select::make('follow_up_id')
                    ->label('تابع للخطاب')
                    ->relationship('followUp', 'issue_number'),
                FileUpload::make('attachments')
                    ->label('المرفقات')
                    ->multiple()
                    ->acceptedFileTypes([
                        'image/*',
                        'application/pdf',
                    ])
                    ->directory('incomings')
                    ->disk('public')
                    ->visibility('public')
                    ->columnSpanFull(),
            ]);
    }
}
