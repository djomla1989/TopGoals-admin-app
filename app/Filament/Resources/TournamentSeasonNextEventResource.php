<?php

namespace App\Filament\Resources;

use App\Enums\DateEnum;
use App\Filament\Resources\TournamentSeasonNextEventResource\Pages;
use App\Filament\Resources\TournamentSeasonNextEventResource\RelationManagers;
use App\Models\Category;
use App\Models\Tournament;
use App\Models\TournamentSeasonNextEvent;
use Carbon\Carbon;
use Carbon\Traits\Date;
use DeepCopy\TypeFilter\Date\DatePeriodFilter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TournamentSeasonNextEventResource extends Resource
{
    protected static ?string $model = TournamentSeasonNextEvent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Events';

    protected static ?string $label = 'Next Events';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customId')->label('Custom ID')->disabled(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('home_team_name')->label('Home Team'),
                Tables\Columns\TextColumn::make('away_team_name')->label('Away Team'),
                Tables\Columns\TextColumn::make('start_timestamp')
                    ->label('Start Timestamp')
                    ->searchable()
                    ->sortable()
                    ->dateTime(DateEnum::DATE_TIME_FORMAT->value),
                Tables\Columns\TextColumn::make('tournamentSeason.name')
                    ->label('Season')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('tournament.name')
                    ->label('Tournament')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('tournamentSeasonGroup.name')
                    ->label('Group')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('round')->label('Round')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')->label('Status')->searchable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('startAt')
                ->form([
                    Forms\Components\DateTimePicker::make('startFrom')
                        ->timezone(DateEnum::UTC_TIMEZONE->value)
                        ->seconds(false)
                        ->format(DateEnum::DATE_TIME_FORMAT->value),
                    Forms\Components\DateTimePicker::make('startTo')
                        ->seconds(false)
                        ->format(DateEnum::DATE_TIME_FORMAT->value),
                ])->query(function (Builder $query, array $data) {
                    return $query->when(
                        $data['startFrom'], function (Builder $query, $startFrom) {
                            return $query->where('start_timestamp', '>=', strtotime($startFrom));
                    })->when(
                        $data['startTo'],
                        function (Builder $query, $startTo) {
                            return $query->where('start_timestamp', '<=', strtotime($startTo));
                        });
                })->indicateUsing(function (array $data): array {
                    $indicators = [];

                    if ($data['startFrom'] ?? null) {
                        $startFrom = Carbon::make($data['startFrom']);
                        $indicators[] = Tables\Filters\Indicator::make('Start From: '.$startFrom->format(DateEnum::DATE_TIME_FORMAT->value))
                            ->removeField('startFrom');
                    }

                    if ($data['startTo'] ?? null) {
                        $startTo = Carbon::make($data['startTo']);
                        $indicators[] = Tables\Filters\Indicator::make('Start To: '.$startTo->format(DateEnum::DATE_TIME_FORMAT->value))
                            ->removeField('startTo');
                    }

                    return $indicators;
                })
                ,
                Tables\Filters\Filter::make('custom')
                    ->label('Custom')
                    ->form([
                        Forms\Components\Select::make('category')
                            ->options(fn () => Category::pluck('name', 'id')->toArray())
                            ->preload()
                            ->live()
                            ->reactive()
                            ->afterStateUpdated(function (Forms\Set $set) {
                                $set('tournament', null);
                            })
                            ->searchable(),
                        Forms\Components\Select::make('tournament')
                            ->options(function (Forms\Get $get) {

                                $category = $get('category');

                                if (! empty($category)) {
                                    return Tournament::query()->where('category_id', $category)->pluck('name', 'id')->toArray();
                                }

                                return Tournament::query()->pluck('name', 'id')->toArray();
                            })
                            ->label('Primary Tournament')
                            ->preload()
                            ->live()
                            ->reactive()
                            ->searchable(),
                    ])->query(function (Builder $query, array $data) {
                        return $query
                            ->when(
                                $data['category'], function (Builder $query, $category) {

                                return $query->where('category_id', $category);
                            }
                            )->when(
                                $data['tournament'], function (Builder $query, $tournament) {

                                return $query->where('tournament_id', $tournament);
                            });
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['category'] ?? null) {

                            $indicators[] = Tables\Filters\Indicator::make('Category: '.Category::find($data['category'])->name)
                                ->removeField('category');
                        }

                        if ($data['tournament'] ?? null) {
                            $indicators[] = Tables\Filters\Indicator::make('Primary tournament: '.Tournament::find($data['tournament'])->name)
                                ->removeField('tournament');
                        }

                        return $indicators;
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            TextEntry::make('customId')
                ->label('Custom ID'),
            TextEntry::make('import_id')
                ->label('Import ID'),
            TextEntry::make('slug'),
            TextEntry::make('home_team_name')
                ->label('Home Team'),
            TextEntry::make('away_team_name')
                ->label('Away Team'),
            TextEntry::make('start_timestamp')->dateTime(DateEnum::DATE_TIME_FORMAT->value),
        ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTournamentSeasonNextEvents::route('/'),
            'create' => Pages\CreateTournamentSeasonNextEvent::route('/create'),
            'view' => Pages\ViewTournamentSeasonNextEvent::route('/{record}'),
            'edit' => Pages\EditTournamentSeasonNextEvent::route('/{record}/edit'),
        ];
    }
}
