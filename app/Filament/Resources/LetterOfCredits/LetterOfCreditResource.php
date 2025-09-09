<?php

namespace App\Filament\Resources\LetterOfCredits;

use App\Filament\Resources\LetterOfCredits\Pages\CreateLetterOfCredit;
use App\Filament\Resources\LetterOfCredits\Pages\EditLetterOfCredit;
use App\Filament\Resources\LetterOfCredits\Pages\ListLetterOfCredits;
use App\Filament\Resources\LetterOfCredits\Pages\ViewLetterOfCredit;
use App\Filament\Resources\LetterOfCredits\Schemas\LetterOfCreditForm;
use App\Filament\Resources\LetterOfCredits\Schemas\LetterOfCreditInfolist;
use App\Filament\Resources\LetterOfCredits\Tables\LetterOfCreditsTable;
use App\Models\LetterOfCredit;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class LetterOfCreditResource extends Resource
{
    protected static ?string $model = LetterOfCredit::class;

    protected static string|BackedEnum|null $navigationIcon = 'emoji-money-bag';

    protected static ?string $label = 'اعتماد';
    protected static ?string $pluralLabel = 'الإعتمادات المستندية';
    protected static ?int $navigationSort = 3;


    public static function form(Schema $schema): Schema
    {
        return LetterOfCreditForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LetterOfCreditInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LetterOfCreditsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLetterOfCredits::route('/'),
            'create' => CreateLetterOfCredit::route('/create'),
            'view' => ViewLetterOfCredit::route('/{record}'),
            'edit' => EditLetterOfCredit::route('/{record}/edit'),
        ];
    }
}
