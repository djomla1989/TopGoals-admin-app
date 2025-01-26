Tournament is stored in `tournaments` table.
Tournament can be active or inactive. `tournament.active` is boolean.
In case tournament is inactive, all related data should be hidden from public API, and there is not sync for that tournament.
Tournament has a relation to Category. `tournament.category_id` is a foreign key to `categories.id`.

Example of tournament:
- Category: England
- Tournament: Premier League

Example of tournament:
- Category: Europe
- Tournament: Champions League

Tournament can have multiple seasons. Season is stored in `seasons` table.
Tournament can have multiple teams. Team is stored in `teams` table.

Tournament can be national or international. `tournament.national` is boolean.

Tournament can have stages 'qualification', 'qualification_playoff', 'group_stage', 'knockout_stage', 'final_stage', 'final', 'friendly', 'other'. `tournament.type` is string.
* playoffs
* qualification
* stage_1_playoff
* regular season
* relegation_playoffs
* placement_matches
* division
* conference
* promotion_playoffs
* qualification_playoffs
* stage_1
* grand_finals
* none
* 1st_part_of_season_1st_leg
