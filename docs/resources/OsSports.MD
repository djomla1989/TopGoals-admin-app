Tournament can have multiple different stages.

Example UEFA Europa League:
- https://os-sports-perform.p.rapidapi.com/v1/unique-tournaments/data?unique_tournament_id=679
This tournament in 2024 changes format, so it has different stages:
- List of seasons
  - https://os-sports-perform.p.rapidapi.com/v1/unique-tournaments/seasons?unique_tournament_id=679
- 2023
  - Here is list of CUP TREES ( like knockout stage ). From 1/8 to final.
  - https://os-sports-perform.p.rapidapi.com/v1/seasons/cup-trees?unique_tournament_id=679&seasons_id=53654
-


Match Should have
- round type ( cup/league)
- round name (playoff round of 16, quarterfinals, final)
- round number (1,2,3,4)
- round phase ( qualification, regular season, playoffs)
Example in `matches` season_id =38591 ( Uefa Europa League 2023/2024 )
- Example in `matches` season_id =43438 ( Uefa Europa League 2024/2025 )

- Matches should already be populated in the database. Even if match is not played yet, it should be in the database.
