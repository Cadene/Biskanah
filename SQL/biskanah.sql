-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2014 at 05:42 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `biskanah`
--

-- --------------------------------------------------------

--
-- Table structure for table `a2bs`
--

CREATE TABLE `a2bs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` mediumint(8) unsigned NOT NULL,
  `to` mediumint(8) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `begin` int(10) unsigned NOT NULL,
  `finish` int(10) unsigned NOT NULL,
  `res1` float(9,4) unsigned NOT NULL,
  `res2` float(9,4) unsigned NOT NULL,
  `res3` float(9,4) unsigned NOT NULL,
  `accepted` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `finish` (`finish`),
  KEY `fk_A2B_WORLD_from` (`from`),
  KEY `fk_A2B_WORLD_to` (`to`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `a2bs_units`
--

CREATE TABLE `a2bs_units` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `a2b_id` int(10) unsigned NOT NULL,
  `unit_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_A2B_has_objType_A2B1_idx` (`a2b_id`),
  KEY `fk_a2bs_units_units1_idx` (`unit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `acos`
--

CREATE TABLE `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `aros`
--

CREATE TABLE `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `aros_acos`
--

CREATE TABLE `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `assists`
--

CREATE TABLE `assists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` mediumint(8) unsigned NOT NULL,
  `on` mediumint(8) unsigned NOT NULL,
  `res3` float(9,4) unsigned NOT NULL,
  `accepted` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_assists_camps_FROM_idx` (`from`),
  KEY `fk_assists_camps_ON_idx` (`on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `assists_units`
--

CREATE TABLE `assists_units` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `assist_id` int(10) unsigned NOT NULL,
  `unit_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_assists_units_assists1_idx` (`assist_id`),
  KEY `fk_assists_units_units1_idx` (`unit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `camp_id` mediumint(8) unsigned NOT NULL,
  `field` tinyint(4) NOT NULL,
  `databuilding_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_FIELDS_camps1_idx` (`camp_id`),
  KEY `fk_buildings_databuildings1_idx` (`databuilding_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `camps`
--

CREATE TABLE `camps` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `world_id` mediumint(8) unsigned NOT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  `name` varchar(45) NOT NULL COMMENT 'Si NULL , alors nom par défaut',
  `pts` mediumint(8) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `loyalty` float(3,2) unsigned NOT NULL,
  `last_update` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `unread_reports` smallint(5) unsigned NOT NULL,
  `prod1` mediumint(8) unsigned NOT NULL,
  `prod2` mediumint(8) unsigned NOT NULL,
  `prod3` mediumint(8) unsigned NOT NULL,
  `res1` float(9,4) unsigned NOT NULL,
  `res2` float(9,4) unsigned NOT NULL,
  `res3` float(9,4) unsigned NOT NULL,
  `maxres1` mediumint(8) unsigned NOT NULL,
  `maxres2` mediumint(8) unsigned NOT NULL,
  `maxres3` mediumint(8) unsigned NOT NULL,
  `bunker` mediumint(8) unsigned NOT NULL,
  `energyshield` mediumint(8) unsigned NOT NULL,
  `structshield` mediumint(8) unsigned NOT NULL,
  `radar` mediumint(8) unsigned NOT NULL,
  `a2b_id` int(10) unsigned DEFAULT NULL COMMENT 'Pire attaque reçu en cours. A traiter par le serveur.',
  PRIMARY KEY (`id`),
  KEY `fk_camps_worlds_id` (`world_id`),
  KEY `fk_camps_users_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `camps_units`
--

CREATE TABLE `camps_units` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `camp_id` mediumint(8) unsigned NOT NULL,
  `unit_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_camps_units_camps_id` (`camp_id`),
  KEY `fk_camps_units_units_id` (`unit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `databuildings`
--

CREATE TABLE `databuildings` (
  `id` smallint(5) unsigned NOT NULL,
  `lvl` tinyint(3) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `res1` mediumint(8) unsigned NOT NULL,
  `res2` mediumint(8) unsigned NOT NULL,
  `res3` mediumint(8) unsigned NOT NULL,
  `prod1` smallint(5) unsigned DEFAULT NULL,
  `prod2` smallint(5) unsigned DEFAULT NULL,
  `prod3` smallint(5) unsigned DEFAULT NULL,
  `maxres1` smallint(5) unsigned DEFAULT NULL,
  `maxres2` smallint(5) unsigned DEFAULT NULL,
  `maxres3` smallint(5) unsigned DEFAULT NULL,
  `bunker` smallint(5) unsigned DEFAULT NULL,
  `energyshield` smallint(5) unsigned DEFAULT NULL,
  `structshield` smallint(5) unsigned DEFAULT NULL,
  `struct` mediumint(8) unsigned NOT NULL,
  `conso` smallint(5) unsigned NOT NULL,
  `time` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_databuildings_typebuildings_id` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `datanodes`
--

CREATE TABLE `datanodes` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `from_data` smallint(5) unsigned NOT NULL,
  `from_kind` tinyint(3) unsigned NOT NULL,
  `to_data` smallint(5) unsigned NOT NULL,
  `to_kind` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `from` (`from_data`,`from_kind`),
  KEY `data` (`to_data`,`to_kind`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `datatechnos`
--

CREATE TABLE `datatechnos` (
  `id` smallint(5) unsigned NOT NULL,
  `lvl` tinyint(3) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `kind` tinyint(3) unsigned NOT NULL,
  `res1` smallint(5) unsigned NOT NULL,
  `res2` smallint(5) unsigned NOT NULL,
  `res3` smallint(5) unsigned NOT NULL,
  `time` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_datatechnos_typetechnos_id` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dataunits`
--

CREATE TABLE `dataunits` (
  `id` tinyint(3) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `kind` tinyint(3) unsigned NOT NULL,
  `res1` smallint(5) unsigned NOT NULL,
  `res2` smallint(5) unsigned NOT NULL,
  `res3` smallint(5) unsigned NOT NULL,
  `att1` smallint(5) unsigned NOT NULL,
  `att2` smallint(5) unsigned NOT NULL,
  `att3` smallint(5) unsigned NOT NULL,
  `attbat` smallint(5) unsigned NOT NULL,
  `speed` float(5,2) unsigned NOT NULL,
  `conso` tinyint(3) unsigned NOT NULL,
  `capacity` smallint(5) unsigned NOT NULL,
  `spy` tinyint(3) unsigned NOT NULL,
  `time` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_dataunits_typeunits_id` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dtbuildings`
--

CREATE TABLE `dtbuildings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `building_id` int(10) unsigned NOT NULL,
  `finish` int(10) unsigned NOT NULL,
  `begin` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_DT_FIELDS1_idx` (`building_id`),
  KEY `finish` (`finish`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dttechnos`
--

CREATE TABLE `dttechnos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `techno_id` int(10) unsigned NOT NULL,
  `building_id` int(10) unsigned NOT NULL,
  `finish` int(10) unsigned NOT NULL,
  `begin` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_DT_RESEARCHS1_idx` (`techno_id`),
  KEY `fk_DT_buildings1_idx` (`building_id`),
  KEY `finish` (`finish`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dtunits`
--

CREATE TABLE `dtunits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unit_id` int(10) unsigned NOT NULL,
  `building_id` int(10) unsigned NOT NULL,
  `begin` int(11) NOT NULL,
  `finish` int(11) NOT NULL,
  `num` mediumint(9) NOT NULL,
  `num_ready` mediumint(9) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_dtunits_units1_idx` (`unit_id`),
  KEY `fk_dtunits_buildings1_idx` (`building_id`),
  KEY `finish` (`finish`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invits`
--

CREATE TABLE `invits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` smallint(5) unsigned NOT NULL,
  `team_id` smallint(5) unsigned NOT NULL,
  `from_user` smallint(5) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `read` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invits_users1_idx` (`user_id`),
  KEY `fk_invits_teams1_idx` (`team_id`),
  KEY `fk_invits_users2_idx` (`from_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `content` text NOT NULL,
  `sent` datetime NOT NULL,
  `read` datetime DEFAULT NULL,
  `to` smallint(5) unsigned NOT NULL,
  `from` smallint(5) unsigned NOT NULL,
  `archive` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_messages_users2_idx` (`to`),
  KEY `fk_messages_users1_idx` (`from`),
  KEY `sent` (`sent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rankteams`
--

CREATE TABLE `rankteams` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` smallint(5) unsigned NOT NULL,
  `kill` bigint(19) unsigned NOT NULL,
  `steal` bigint(19) unsigned NOT NULL,
  `evo` bigint(19) unsigned NOT NULL,
  `lost` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rankteams_teams1_idx` (`team_id`),
  KEY `kill` (`kill`),
  KEY `steal` (`steal`),
  KEY `evo` (`evo`),
  KEY `lost` (`lost`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rankusers`
--

CREATE TABLE `rankusers` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` smallint(5) unsigned NOT NULL,
  `kill` int(10) unsigned NOT NULL,
  `steal` int(10) unsigned NOT NULL,
  `evo` int(10) unsigned NOT NULL,
  `lost` int(10) unsigned NOT NULL COMMENT 'kill :: unités tuées en ressources\nsteal :: ressources pillées\nevo :: points gagnés\nlost :: points perdus',
  PRIMARY KEY (`id`),
  KEY `fk_rankusers_users1_idx` (`user_id`),
  KEY `kill` (`kill`),
  KEY `steal` (`steal`),
  KEY `evo` (`evo`),
  KEY `lost` (`lost`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `camp_id` mediumint(8) unsigned NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  `read` datetime DEFAULT NULL,
  `pts_att` int(10) unsigned NOT NULL,
  `pts_def` int(10) unsigned NOT NULL,
  `archive` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reports_camps1_idx` (`camp_id`),
  KEY `created` (`created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sends`
--

CREATE TABLE `sends` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` mediumint(8) unsigned NOT NULL,
  `to` mediumint(8) unsigned NOT NULL,
  `pc_res1` tinyint(3) unsigned NOT NULL,
  `pc_res2` tinyint(3) unsigned NOT NULL,
  `pc_res3` tinyint(3) unsigned NOT NULL,
  `activate` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sends_camps1_idx` (`from`),
  KEY `fk_sends_camps2_idx` (`to`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `tag` varchar(10) NOT NULL,
  `desc` text,
  `created` datetime NOT NULL,
  `rank_pts` bigint(19) unsigned NOT NULL,
  `rank_units` bigint(19) unsigned NOT NULL,
  `rank_biskanah` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `tag_UNIQUE` (`tag`),
  KEY `rank_pts` (`rank_pts`),
  KEY `rank_units` (`rank_units`),
  KEY `rank_biskanah` (`rank_biskanah`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `technos`
--

CREATE TABLE `technos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` smallint(5) unsigned NOT NULL,
  `datatechno_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_RESEARCHS_users1_idx` (`user_id`),
  KEY `fk_technos_datatechnos1_idx` (`datatechno_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `typebuildings`
--

CREATE TABLE `typebuildings` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `desc` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `typetechnos`
--

CREATE TABLE `typetechnos` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `desc` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `typeunits`
--

CREATE TABLE `typeunits` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `desc` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `num` mediumint(8) unsigned NOT NULL,
  `dataunit_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_units_dataunits1_idx` (`dataunit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `access` tinyint(3) unsigned NOT NULL,
  `desc` text NOT NULL,
  `diam` smallint(5) unsigned NOT NULL,
  `plus` tinyint(3) unsigned NOT NULL,
  `token` varchar(23) NOT NULL,
  `last_update` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `team_id` smallint(5) unsigned DEFAULT NULL,
  `team_access` tinyint(3) unsigned DEFAULT NULL,
  `biskanah` mediumint(8) unsigned NOT NULL,
  `rank_pts` int(10) unsigned NOT NULL,
  `rank_units` int(10) unsigned NOT NULL,
  `unread_msg` smallint(5) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_users_teams1_idx` (`team_id`),
  KEY `rank_pts` (`rank_pts`),
  KEY `rank_units` (`rank_units`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;




-- --------------------------------------------------------

--
-- Table structure for table `worlds`
--

CREATE TABLE `worlds` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `x` smallint(6) NOT NULL,
  `y` smallint(6) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `occupied` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coord` (`x`,`y`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



--
-- Constraints for table `a2bs`
--
ALTER TABLE `a2bs`
  ADD CONSTRAINT `fk_A2B_WORLD1` FOREIGN KEY (`to`) REFERENCES `worlds` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_A2B_WORLD2` FOREIGN KEY (`from`) REFERENCES `worlds` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `a2bs_units`
--
ALTER TABLE `a2bs_units`
  ADD CONSTRAINT `fk_a2bs_units_units1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_A2B_has_objType_A2B1` FOREIGN KEY (`a2b_id`) REFERENCES `a2bs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `assists`
--
ALTER TABLE `assists`
  ADD CONSTRAINT `fk_assists_camps_FROM` FOREIGN KEY (`from`) REFERENCES `worlds` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_assists_camps_ON` FOREIGN KEY (`on`) REFERENCES `worlds` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `assists_units`
--
ALTER TABLE `assists_units`
  ADD CONSTRAINT `fk_assists_units_assists1` FOREIGN KEY (`assist_id`) REFERENCES `assists` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_assists_units_units1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `buildings`
--
ALTER TABLE `buildings`
  ADD CONSTRAINT `fk_buildings_databuildings1` FOREIGN KEY (`databuilding_id`) REFERENCES `databuildings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_FIELDS_camps1` FOREIGN KEY (`camp_id`) REFERENCES `camps` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `camps`
--
ALTER TABLE `camps`
  ADD CONSTRAINT `fk_camps_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_camps_WORLD` FOREIGN KEY (`world_id`) REFERENCES `worlds` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `camps_units`
--
ALTER TABLE `camps_units`
  ADD CONSTRAINT `fk_camps_units_camps1` FOREIGN KEY (`camp_id`) REFERENCES `camps` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_camps_units_units1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `databuildings`
--
ALTER TABLE `databuildings`
  ADD CONSTRAINT `fk_databuildings_typebuildings` FOREIGN KEY (`type`) REFERENCES `typebuildings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `datatechnos`
--
ALTER TABLE `datatechnos`
  ADD CONSTRAINT `fk_datatechnos_typetechnos` FOREIGN KEY (`type`) REFERENCES `typetechnos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dataunits`
--
ALTER TABLE `dataunits`
  ADD CONSTRAINT `fk_dataunits_typeunits` FOREIGN KEY (`type`) REFERENCES `typeunits` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dtbuildings`
--
ALTER TABLE `dtbuildings`
  ADD CONSTRAINT `fk_DT_FIELDS1` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dttechnos`
--
ALTER TABLE `dttechnos`
  ADD CONSTRAINT `fk_DT_buildings1` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DT_RESEARCHS1` FOREIGN KEY (`techno_id`) REFERENCES `technos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dtunits`
--
ALTER TABLE `dtunits`
  ADD CONSTRAINT `fk_dtunits_buildings1` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dtunits_units1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invits`
--
ALTER TABLE `invits`
  ADD CONSTRAINT `fk_invits_teams1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_invits_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_invits_users2` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_messages_users1` FOREIGN KEY (`from`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_messages_users2` FOREIGN KEY (`to`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rankteams`
--
ALTER TABLE `rankteams`
  ADD CONSTRAINT `fk_rankteams_teams1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rankusers`
--
ALTER TABLE `rankusers`
  ADD CONSTRAINT `fk_rankusers_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `fk_reports_camps1` FOREIGN KEY (`camp_id`) REFERENCES `camps` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sends`
--
ALTER TABLE `sends`
  ADD CONSTRAINT `fk_sends_camps1` FOREIGN KEY (`from`) REFERENCES `camps` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sends_camps2` FOREIGN KEY (`to`) REFERENCES `camps` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `technos`
--
ALTER TABLE `technos`
  ADD CONSTRAINT `fk_RESEARCHS_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_technos_datatechnos1` FOREIGN KEY (`datatechno_id`) REFERENCES `datatechnos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `units`
--
ALTER TABLE `units`
  ADD CONSTRAINT `fk_units_dataunits1` FOREIGN KEY (`dataunit_id`) REFERENCES `dataunits` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_teams1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
/*ADD CONSTRAINT `fk_users_groups` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;*/

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
