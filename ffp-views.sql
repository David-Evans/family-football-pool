CREATE VIEW `v$_games`
AS SELECT
   `games`.`id` AS `id`,
   `games`.`week_id` AS `week_id`,
   `games`.`day_of_week` AS `day_of_week`,
   `games`.`game_datetime` AS `game_datetime`,
   `v`.`team_city` AS `visitor_city`,
   `games`.`visitor_team` AS `visitor_team`,
   `h`.`team_city` AS `home_city`,
   `games`.`home_team` AS `home_team`
FROM ((`games` join `teams` `h` on((`games`.`home_team` = `h`.`team_name`))) join `teams` `v` on((`games`.`visitor_team` = `v`.`team_name`)));