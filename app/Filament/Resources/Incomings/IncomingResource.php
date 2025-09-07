<?php

namespace App\Filament\Resources\Incomings;

use App\Filament\Resources\Incomings\Pages\CreateIncoming;
use App\Filament\Resources\Incomings\Pages\EditIncoming;
use App\Filament\Resources\Incomings\Pages\ListIncomings;
use App\Filament\Resources\Incomings\Pages\ViewIncoming;
use App\Filament\Resources\Incomings\Schemas\IncomingForm;
use App\Filament\Resources\Incomings\Schemas\IncomingInfolist;
use App\Filament\Resources\Incomings\Tables\IncomingsTable;
use App\Models\Incoming;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class IncomingResource extends Resource
{
    protected static ?string $model = Incoming::class;

    protected static string|BackedEnum|null $navigationIcon = 'emoji-down-arrow';

    protected static ?string $label = 'وارد';
    protected static ?string $pluralLabel = 'البريد الوارد';


    public static function form(Schema $schema): Schema
    {
        return IncomingForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return IncomingInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IncomingsTable::configure($table);
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
            'index' => ListIncomings::route('/'),
            'create' => CreateIncoming::route('/create'),
            'view' => ViewIncoming::route('/{record}'),
            'edit' => EditIncoming::route('/{record}/edit'),
        ];
    }
}
