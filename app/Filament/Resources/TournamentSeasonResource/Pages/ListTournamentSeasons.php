<?php

namespace App\Filament\Resources\TournamentSeasonResource\Pages;

use App\Filament\Resources\TournamentSeasonResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTournamentSeasons extends ListRecords
{
    protected static string $resource = TournamentSeasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
