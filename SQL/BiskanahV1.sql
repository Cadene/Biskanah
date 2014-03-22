SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `BiskanahV1` ;
USE `BiskanahV1` ;

-- -----------------------------------------------------
-- Table `BiskanahV1`.`Worlds`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Worlds` (
  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `x` SMALLINT NOT NULL ,
  `y` SMALLINT NOT NULL ,
  `type` TINYINT UNSIGNED NOT NULL ,
  `occupied` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `coord` (`x` ASC, `y` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`A2bs`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`A2bs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `from` MEDIUMINT UNSIGNED NOT NULL ,
  `to` MEDIUMINT UNSIGNED NOT NULL ,
  `type` TINYINT UNSIGNED NOT NULL ,
  `begin` INT UNSIGNED NOT NULL ,
  `finish` INT UNSIGNED NOT NULL ,
  `res1` FLOAT(9,4) UNSIGNED NOT NULL ,
  `res2` FLOAT(9,4) UNSIGNED NOT NULL ,
  `res3` FLOAT(9,4) UNSIGNED NOT NULL ,
  `accepted` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `finish` (`finish` ASC) ,
  INDEX `fk_A2B_WORLD_from` (`from` ASC) ,
  INDEX `fk_A2B_WORLD_to` (`to` ASC) ,
  CONSTRAINT `fk_A2B_WORLD1`
    FOREIGN KEY (`to` )
    REFERENCES `BiskanahV1`.`Worlds` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_A2B_WORLD2`
    FOREIGN KEY (`from` )
    REFERENCES `BiskanahV1`.`Worlds` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`Dataunits`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Dataunits` (
  `id` TINYINT UNSIGNED NOT NULL ,
  `res1` SMALLINT UNSIGNED NOT NULL ,
  `res2` SMALLINT UNSIGNED NOT NULL ,
  `res3` SMALLINT UNSIGNED NOT NULL ,
  `att1` SMALLINT UNSIGNED NOT NULL ,
  `att2` SMALLINT UNSIGNED NOT NULL ,
  `att3` SMALLINT UNSIGNED NOT NULL ,
  `attbat` SMALLINT UNSIGNED NOT NULL ,
  `type` TINYINT UNSIGNED NOT NULL ,
  `speed` FLOAT(5,2) UNSIGNED NOT NULL ,
  `conso` TINYINT UNSIGNED NOT NULL ,
  `capacity` SMALLINT UNSIGNED NOT NULL ,
  `spy` TINYINT UNSIGNED NOT NULL ,
  `time` SMALLINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `type` (`type` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`Units`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Units` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `num` MEDIUMINT UNSIGNED NOT NULL ,
  `dataunit_id` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Units_Dataunits1_idx` (`dataunit_id` ASC) ,
  CONSTRAINT `fk_Units_Dataunits1`
    FOREIGN KEY (`dataunit_id` )
    REFERENCES `BiskanahV1`.`Dataunits` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`A2bs_Units`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`A2bs_Units` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `a2b_id` INT UNSIGNED NOT NULL ,
  `unit_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_A2B_has_objType_A2B1_idx` (`a2b_id` ASC) ,
  INDEX `fk_A2BS_UNITS_UNITS1_idx` (`unit_id` ASC) ,
  CONSTRAINT `fk_A2B_has_objType_A2B1`
    FOREIGN KEY (`a2b_id` )
    REFERENCES `BiskanahV1`.`A2bs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_A2BS_UNITS_UNITS1`
    FOREIGN KEY (`unit_id` )
    REFERENCES `BiskanahV1`.`Units` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`Teams`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Teams` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `tag` VARCHAR(10) NOT NULL ,
  `desc` TEXT NULL ,
  `created` DATETIME NOT NULL ,
  `rank_pts` BIGINT UNSIGNED NOT NULL ,
  `rank_units` BIGINT UNSIGNED NOT NULL ,
  `rank_biskanah` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  UNIQUE INDEX `tag_UNIQUE` (`tag` ASC) ,
  INDEX `rank_pts` (`rank_pts` DESC) ,
  INDEX `rank_units` (`rank_units` DESC) ,
  INDEX `rank_biskanah` (`rank_biskanah` DESC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`Users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Users` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `access` TINYINT UNSIGNED NOT NULL ,
  `desc` TEXT NOT NULL ,
  `diam` SMALLINT UNSIGNED NOT NULL ,
  `plus` TINYINT UNSIGNED NOT NULL ,
  `token` VARCHAR(23) NOT NULL ,
  `last_update` INT UNSIGNED NOT NULL ,
  `created` DATETIME NOT NULL ,
  `team_id` SMALLINT UNSIGNED NULL ,
  `team_access` TINYINT UNSIGNED NULL ,
  `biskanah` MEDIUMINT UNSIGNED NOT NULL ,
  `rank_pts` INT UNSIGNED NOT NULL ,
  `rank_units` INT UNSIGNED NOT NULL ,
  `unread_msg` SMALLINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_USERS_TEAMS1_idx` (`team_id` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  INDEX `rank_pts` (`rank_pts` DESC) ,
  INDEX `rank_units` (`rank_units` DESC) ,
  CONSTRAINT `fk_USERS_TEAMS1`
    FOREIGN KEY (`team_id` )
    REFERENCES `BiskanahV1`.`Teams` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`Camps`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Camps` (
  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `world_id` MEDIUMINT UNSIGNED NOT NULL ,
  `user_id` SMALLINT UNSIGNED NOT NULL ,
  `name` VARCHAR(45) NOT NULL COMMENT 'Si NULL , alors nom par défaut' ,
  `pts` MEDIUMINT UNSIGNED NOT NULL ,
  `type` TINYINT UNSIGNED NOT NULL ,
  `loyalty` FLOAT(3,2) UNSIGNED NOT NULL ,
  `last_update` INT NOT NULL ,
  `created` DATETIME NOT NULL ,
  `unread_reports` SMALLINT UNSIGNED NOT NULL ,
  `prod1` MEDIUMINT UNSIGNED NOT NULL ,
  `prod2` MEDIUMINT UNSIGNED NOT NULL ,
  `prod3` MEDIUMINT UNSIGNED NOT NULL ,
  `res1` FLOAT(9,4) UNSIGNED NOT NULL ,
  `res2` FLOAT(9,4) UNSIGNED NOT NULL ,
  `res3` FLOAT(9,4) UNSIGNED NOT NULL ,
  `a2b_id` INT UNSIGNED NULL COMMENT 'Pire attaque reçu en cours. A traiter par le serveur.' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_CAMPS_WORLD_idx` (`world_id` ASC) ,
  INDEX `fk_CAMPS_USERS1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_CAMPS_USERS1`
    FOREIGN KEY (`user_id` )
    REFERENCES `BiskanahV1`.`Users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CAMPS_WORLD`
    FOREIGN KEY (`world_id` )
    REFERENCES `BiskanahV1`.`Worlds` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`Databuildings`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Databuildings` (
  `id` SMALLINT UNSIGNED NOT NULL ,
  `lvl` TINYINT UNSIGNED NOT NULL ,
  `type` TINYINT UNSIGNED NOT NULL ,
  `res1` MEDIUMINT UNSIGNED NOT NULL ,
  `res2` MEDIUMINT UNSIGNED NOT NULL ,
  `res3` MEDIUMINT UNSIGNED NOT NULL ,
  `prod1` SMALLINT UNSIGNED NULL ,
  `prod2` SMALLINT UNSIGNED NULL ,
  `prod3` SMALLINT UNSIGNED NULL ,
  `struct` MEDIUMINT UNSIGNED NOT NULL ,
  `conso` SMALLINT UNSIGNED NOT NULL ,
  `time` SMALLINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `lvl` (`lvl` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`Buildings`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Buildings` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `camp_id` MEDIUMINT UNSIGNED NOT NULL ,
  `field` TINYINT NOT NULL ,
  `databuilding_id` SMALLINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_FIELDS_CAMPS1_idx` (`camp_id` ASC) ,
  INDEX `fk_Buildings_Databuildings1_idx` (`databuilding_id` ASC) ,
  CONSTRAINT `fk_FIELDS_CAMPS1`
    FOREIGN KEY (`camp_id` )
    REFERENCES `BiskanahV1`.`Camps` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Buildings_Databuildings1`
    FOREIGN KEY (`databuilding_id` )
    REFERENCES `BiskanahV1`.`Databuildings` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`Reports`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Reports` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `camp_id` MEDIUMINT UNSIGNED NOT NULL ,
  `content` TEXT NOT NULL ,
  `created` DATETIME NOT NULL ,
  `read` DATETIME NULL ,
  `pts_att` INT UNSIGNED NOT NULL ,
  `pts_def` INT UNSIGNED NOT NULL ,
  `archive` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Reports_Camps1_idx` (`camp_id` ASC) ,
  INDEX `created` (`created` DESC) ,
  CONSTRAINT `fk_Reports_Camps1`
    FOREIGN KEY (`camp_id` )
    REFERENCES `BiskanahV1`.`Camps` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`Camps_Units`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Camps_Units` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `camp_id` MEDIUMINT UNSIGNED NOT NULL ,
  `unit_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_CAMPS_UNITS_CAMPS1_idx` (`camp_id` ASC) ,
  INDEX `fk_CAMPS_UNITS_UNITS1_idx` (`unit_id` ASC) ,
  CONSTRAINT `fk_CAMPS_UNITS_CAMPS1`
    FOREIGN KEY (`camp_id` )
    REFERENCES `BiskanahV1`.`Camps` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CAMPS_UNITS_UNITS1`
    FOREIGN KEY (`unit_id` )
    REFERENCES `BiskanahV1`.`Units` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`Dtbuildings`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Dtbuildings` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `building_id` INT UNSIGNED NOT NULL ,
  `finish` INT UNSIGNED NOT NULL ,
  `begin` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_DT_FIELDS1_idx` (`building_id` ASC) ,
  INDEX `finish` (`finish` ASC) ,
  CONSTRAINT `fk_DT_FIELDS1`
    FOREIGN KEY (`building_id` )
    REFERENCES `BiskanahV1`.`Buildings` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`Datatechnos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Datatechnos` (
  `id` SMALLINT UNSIGNED NOT NULL ,
  `lvl` TINYINT UNSIGNED NOT NULL ,
  `type` TINYINT UNSIGNED NOT NULL ,
  `kind` TINYINT UNSIGNED NOT NULL ,
  `res1` SMALLINT UNSIGNED NOT NULL ,
  `res2` SMALLINT UNSIGNED NOT NULL ,
  `res3` SMALLINT UNSIGNED NOT NULL ,
  `time` SMALLINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `lvl` (`lvl` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`Technos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Technos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` SMALLINT UNSIGNED NOT NULL ,
  `datatechno_id` SMALLINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_RESEARCHS_USERS1_idx` (`user_id` ASC) ,
  INDEX `fk_Technos_Datatechnos1_idx` (`datatechno_id` ASC) ,
  CONSTRAINT `fk_RESEARCHS_USERS1`
    FOREIGN KEY (`user_id` )
    REFERENCES `BiskanahV1`.`Users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Technos_Datatechnos1`
    FOREIGN KEY (`datatechno_id` )
    REFERENCES `BiskanahV1`.`Datatechnos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`Dttechnos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Dttechnos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `techno_id` INT UNSIGNED NOT NULL ,
  `building_id` INT UNSIGNED NOT NULL ,
  `finish` INT UNSIGNED NOT NULL ,
  `begin` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_DT_RESEARCHS1_idx` (`techno_id` ASC) ,
  INDEX `fk_DT_BUILDINGS1_idx` (`building_id` ASC) ,
  INDEX `finish` (`finish` ASC) ,
  CONSTRAINT `fk_DT_RESEARCHS1`
    FOREIGN KEY (`techno_id` )
    REFERENCES `BiskanahV1`.`Technos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DT_BUILDINGS1`
    FOREIGN KEY (`building_id` )
    REFERENCES `BiskanahV1`.`Buildings` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`Dtunits`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Dtunits` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `unit_id` INT UNSIGNED NOT NULL ,
  `building_id` INT UNSIGNED NOT NULL ,
  `begin` INT NOT NULL ,
  `finish` INT NOT NULL ,
  `num` MEDIUMINT NOT NULL ,
  `num_ready` MEDIUMINT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_DTUNITS_UNITS1_idx` (`unit_id` ASC) ,
  INDEX `fk_DTUNITS_BUILDINGS1_idx` (`building_id` ASC) ,
  INDEX `finish` (`finish` ASC) ,
  CONSTRAINT `fk_DTUNITS_UNITS1`
    FOREIGN KEY (`unit_id` )
    REFERENCES `BiskanahV1`.`Units` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DTUNITS_BUILDINGS1`
    FOREIGN KEY (`building_id` )
    REFERENCES `BiskanahV1`.`Buildings` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`Assists`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Assists` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `from` MEDIUMINT UNSIGNED NOT NULL ,
  `on` MEDIUMINT UNSIGNED NOT NULL ,
  `res3` FLOAT(9,4) UNSIGNED NOT NULL ,
  `accepted` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_ASSISTS_CAMPS_FROM_idx` (`from` ASC) ,
  INDEX `fk_ASSISTS_CAMPS_ON_idx` (`on` ASC) ,
  CONSTRAINT `fk_ASSISTS_CAMPS_FROM`
    FOREIGN KEY (`from` )
    REFERENCES `BiskanahV1`.`Worlds` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ASSISTS_CAMPS_ON`
    FOREIGN KEY (`on` )
    REFERENCES `BiskanahV1`.`Worlds` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`Messages`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Messages` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NULL ,
  `content` TEXT NOT NULL ,
  `sent` DATETIME NOT NULL ,
  `read` DATETIME NULL ,
  `to` SMALLINT UNSIGNED NOT NULL ,
  `from` SMALLINT UNSIGNED NOT NULL ,
  `archive` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_MESSAGES_USERS2_idx` (`to` ASC) ,
  INDEX `fk_MESSAGES_USERS1_idx` (`from` ASC) ,
  INDEX `sent` (`sent` ASC) ,
  CONSTRAINT `fk_MESSAGES_USERS2`
    FOREIGN KEY (`to` )
    REFERENCES `BiskanahV1`.`Users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MESSAGES_USERS1`
    FOREIGN KEY (`from` )
    REFERENCES `BiskanahV1`.`Users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`Rankusers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Rankusers` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` SMALLINT UNSIGNED NOT NULL ,
  `kill` INT UNSIGNED NOT NULL ,
  `steal` INT UNSIGNED NOT NULL ,
  `evo` INT UNSIGNED NOT NULL ,
  `lost` INT UNSIGNED NOT NULL COMMENT 'kill :: unités tuées en ressources\nsteal :: ressources pillées\nevo :: points gagnés\nlost :: points perdus' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_RANKUSERS_USERS1_idx` (`user_id` ASC) ,
  INDEX `kill` (`kill` DESC) ,
  INDEX `steal` (`steal` DESC) ,
  INDEX `evo` (`evo` DESC) ,
  INDEX `lost` (`lost` DESC) ,
  CONSTRAINT `fk_RANKUSERS_USERS1`
    FOREIGN KEY (`user_id` )
    REFERENCES `BiskanahV1`.`Users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`Rankteams`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Rankteams` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `team_id` SMALLINT UNSIGNED NOT NULL ,
  `kill` BIGINT UNSIGNED NOT NULL ,
  `steal` BIGINT UNSIGNED NOT NULL ,
  `evo` BIGINT UNSIGNED NOT NULL ,
  `lost` BIGINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_RANKTEAMS_TEAMS1_idx` (`team_id` ASC) ,
  INDEX `kill` (`kill` DESC) ,
  INDEX `steal` (`steal` DESC) ,
  INDEX `evo` (`evo` DESC) ,
  INDEX `lost` (`lost` DESC) ,
  CONSTRAINT `fk_RANKTEAMS_TEAMS1`
    FOREIGN KEY (`team_id` )
    REFERENCES `BiskanahV1`.`Teams` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`Sends`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Sends` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `from` MEDIUMINT UNSIGNED NOT NULL ,
  `to` MEDIUMINT UNSIGNED NOT NULL ,
  `pc_res1` TINYINT UNSIGNED NOT NULL ,
  `pc_res2` TINYINT UNSIGNED NOT NULL ,
  `pc_res3` TINYINT UNSIGNED NOT NULL ,
  `activate` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_SENDS_CAMPS1_idx` (`from` ASC) ,
  INDEX `fk_SENDS_CAMPS2_idx` (`to` ASC) ,
  CONSTRAINT `fk_SENDS_CAMPS1`
    FOREIGN KEY (`from` )
    REFERENCES `BiskanahV1`.`Camps` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SENDS_CAMPS2`
    FOREIGN KEY (`to` )
    REFERENCES `BiskanahV1`.`Camps` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`Invits`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Invits` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` SMALLINT UNSIGNED NOT NULL ,
  `team_id` SMALLINT UNSIGNED NOT NULL ,
  `from_user` SMALLINT UNSIGNED NOT NULL ,
  `created` DATETIME NOT NULL ,
  `read` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_INVITS_USERS1_idx` (`user_id` ASC) ,
  INDEX `fk_INVITS_TEAMS1_idx` (`team_id` ASC) ,
  INDEX `fk_INVITS_USERS2_idx` (`from_user` ASC) ,
  CONSTRAINT `fk_INVITS_USERS1`
    FOREIGN KEY (`user_id` )
    REFERENCES `BiskanahV1`.`Users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_INVITS_TEAMS1`
    FOREIGN KEY (`team_id` )
    REFERENCES `BiskanahV1`.`Teams` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_INVITS_USERS2`
    FOREIGN KEY (`from_user` )
    REFERENCES `BiskanahV1`.`Users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`Assists_Units`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Assists_Units` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `assist_id` INT UNSIGNED NOT NULL ,
  `unit_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Assists_Units_Assists1_idx` (`assist_id` ASC) ,
  INDEX `fk_Assists_Units_Units1_idx` (`unit_id` ASC) ,
  CONSTRAINT `fk_Assists_Units_Assists1`
    FOREIGN KEY (`assist_id` )
    REFERENCES `BiskanahV1`.`Assists` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Assists_Units_Units1`
    FOREIGN KEY (`unit_id` )
    REFERENCES `BiskanahV1`.`Units` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BiskanahV1`.`Datanodes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BiskanahV1`.`Datanodes` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `from_data` SMALLINT UNSIGNED NOT NULL ,
  `from_kind` TINYINT UNSIGNED NOT NULL ,
  `to_data` SMALLINT UNSIGNED NOT NULL ,
  `to_kind` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `from` (`from_data` ASC, `from_kind` ASC) ,
  INDEX `data` (`to_data` ASC, `to_kind` ASC) )
ENGINE = InnoDB;

USE `BiskanahV1` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
