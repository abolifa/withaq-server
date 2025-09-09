<?php

namespace App\Filament\Resources\Templates;

use App\Filament\Resources\Templates\Pages\CreateTemplate;
use App\Filament\Resources\Templates\Pages\EditTemplate;
use App\Filament\Resources\Templates\Pages\ListTemplates;
use App\Filament\Resources\Templates\Pages\ViewTemplate;
use App\Filament\Resources\Templates\Schemas\TemplateForm;
use App\Filament\Resources\Templates\Schemas\TemplateInfolist;
use App\Filament\Resources\Templates\Tables\TemplatesTable;
use App\Models\Template;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class TemplateResource extends Resource
{
    protected static ?string $model = Template::class;

    protected static string|BackedEnum|null $navigationIcon = 'emoji-building-construction';

    protected static ?string $label = 'قالب';
    protected static ?string $pluralLabel = 'القوالب';

    protected static ?int $navigationSort = 7;


    public static function form(Schema $schema): Schema
    {
        return TemplateForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TemplateInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TemplatesTable::configure($table);
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
            'index' => ListTemplates::route('/'),
            'create' => CreateTemplate::route('/create'),
            'view' => ViewTemplate::route('/{record}'),
            'edit' => EditTemplate::route('/{record}/edit'),
        ];
    }
}
