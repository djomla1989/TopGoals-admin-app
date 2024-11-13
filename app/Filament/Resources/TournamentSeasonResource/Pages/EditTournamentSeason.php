<?php

namespace App\Filament\Resources\TournamentSeasonResource\Pages;

use App\Filament\Resources\TournamentSeasonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTournamentSeason extends EditRecord
{
    protected static string $resource = TournamentSeasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
