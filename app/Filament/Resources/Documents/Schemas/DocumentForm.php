<?php

namespace App\Filament\Resources\Documents\Schemas;

use App\Enums\DocumentType;
use App\Filament\Forms\Components\Selector;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Selector::make('company_id')
                    ->label('الشركة')
                    ->relationship('company', 'name')
                    ->required(),
                Select::make('type')
                    ->label('نوع المستند')
                    ->options(DocumentType::options())
                    ->native(false)
                    ->required(),
                DatePicker::make('issue_date')
                    ->label('تاريخ الإصدار')
                    ->default(Carbon::now())
                    ->required(),
                DatePicker::make('expiry_date'),
                TextInput::make('number')
                    ->label('رقم المستند'),
                FileUpload::make('attachments')
                    ->label('المرفقات')
                    ->disk('public')
                    ->visibility('public')
                    ->multiple()
                    ->acceptedFileTypes([
                        'image/*',
                        'application/pdf',
                    ])
                    ->columnSpanFull(),
                Textarea::make('notes')
                    ->label('ملاحظات')
                    ->columnSpanFull(),
            ]);
    }
}
