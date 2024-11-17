<?php

namespace App\Filament\Resources\TournamentSeasonNextEventResource\Pages;

use App\Filament\Resources\TournamentSeasonNextEventResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTournamentSeasonNextEvent extends EditRecord
{
    protected static string $resource = TournamentSeasonNextEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
