<?php

namespace App\Filament\Resources\Companies\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('البيانات الأساسية')
                    ->schema([
                        TextInput::make('name')
                            ->label('إسم الشركة')
                            ->columnSpanFull()
                            ->required(),
                        TextInput::make('english_name')
                            ->label('الإسم بالإنجليزي'),
                        TextInput::make('phone')
                            ->label('رقم الهاتف')
                            ->tel(),
                        TextInput::make('email')
                            ->label('البريد الإلكتروني')
                            ->email(),
                        TextInput::make('website')
                            ->label('الموقع الإلكتروني')
                            ->url(),
                        TextInput::make('address')
                            ->label('العنوان'),
                        TextInput::make('ceo')
                            ->label('مدير الشركة'),
                    ])->columnSpanFull()
                    ->columns(),
                Repeater::make('members')
                    ->label('أعضاء الشركة')
                    ->reorderable()
                    ->addActionLabel('إضافة عضو')
                    ->table([
                        Repeater\TableColumn::make('الإسم')
                            ->width('50%'),
                        Repeater\TableColumn::make('الصفة')
                            ->width('50%'),
                    ])
                    ->schema([
                        TextInput::make('name')
                            ->hiddenLabel()
                            ->required(),
                        Select::make('type')
                            ->hiddenLabel()
                            ->options([
                                'ceo' => 'مدير عام',
                                'commissioner' => 'مفوض',
                                'partner' => 'شريك',
                                'contributor' => 'مساهم',
                            ])
                            ->native(false)
                            ->required(),
                    ])
                    ->columns()
                    ->defaultItems(0)
                    ->columnSpanFull(),
                FileUpload::make('letterhead')
                    ->label('الرسالة المعنونة')
                    ->image()
                    ->acceptedFileTypes([
                        'image/*',
                        'application/pdf',
                    ])
                    ->visibility('public')
                    ->disk('public')
                    ->directory('companies'),
                FileUpload::make('logo')
                    ->label('شعار الشركة')
                    ->image()
                    ->acceptedFileTypes([
                        'image/*',
                        'application/pdf',
                    ])
                    ->visibility('public')
                    ->disk('public')
                    ->directory('companies'),
            ]);
    }
}
