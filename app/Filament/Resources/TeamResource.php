<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamResource\Pages;
use App\Filament\Resources\TeamResource\RelationManagers;
use App\Models\Country;
use App\Models\Team;
use App\Models\Tournament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

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
                Tables\Columns\TextColumn::make('short_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('primaryTournament.name')
                    ->label('Primary Tournament')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country.name'),
                Tables\Columns\TextColumn::make('sport.name'),
                Tables\Columns\TextColumn::make('gender')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'F' => 'primary',
                        'MIX' => 'primary',
                        default => 'success',
                    }),
                Tables\Columns\TextColumn::make('is_national')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '1' => 'primary',
                        '0' => 'success',
                        default => 'success',
                    }),

            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_national')
                    ->label('Is National'),
                Tables\Filters\Filter::make('custom')
                    ->label('Custom')
                    ->form([
                        Forms\Components\Select::make('country')
                            ->options(fn () => Country::pluck('name', 'id')->toArray())
                            ->preload()
                            ->live()
                            ->reactive()
                            ->afterStateUpdated(function (Forms\Set $set) {
                                $set('tournament', null);
                            })
                            ->searchable(),
                        Forms\Components\Select::make('tournament')
                            ->options(function (Forms\Get $get) {

                                $country = $get('country');

                                if (!empty($country)) {
                                    return Tournament::query()->where('country_id', $country)->pluck('name', 'id')->toArray();
                                }
                                return Tournament::query()->pluck('name', 'id')->toArray();
                            })
                            ->label('Primary Tournament')
                            ->preload()
                            ->live()
                            ->reactive()
                            ->searchable()
                    ])->query(function (Builder $query, array $data) {
                        return $query
                            ->when(
                                $data['country'], function (Builder $query, $country) {

                                    return $query->where('country_id', $country);
                                }
                            )->when(
                                $data['tournament'], function (Builder $query, $tournament) {

                                return $query->where('primary_tournament_id', $tournament);
                            });
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['country'] ?? null) {

                            $indicators[] = Tables\Filters\Indicator::make('Country: '. Country::find($data['country'])->name)
                                ->removeField('country');
                        }

                        if ($data['tournament'] ?? null) {
                            $indicators[] = Tables\Filters\Indicator::make('Primary tournament: ' . Tournament::find($data['tournament'])->name)
                                ->removeField('tournament');
                        }

                        return $indicators;
                    })
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
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }
}
