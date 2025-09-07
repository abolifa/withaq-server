<?php

namespace App\Filament\Resources\Outgoings;

use App\Filament\Resources\Outgoings\Pages\CreateOutgoing;
use App\Filament\Resources\Outgoings\Pages\EditOutgoing;
use App\Filament\Resources\Outgoings\Pages\ListOutgoings;
use App\Filament\Resources\Outgoings\Pages\ViewOutgoing;
use App\Filament\Resources\Outgoings\Schemas\OutgoingForm;
use App\Filament\Resources\Outgoings\Schemas\OutgoingInfolist;
use App\Filament\Resources\Outgoings\Tables\OutgoingsTable;
use App\Models\Outgoing;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class OutgoingResource extends Resource
{
    protected static ?string $model = Outgoing::class;

    protected static string|BackedEnum|null $navigationIcon = 'emoji-up-arrow';

    protected static ?string $label = 'صادر';
    protected static ?string $pluralLabel = 'البريد الصادر';


    public static function form(Schema $schema): Schema
    {
        return OutgoingForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OutgoingInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OutgoingsTable::configure($table);
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
            'index' => ListOutgoings::route('/'),
            'create' => CreateOutgoing::route('/create'),
            'view' => ViewOutgoing::route('/{record}'),
            'edit' => EditOutgoing::route('/{record}/edit'),
        ];
    }
}
