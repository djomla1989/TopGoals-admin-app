<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SportResource\Pages;
use App\Models\AllSports\SportAllSports;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SportResource extends Resource
{
    protected static ?string $model = SportAllSports::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Sport Setup';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image'),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('')->width(40)->circular(),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('import_id'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListSports::route('/'),
            'create' => Pages\CreateSport::route('/create'),
            'edit' => Pages\EditSport::route('/{record}/edit'),
        ];
    }
}
