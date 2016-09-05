# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.31-0ubuntu0.14.04.2)
# Database: footballpool
# Generation Time: 2016-09-05 17:18:52 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table v$_games
# ------------------------------------------------------------

DROP VIEW IF EXISTS `v$_games`;

CREATE TABLE `v$_games` (
   `id` INT(10) UNSIGNED NOT NULL DEFAULT '0',
   `week_id` INT(11) NOT NULL,
   `day_of_week` VARCHAR(10) NOT NULL,
   `game_datetime` DATETIME NOT NULL,
   `visitor_city` VARCHAR(20) NOT NULL,
   `visitor_team` VARCHAR(20) NOT NULL,
   `home_city` VARCHAR(20) NOT NULL,
   `home_team` VARCHAR(20) NOT NULL
) ENGINE=MyISAM;





# Replace placeholder table for v$_games with correct view syntax
# ------------------------------------------------------------

DROP TABLE `v$_games`;

CREATE ALGORITHM=UNDEFINED DEFINER=`homestead`@`%` SQL SECURITY DEFINER VIEW `v$_games`
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

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
