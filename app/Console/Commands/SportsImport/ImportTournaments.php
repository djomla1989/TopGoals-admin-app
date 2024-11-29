<?php

namespace App\Console\Commands\SportsImport;

use App\Models\Category;
use App\Models\Sport;
use App\Models\Tournament;
use Database\Factories\TournamentFactory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportTournaments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:tournaments {--overwrite} {--test}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all tournaments data from MongoDB collection';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $conn = DB::connection('mongodb');
        $tournamentList = $conn->table('uniqueTournaments')->get();

        $liveMode = true;
        if ($this->option('test')) {
            $this->error('Test mode. Skipping save.');
            $liveMode = false;
        }

        $sport = Sport::where('name', 'Football')->first();
        if (! $sport) {
            $this->error('Sport "Football" not found. Please import sports first.');

            return;
        }

        foreach ($tournamentList as $tournament) {
            $tournament = (object) $tournament;

            $this->info("Importing category: {$tournament->name} - {$tournament->id}");
            $existingTournament = Tournament::where('import_id', $tournament->id)->first();

            if ($existingTournament && ! $this->option('overwrite')) {
                $this->info("Tournament {$tournament->name} already exists. Use --overwrite to update.");

                continue;
            }

            if (empty($tournament->category['id'])) {
                $this->error("Category {$tournament->name} does not have a category_id. Skipping.");

                continue;
            }

            $category = Category::where('import_id', $tournament->category['id'])->first();

            if (! $category) {
                $this->error("Country {$tournament->name} does not have a category_id. Skipping.");

                continue;
            }

            $tournamentMeta = $conn->table('uniqueTournamentMeta')
                ->where('uniqueTournament.id', $tournament->id)->first();

            if (! $tournamentMeta) {
                $this->error('Tournament meta not found for: '.$tournament->name.' - '.$tournament->id);
            }

            $tournament->gender = $tournamentMeta['gender'] ?? '';

            $tournamentModel = TournamentFactory::buildFromTournament($tournament, $sport->id, $category->id, $existingTournament);

            if ($liveMode) {
                $tournamentModel->save();
                $this->info('Imported/Updated tournament: '.$tournament->name);
            }

        }

        $this->info('All tournaments imported/updated successfully.');
    }
}
