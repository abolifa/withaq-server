<?php

namespace App\Filament\Resources\Companies\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class CompanyInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('إسم الشركة'),
                TextEntry::make('english_name')
                    ->label('الإسم بالإنجليزي'),
                TextEntry::make('phone')
                    ->placeholder('---')
                    ->label('رقم الهاتف'),
                TextEntry::make('email')
                    ->placeholder('---')
                    ->label('البريد الإلكتروني'),
                TextEntry::make('website')
                    ->placeholder('---')
                    ->label('الموقع الإلكتروني'),
                TextEntry::make('address')
                    ->placeholder('---')
                    ->label('العنوان'),
                TextEntry::make('ceo')
                    ->placeholder('---')
                    ->label('مدير الشركة'),
                Group::make([
                    ImageEntry::make('letterhead')
                        ->label('الرسالة المعنونة')
                        ->visibility('public')
                        ->imageHeight(600)
                        ->imageHeight(300)
                        ->disk('public'),
                    ImageEntry::make('logo')
                        ->label('شعار الشركة')
                        ->visibility('public')
                        ->imageHeight(100)
                        ->imageHeight(100)
                        ->disk('public'),
                ])->columnSpanFull()
                    ->columns(3),
            ])->columns(3);
    }
}
