Category represents a country or a competition. It is a unique entity within the API. It is the first level of the API hierarchy.
Category is saved in `categories` table.
Category can be active or inactive. `category.active` is boolean.
In case category is inactive, all related data should be hidden from public API, and there is not sync for that category.
Category has a relation to Sport. `category.sport_id` is a foreign key to `sports.id`.
Category has a relation to Tournaments. `category.tournaments` is a collection of related tournaments.

Example of category:
- Sport: Soccer
- Category: England ( Premier League, Championship, League One, League Two, FA Cup, EFL Cup, Community Shield, etc. )

Example of category:
- Sport: Soccer
- Category: Europe ( Champions League, Europa League, Euro, etc. )
