SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `biskanah` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `biskanah` ;

-- -----------------------------------------------------
-- Table `biskanah`.`worlds`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`worlds` (
  `id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `x` SMALLINT(6) NOT NULL ,
  `y` SMALLINT(6) NOT NULL ,
  `type` TINYINT(3) UNSIGNED NOT NULL ,
  `occupied` TINYINT(3) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `coord` (`x` ASC, `y` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`a2bs`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`a2bs` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `from` MEDIUMINT(8) UNSIGNED NOT NULL ,
  `to` MEDIUMINT(8) UNSIGNED NOT NULL ,
  `type` TINYINT(3) UNSIGNED NOT NULL ,
  `begin` INT(10) UNSIGNED NOT NULL ,
  `finish` INT(10) UNSIGNED NOT NULL ,
  `res1` FLOAT(9,4) UNSIGNED NOT NULL ,
  `res2` FLOAT(9,4) UNSIGNED NOT NULL ,
  `res3` FLOAT(9,4) UNSIGNED NOT NULL ,
  `accepted` TINYINT(3) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `finish` (`finish` ASC) ,
  INDEX `fk_A2B_WORLD_from` (`from` ASC) ,
  INDEX `fk_A2B_WORLD_to` (`to` ASC) ,
  CONSTRAINT `fk_A2B_WORLD1`
    FOREIGN KEY (`to` )
    REFERENCES `biskanah`.`worlds` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_A2B_WORLD2`
    FOREIGN KEY (`from` )
    REFERENCES `biskanah`.`worlds` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`dataunits`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`dataunits` (
  `id` TINYINT(3) UNSIGNED NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `desc` TEXT NOT NULL ,
  `kind` TINYINT(3) UNSIGNED NOT NULL ,
  `res1` SMALLINT(5) UNSIGNED NOT NULL ,
  `res2` SMALLINT(5) UNSIGNED NOT NULL ,
  `res3` SMALLINT(5) UNSIGNED NOT NULL ,
  `att1` SMALLINT(5) UNSIGNED NOT NULL ,
  `att2` SMALLINT(5) UNSIGNED NOT NULL ,
  `att3` SMALLINT(5) UNSIGNED NOT NULL ,
  `attbat` SMALLINT(5) UNSIGNED NOT NULL ,
  `spy` TINYINT(3) UNSIGNED NOT NULL ,
  `speed` TINYINT(3) UNSIGNED NOT NULL ,
  `conso` TINYINT(3) UNSIGNED NOT NULL ,
  `capacity` SMALLINT(5) UNSIGNED NOT NULL ,
  `armor` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`units`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`units` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `num` MEDIUMINT(8) UNSIGNED NOT NULL ,
  `dataunit_id` TINYINT(3) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_units_dataunits1_idx` (`dataunit_id` ASC) ,
  CONSTRAINT `fk_units_dataunits1`
    FOREIGN KEY (`dataunit_id` )
    REFERENCES `biskanah`.`dataunits` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`a2bs_units`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`a2bs_units` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `a2b_id` INT(10) UNSIGNED NOT NULL ,
  `unit_id` INT(10) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_A2B_has_objType_A2B1_idx` (`a2b_id` ASC) ,
  INDEX `fk_a2bs_units_units1_idx` (`unit_id` ASC) ,
  CONSTRAINT `fk_a2bs_units_units1`
    FOREIGN KEY (`unit_id` )
    REFERENCES `biskanah`.`units` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_A2B_has_objType_A2B1`
    FOREIGN KEY (`a2b_id` )
    REFERENCES `biskanah`.`a2bs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`acos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`acos` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `parent_id` INT(10) NULL DEFAULT NULL ,
  `model` VARCHAR(255) NULL DEFAULT NULL ,
  `foreign_key` INT(10) NULL DEFAULT NULL ,
  `alias` VARCHAR(255) NULL DEFAULT NULL ,
  `lft` INT(10) NULL DEFAULT NULL ,
  `rght` INT(10) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`aros`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`aros` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `parent_id` INT(10) NULL DEFAULT NULL ,
  `model` VARCHAR(255) NULL DEFAULT NULL ,
  `foreign_key` INT(10) NULL DEFAULT NULL ,
  `alias` VARCHAR(255) NULL DEFAULT NULL ,
  `lft` INT(10) NULL DEFAULT NULL ,
  `rght` INT(10) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`aros_acos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`aros_acos` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `aro_id` INT(10) NOT NULL ,
  `aco_id` INT(10) NOT NULL ,
  `_create` VARCHAR(2) NOT NULL DEFAULT '0' ,
  `_read` VARCHAR(2) NOT NULL DEFAULT '0' ,
  `_update` VARCHAR(2) NOT NULL DEFAULT '0' ,
  `_delete` VARCHAR(2) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `ARO_ACO_KEY` (`aro_id` ASC, `aco_id` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`assists`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`assists` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `from` MEDIUMINT(8) UNSIGNED NOT NULL ,
  `on` MEDIUMINT(8) UNSIGNED NOT NULL ,
  `res3` FLOAT(9,4) UNSIGNED NOT NULL ,
  `accepted` TINYINT(3) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_assists_camps_FROM_idx` (`from` ASC) ,
  INDEX `fk_assists_camps_ON_idx` (`on` ASC) ,
  CONSTRAINT `fk_assists_camps_FROM`
    FOREIGN KEY (`from` )
    REFERENCES `biskanah`.`worlds` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_assists_camps_ON`
    FOREIGN KEY (`on` )
    REFERENCES `biskanah`.`worlds` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`assists_units`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`assists_units` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `assist_id` INT(10) UNSIGNED NOT NULL ,
  `unit_id` INT(10) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_assists_units_assists1_idx` (`assist_id` ASC) ,
  INDEX `fk_assists_units_units1_idx` (`unit_id` ASC) ,
  CONSTRAINT `fk_assists_units_assists1`
    FOREIGN KEY (`assist_id` )
    REFERENCES `biskanah`.`assists` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_assists_units_units1`
    FOREIGN KEY (`unit_id` )
    REFERENCES `biskanah`.`units` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`databuildings`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`databuildings` (
  `id` TINYINT(3) UNSIGNED NOT NULL COMMENT 'id => type of the building\n' ,
  `name` VARCHAR(45) NOT NULL ,
  `desc` TEXT NOT NULL ,
  `res1` MEDIUMINT(8) UNSIGNED NOT NULL ,
  `res2` MEDIUMINT(8) UNSIGNED NOT NULL ,
  `res3` MEDIUMINT(8) UNSIGNED NOT NULL ,
  `struct` MEDIUMINT(8) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`teams`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`teams` (
  `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `tag` VARCHAR(10) NOT NULL ,
  `desc` TEXT NULL DEFAULT NULL ,
  `created` DATETIME NOT NULL ,
  `rank_pts` BIGINT(19) UNSIGNED NOT NULL ,
  `rank_units` BIGINT(19) UNSIGNED NOT NULL ,
  `rank_biskanah` INT(10) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  UNIQUE INDEX `tag_UNIQUE` (`tag` ASC) ,
  INDEX `rank_pts` (`rank_pts` ASC) ,
  INDEX `rank_units` (`rank_units` ASC) ,
  INDEX `rank_biskanah` (`rank_biskanah` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`users` (
  `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `access` TINYINT(3) UNSIGNED NOT NULL ,
  `desc` TEXT NOT NULL ,
  `diam` SMALLINT(5) UNSIGNED NOT NULL ,
  `plus` TINYINT(3) UNSIGNED NOT NULL ,
  `token` VARCHAR(23) NOT NULL ,
  `last_update` INT(10) UNSIGNED NOT NULL ,
  `created` DATETIME NOT NULL ,
  `team_id` SMALLINT(5) UNSIGNED NULL DEFAULT NULL ,
  `team_access` TINYINT(3) UNSIGNED NULL DEFAULT NULL ,
  `biskanah` MEDIUMINT(8) UNSIGNED NOT NULL ,
  `rank_pts` INT(10) UNSIGNED NOT NULL ,
  `rank_units` INT(10) UNSIGNED NOT NULL ,
  `unread_msg` SMALLINT(5) UNSIGNED NOT NULL ,
  `group_id` INT(10) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  INDEX `fk_users_teams1_idx` (`team_id` ASC) ,
  INDEX `rank_pts` (`rank_pts` ASC) ,
  INDEX `rank_units` (`rank_units` ASC) ,
  INDEX `group_id` (`group_id` ASC) ,
  CONSTRAINT `fk_users_teams1`
    FOREIGN KEY (`team_id` )
    REFERENCES `biskanah`.`teams` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`camps`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`camps` (
  `id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `world_id` MEDIUMINT(8) UNSIGNED NOT NULL ,
  `user_id` SMALLINT(5) UNSIGNED NOT NULL ,
  `name` VARCHAR(45) NOT NULL COMMENT 'Si NULL , alors nom par défaut' ,
  `pts` MEDIUMINT(8) UNSIGNED NOT NULL ,
  `type` TINYINT(3) UNSIGNED NOT NULL ,
  `loyalty` FLOAT(3,2) UNSIGNED NOT NULL ,
  `last_update` INT(11) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `unread_reports` SMALLINT(5) UNSIGNED NOT NULL ,
  `prod1` MEDIUMINT(8) UNSIGNED NOT NULL ,
  `prod2` MEDIUMINT(8) UNSIGNED NOT NULL ,
  `prod3` MEDIUMINT(8) UNSIGNED NOT NULL ,
  `res1` FLOAT(9,4) UNSIGNED NOT NULL ,
  `res2` FLOAT(9,4) UNSIGNED NOT NULL ,
  `res3` FLOAT(9,4) UNSIGNED NOT NULL ,
  `a2b_id` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'Pire attaque reçu en cours. A traiter par le serveur.' ,
  `cases` TINYINT UNSIGNED NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_camps_worlds_id` (`world_id` ASC) ,
  INDEX `fk_camps_users_id` (`user_id` ASC) ,
  CONSTRAINT `fk_camps_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `biskanah`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_camps_WORLD`
    FOREIGN KEY (`world_id` )
    REFERENCES `biskanah`.`worlds` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`buildings`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`buildings` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `camp_id` MEDIUMINT(8) UNSIGNED NOT NULL ,
  `databuilding_id` TINYINT(3) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_FIELDS_camps1_idx` (`camp_id` ASC) ,
  INDEX `fk_buildings_databuildings1_idx` (`databuilding_id` ASC) ,
  CONSTRAINT `fk_buildings_databuildings1`
    FOREIGN KEY (`databuilding_id` )
    REFERENCES `biskanah`.`databuildings` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_FIELDS_camps1`
    FOREIGN KEY (`camp_id` )
    REFERENCES `biskanah`.`camps` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`camps_units`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`camps_units` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `camp_id` MEDIUMINT(8) UNSIGNED NOT NULL ,
  `unit_id` INT(10) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_camps_units_camps_id` (`camp_id` ASC) ,
  INDEX `fk_camps_units_units_id` (`unit_id` ASC) ,
  CONSTRAINT `fk_camps_units_camps1`
    FOREIGN KEY (`camp_id` )
    REFERENCES `biskanah`.`camps` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_camps_units_units1`
    FOREIGN KEY (`unit_id` )
    REFERENCES `biskanah`.`units` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`datanodes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`datanodes` (
  `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `from_kind` TINYINT UNSIGNED NOT NULL ,
  `from_type` SMALLINT(5) UNSIGNED NOT NULL ,
  `to_kind` TINYINT UNSIGNED NOT NULL ,
  `to_type` SMALLINT(5) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `from` (`from_kind` ASC, `from_type` ASC) ,
  INDEX `to` (`to_kind` ASC, `to_type` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`datatechnos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`datatechnos` (
  `id` TINYINT(3) UNSIGNED NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `desc` TEXT NOT NULL ,
  `type` TINYINT(3) UNSIGNED NOT NULL ,
  `kind` TINYINT(3) UNSIGNED NOT NULL ,
  `res1` SMALLINT(5) UNSIGNED NOT NULL ,
  `res2` SMALLINT(5) UNSIGNED NOT NULL ,
  `res3` SMALLINT(5) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`dtbuildings`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`dtbuildings` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `building_id` INT(10) UNSIGNED NOT NULL ,
  `finish` INT(10) UNSIGNED NOT NULL ,
  `begin` INT(10) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_DT_FIELDS1_idx` (`building_id` ASC) ,
  INDEX `finish` (`finish` ASC) ,
  CONSTRAINT `fk_DT_FIELDS1`
    FOREIGN KEY (`building_id` )
    REFERENCES `biskanah`.`buildings` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`technos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`technos` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` SMALLINT(5) UNSIGNED NOT NULL ,
  `datatechno_id` TINYINT(3) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_RESEARCHS_users1_idx` (`user_id` ASC) ,
  INDEX `fk_technos_datatechnos1_idx` (`datatechno_id` ASC) ,
  CONSTRAINT `fk_RESEARCHS_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `biskanah`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_technos_datatechnos1`
    FOREIGN KEY (`datatechno_id` )
    REFERENCES `biskanah`.`datatechnos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`dttechnos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`dttechnos` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `techno_id` INT(10) UNSIGNED NOT NULL ,
  `building_id` INT(10) UNSIGNED NOT NULL ,
  `finish` INT(10) UNSIGNED NOT NULL ,
  `begin` INT(10) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_DT_RESEARCHS1_idx` (`techno_id` ASC) ,
  INDEX `fk_DT_buildings1_idx` (`building_id` ASC) ,
  INDEX `finish` (`finish` ASC) ,
  CONSTRAINT `fk_DT_buildings1`
    FOREIGN KEY (`building_id` )
    REFERENCES `biskanah`.`buildings` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DT_RESEARCHS1`
    FOREIGN KEY (`techno_id` )
    REFERENCES `biskanah`.`technos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`dtunits`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`dtunits` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `unit_id` INT(10) UNSIGNED NOT NULL ,
  `building_id` INT(10) UNSIGNED NOT NULL ,
  `begin` INT(11) NOT NULL ,
  `finish` INT(11) NOT NULL ,
  `num` MEDIUMINT(9) NOT NULL ,
  `num_ready` MEDIUMINT(9) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_dtunits_units1_idx` (`unit_id` ASC) ,
  INDEX `fk_dtunits_buildings1_idx` (`building_id` ASC) ,
  INDEX `finish` (`finish` ASC) ,
  CONSTRAINT `fk_dtunits_buildings1`
    FOREIGN KEY (`building_id` )
    REFERENCES `biskanah`.`buildings` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dtunits_units1`
    FOREIGN KEY (`unit_id` )
    REFERENCES `biskanah`.`units` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`groups`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`groups` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`invits`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`invits` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` SMALLINT(5) UNSIGNED NOT NULL ,
  `team_id` SMALLINT(5) UNSIGNED NOT NULL ,
  `from_user` SMALLINT(5) UNSIGNED NOT NULL ,
  `created` DATETIME NOT NULL ,
  `read` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_invits_users1_idx` (`user_id` ASC) ,
  INDEX `fk_invits_teams1_idx` (`team_id` ASC) ,
  INDEX `fk_invits_users2_idx` (`from_user` ASC) ,
  CONSTRAINT `fk_invits_teams1`
    FOREIGN KEY (`team_id` )
    REFERENCES `biskanah`.`teams` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_invits_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `biskanah`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_invits_users2`
    FOREIGN KEY (`from_user` )
    REFERENCES `biskanah`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`messages`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`messages` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NULL DEFAULT NULL ,
  `content` TEXT NOT NULL ,
  `sent` DATETIME NOT NULL ,
  `read` DATETIME NULL DEFAULT NULL ,
  `to` SMALLINT(5) UNSIGNED NOT NULL ,
  `from` SMALLINT(5) UNSIGNED NOT NULL ,
  `archive` TINYINT(3) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_messages_users2_idx` (`to` ASC) ,
  INDEX `fk_messages_users1_idx` (`from` ASC) ,
  INDEX `sent` (`sent` ASC) ,
  CONSTRAINT `fk_messages_users1`
    FOREIGN KEY (`from` )
    REFERENCES `biskanah`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_messages_users2`
    FOREIGN KEY (`to` )
    REFERENCES `biskanah`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`rankteams`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`rankteams` (
  `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `team_id` SMALLINT(5) UNSIGNED NOT NULL ,
  `kill` BIGINT(19) UNSIGNED NOT NULL ,
  `steal` BIGINT(19) UNSIGNED NOT NULL ,
  `evo` BIGINT(19) UNSIGNED NOT NULL ,
  `lost` BIGINT(19) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_rankteams_teams1_idx` (`team_id` ASC) ,
  INDEX `kill` (`kill` ASC) ,
  INDEX `steal` (`steal` ASC) ,
  INDEX `evo` (`evo` ASC) ,
  INDEX `lost` (`lost` ASC) ,
  CONSTRAINT `fk_rankteams_teams1`
    FOREIGN KEY (`team_id` )
    REFERENCES `biskanah`.`teams` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`rankusers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`rankusers` (
  `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` SMALLINT(5) UNSIGNED NOT NULL ,
  `kill` INT(10) UNSIGNED NOT NULL ,
  `steal` INT(10) UNSIGNED NOT NULL ,
  `evo` INT(10) UNSIGNED NOT NULL ,
  `lost` INT(10) UNSIGNED NOT NULL COMMENT 'kill :: unités tuées en ressources\nsteal :: ressources pillées\nevo :: points gagnés\nlost :: points perdus' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_rankusers_users1_idx` (`user_id` ASC) ,
  INDEX `kill` (`kill` ASC) ,
  INDEX `steal` (`steal` ASC) ,
  INDEX `evo` (`evo` ASC) ,
  INDEX `lost` (`lost` ASC) ,
  CONSTRAINT `fk_rankusers_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `biskanah`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`reports`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`reports` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `camp_id` MEDIUMINT(8) UNSIGNED NOT NULL ,
  `content` TEXT NOT NULL ,
  `created` DATETIME NOT NULL ,
  `read` DATETIME NULL DEFAULT NULL ,
  `pts_att` INT(10) UNSIGNED NOT NULL ,
  `pts_def` INT(10) UNSIGNED NOT NULL ,
  `archive` TINYINT(3) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_reports_camps1_idx` (`camp_id` ASC) ,
  INDEX `created` (`created` ASC) ,
  CONSTRAINT `fk_reports_camps1`
    FOREIGN KEY (`camp_id` )
    REFERENCES `biskanah`.`camps` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `biskanah`.`sends`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `biskanah`.`sends` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `from` MEDIUMINT(8) UNSIGNED NOT NULL ,
  `to` MEDIUMINT(8) UNSIGNED NOT NULL ,
  `pc_res1` TINYINT(3) UNSIGNED NOT NULL ,
  `pc_res2` TINYINT(3) UNSIGNED NOT NULL ,
  `pc_res3` TINYINT(3) UNSIGNED NOT NULL ,
  `activate` TINYINT(3) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sends_camps1_idx` (`from` ASC) ,
  INDEX `fk_sends_camps2_idx` (`to` ASC) ,
  CONSTRAINT `fk_sends_camps1`
    FOREIGN KEY (`from` )
    REFERENCES `biskanah`.`camps` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sends_camps2`
    FOREIGN KEY (`to` )
    REFERENCES `biskanah`.`camps` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;

USE `biskanah` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
