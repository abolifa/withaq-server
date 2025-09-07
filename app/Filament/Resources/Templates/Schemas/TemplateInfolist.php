<?php

namespace App\Filament\Resources\Templates\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class TemplateInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('إسم القالب'),
                TextEntry::make('greeting')
                    ->label('التحية'),
                TextEntry::make('closing')
                    ->label('الخاتمة'),
                TextEntry::make('commissioner')
                    ->label('المفوض بالتوقيع'),
                TextEntry::make('position')
                    ->label('المسمى الوظيفي'),
                IconEntry::make('show_position')
                    ->label('إظهار المسمى الوظيفي')
                    ->boolean(),
                IconEntry::make('show_commissioner')
                    ->label('إظهار المفوض بالتوقيع')
                    ->boolean(),
                IconEntry::make('show_signature')
                    ->label('إظهار التوقيع')
                    ->boolean(),
                IconEntry::make('show_stamp')
                    ->label('إظهار الختم')
                    ->boolean(),

                Group::make([
                    ImageEntry::make('signature')
                        ->disk('public')
                        ->visibility('public')
                        ->label('التوقيع'),
                    ImageEntry::make('stamp')
                        ->disk('public')
                        ->visibility('public')
                        ->label('الختم'),
                ])->columnSpanFull()
                    ->columns(3),
            ])->columns(3);
    }
}
