<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TournamentSeasonResource\Pages;
use App\Models\AllSports\TournamentSeasonAllSports;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TournamentSeasonResource extends Resource
{
    protected static ?string $model = TournamentSeasonAllSports::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Sport Setup';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tournament.name')->label('Tournament')->searchable(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('year')->searchable()->sortable(),
                Tables\Columns\ImageColumn::make('image')->label('')->width(40)->circular(),
                Tables\Columns\TextColumn::make('import_id')->searchable(),
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
            'index' => Pages\ListTournamentSeasons::route('/'),
            'create' => Pages\CreateTournamentSeason::route('/create'),
            'edit' => Pages\EditTournamentSeason::route('/{record}/edit'),
        ];
    }
}
