<?php

namespace App\Filament\Resources\Outgoings\Schemas;

use App\Filament\Forms\Components\Selector;
use App\Helpers\CommonHelpers;
use App\Models\Contact;
use App\Models\Outgoing;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class OutgoingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Selector::make('company_id')
                    ->label('الشركة')
                    ->relationship('company', 'name')
                    ->required(),
                TextInput::make('issue_number')
                    ->label('الرقم الإشاري')
                    ->default(CommonHelpers::getIssueNumber(new Outgoing()))
                    ->required(),
                DatePicker::make('issue_date')
                    ->label('تاريخ الإصدار')
                    ->default(now())
                    ->required(),
                TextInput::make('qr_code')
                    ->label('رمز QR')
                    ->suffixAction(
                        Action::make('generateQRCode')
                            ->label('توليد رمز QR')
                            ->icon(Heroicon::QrCode)
                            ->tooltip('توليد رمز QR للرسالة')
                            ->action(function (Get $get, Set $set) {
                                $qr = CommonHelpers::buildOutgoingQrPayload(
                                    $get('issue_number')
                                );
                                $set('qr_code', $qr);
                            })
                    ),
                Selector::make('to_contact_id')
                    ->label('المستلم')
                    ->reactive()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Get $get, Set $set, $state) {
                        $contact = Contact::find($state);
                        if ($contact) {
                            $set('to', $contact->name);
                        } else {
                            $set('to', null);
                        }
                    })
                    ->relationship('contact', 'name'),
                Selector::make('template_id')
                    ->label('القالب')
                    ->relationship('template', 'name'),
                TextInput::make('to')
                    ->label('إلى')
                    ->required(),
                TextInput::make('subject')
                    ->label('الموضوع')
                    ->required(),
                TagsInput::make('cc')
                    ->label('نسخة إلى'),
                TextInput::make('document_path')
                    ->label('إمتداد المستند')
                    ->disabled()
                    ->dehydrated(),
                RichEditor::make('body')
                    ->columnSpanFull(),
                FileUpload::make('attachments')
                    ->multiple()
                    ->acceptedFileTypes([
                        'image/*',
                        'application/pdf',
                    ])
                    ->disk('public')
                    ->visibility('public')
                    ->columnSpanFull()
                    ->label('المرفقات'),
            ]);
    }
}
