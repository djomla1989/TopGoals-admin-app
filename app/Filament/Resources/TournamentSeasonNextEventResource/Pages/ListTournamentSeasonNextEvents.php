<?php

namespace App\Filament\Resources\TournamentSeasonNextEventResource\Pages;

use App\Filament\Resources\TournamentSeasonNextEventResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTournamentSeasonNextEvents extends ListRecords
{
    protected static string $resource = TournamentSeasonNextEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
