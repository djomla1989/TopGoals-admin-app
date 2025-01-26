First to sync
======================================================================
- Sport
- Category
- Tournament
- Season


How to sync
======================================================================
- Sync all sports
- Sync all categories
- Sync all tournaments data
  - https://os-sports-perform.p.rapidapi.com/v1/unique-tournaments/data?unique_tournament_id=679
- Sync all seasons for active tournaments --> Only for tournaments where season is missing?
  - https://os-sports-perform.p.rapidapi.com/v1/unique-tournaments/seasons?unique_tournament_id=17
- Sync all active seasons data
  - https://os-sports-perform.p.rapidapi.com/v1/seasons/data?seasons_id=61627&unique_tournament_id=17
  - 
- Update tournament info -> daily
  - Add tournament extra fileds (maybe some other table for hasPerformanceGraphFeature/hasEventPlayerStatistics/displayInverseHomeAwayTeams)
  - Tournament meta https://footapi7.p.rapidapi.com/api/tournament/17/meta
- Update season summary/info/stages -> 10min check ( daily sync )
  - **Trigger Sync with observer when season is updated**
- Sync season stages (qualifications, league, playoffs, etc.) -> 10 min check ( daily sync )
- Sync season standings where standing is available -> 1 min check ( daily sync )
  - Standing can be in groups or leagues (https://os-sports-perform.p.rapidapi.com/v1/seasons/standings?standing_type=home&seasons_id=53654&unique_tournament_id=679)
  - rounds? https://os-sports-perform.p.rapidapi.com/v1/seasons/rounds?seasons_id=61627&unique_tournament_id=17
  - events? https://os-sports-perform.p.rapidapi.com/v1/seasons/events?page=0&seasons_id=37036&unique_tournament_id=17&course_events=last
  - standing? https://os-sports-perform.p.rapidapi.com/v1/seasons/standings?standing_type=total&seasons_id=61627&unique_tournament_id=17
  - team stats? https://os-sports-perform.p.rapidapi.com/v1/seasons/teams-statistics/result?unique_tournament_id=17&seasons_id=61627&seasons_statistics_type=overall
    - Save each stat, so at the end we can make better chart with upgrade/downgrade stats for each team
  - player stats? https://os-sports-perform.p.rapidapi.com/v1/seasons/players-statistics/result?unique_tournament_id=17&seasons_statistics_type=overall&seasons_id=61627
    - Save each stat, so at the end we can make better chart with upgrade/downgrade stats for each player

## Limitations
- Quota limits
  - There should be a table with quota limits for each API endpoint
- Active status
  - There should be a column with active status for each sport, category, tournament, season, team, player
  - When new entity is created over API, it should be created with Inactive status
  - After all data is synced, it should be activated, and we can continue with sync data for that new entity
