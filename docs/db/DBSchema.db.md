Initial Core Database Schema for Soccer/Football API Data - 4.1.2024
======================================================================
- sports
  - id
  - source_id
  - name
  - slug
  - active
- categories
  - id
  - source_id
  - sport_id
  - name
  - slug
  - active
- tournaments
  - id
  - source_id
  - category_id
  - name
  - name_translation
  - slug
  - gender
  - tier ( 1, 2, 3 etc. )
  - national
  - age_group ( U20, U21, U23, Senior,  etc. )
  - active
- seasons
  - id
  - source_id
  - tournament_id
  - name
  - name_translation
  - slug
  - active
  - start_date
  - end_date
  - current
  - status
  - updated_at --> last sync date, this is used to check if we need to sync data again
- teams
  - id
  - source_id
  - category_id
  - sport_id
  - name
  - short_name
  - code
  - slug
  - active
  - national
  - age_group ( U20, U21, U23, Senior,  etc. )
- players
- team_players


```sql
ALTER TABLE teams_allsports DROP CONSTRAINT teams_sport_id_foreign;

ALTER TABLE teams_allsports
add CONSTRAINT `teams_allsports_sport_id_foreign` FOREIGN KEY (`sport_id`) REFERENCES `sports_allsports` (`id`);
```
