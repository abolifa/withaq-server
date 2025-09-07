<?php

namespace App\Filament\Resources\Templates\Schemas;

use App\Filament\Forms\Components\BooleanField;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class TemplateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('إسم القالب')
                    ->required(),
                TextInput::make('greeting')
                    ->label('التحية'),
                TextInput::make('closing')
                    ->label('الخاتمة'),
                TextInput::make('position')
                    ->label('المسمى الوظيفي'),
                TextInput::make('commissioner')
                    ->label('المفوض بالتوقيع'),
                Group::make([
                    BooleanField::make('show_position')
                        ->label('إظهار المسمى الوظيفي')
                        ->default(false)
                        ->required(),
                    BooleanField::make('show_commissioner')
                        ->label('إظهار المفوض بالتوقيع')
                        ->default(false)
                        ->required(),
                    BooleanField::make('show_signature')
                        ->label('إظهار التوقيع')
                        ->default(false)
                        ->required(),
                    BooleanField::make('show_stamp')
                        ->label('إظهار الختم')
                        ->default(false)
                        ->required(),
                ])->columns(4)
                    ->columnSpanFull(),
                FileUpload::make('signature')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->label('التوقيع'),
                FileUpload::make('stamp')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->label('الختم'),
            ]);
    }
}
