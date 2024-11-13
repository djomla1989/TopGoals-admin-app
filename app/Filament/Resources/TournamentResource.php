<?php

namespace App\Filament\Resources;

use App\Enums\Gender;
use App\Enums\TournamentTypeEnum;
use App\Filament\Resources\TournamentResource\Pages;
use App\Filament\Resources\TournamentResource\RelationManagers;
use App\Models\Country;
use App\Models\Sport;
use App\Models\Tournament;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class TournamentResource extends Resource
{
    protected static ?string $model = Tournament::class;

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
                Tables\Columns\ImageColumn::make('image')->label('')->width(40)->circular(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('sport.name')->label('Sport')->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label('Gender')
                    ->width(30)
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'F' => 'primary',
                        'MIX' => 'primary',
                        default => 'success',
                    }),
                Tables\Columns\ImageColumn::make('country.image')->label('')->width(40)->circular(),
                Tables\Columns\TextColumn::make('country.name')->label('Country')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->width(30)
                    ->badge()
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('sport_id')
                    ->options(function () {
                        $list = Sport::query()->pluck('name', 'id');
                        $list = $list->mapWithKeys(function ($item, $key) {

                            $html = new HtmlString('<strong>'.$item.'</strong>');

                            return [$key => $item];
                        });
                        return $list;
                    })
//                    ->getOptionLabelUsing(function ($record) {
//                        dd($record);
//                        return new HtmlString("<img src='{$record->image}' alt='{$record->name}' class='sport-icon'>111 {$record->name}");
//                    })
//                    ->options(function () {
//                        $sports = Sport::all();
//
//                        $list = $sports->mapWithKeys(function ($sport) {
//                            $imageUrl = url('/storage/' . $sport->image); // Putanja do slike
//                            $html = new HtmlString("<img src='{$imageUrl}' alt='{$sport->name}' class='sport-icon'>111 {$sport->name}");
//                            return [$sport->id => $html];
//                        });
//                        return $sports;
//                        //dd($list);
//                    })
                    ->searchable()
                    ->label('Sport'),
                Tables\Filters\SelectFilter::make('country_id')
                    ->options(fn() => Country::query()->pluck('name', 'id'))

                    ->searchable()
                    ->multiple()
                    ->label('Country'),
                Tables\Filters\SelectFilter::make('gender')
                    ->options(fn() => collect(Gender::cases())->mapWithKeys(fn($gender) => [$gender->value => $gender->label()]))
                    ->searchable()
                    ->multiple()
                    ->label('Gender'),
                Tables\Filters\SelectFilter::make('type')
                    ->options(fn() => collect(TournamentTypeEnum::cases())->mapWithKeys(fn($gender) => [$gender->value => $gender->label()]))
                    ->searchable()
                    ->multiple()
                    ->label('League Type'),
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
            RelationManagers\SeasonsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTournaments::route('/'),
            'create' => Pages\CreateTournament::route('/create'),
            'edit' => Pages\EditTournament::route('/{record}/edit'),
        ];
    }
}
