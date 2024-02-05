-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema LocationAgence
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema LocationAgence
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `LocationAgence` DEFAULT CHARACTER SET utf8 ;
USE `LocationAgence` ;

-- -----------------------------------------------------
-- Table `LocationAgence`.`client`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LocationAgence`.`client` (
  `id` INT NOT NULL,
  `nom` VARCHAR(60) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `telephone` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `LocationAgence`.`voiture`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LocationAgence`.`voiture` (
  `id` INT NOT NULL,
  `marque` VARCHAR(255) NOT NULL,
  `modele` VARCHAR(255) NOT NULL,
  `annee` INT NULL,
  `prix_location` DOUBLE NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `LocationAgence`.`location`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LocationAgence`.`location` (
  `id` INT NOT NULL,
  `date_location` DATE NOT NULL,
  `client_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_location_client_idx` (`client_id` ASC),
  CONSTRAINT `fk_location_client`
    FOREIGN KEY (`client_id`)
    REFERENCES `LocationAgence`.`client` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `LocationAgence`.`voiture_location`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LocationAgence`.`voiture_location` (
  `voiture_id` INT NOT NULL,
  `location_id` INT NOT NULL,
  `prix` VARCHAR(45) NOT NULL,
  INDEX `fk_voiture_has_location_location1_idx` (`location_id` ASC),
  INDEX `fk_voiture_has_location_voiture1_idx` (`voiture_id` ASC) ,
  UNIQUE INDEX `voiture_id_UNIQUE` (`voiture_id` ASC) ,
  UNIQUE INDEX `location_id_UNIQUE` (`location_id` ASC) ,
  CONSTRAINT `fk_voiture_has_location_voiture1`
    FOREIGN KEY (`voiture_id`)
    REFERENCES `LocationAgence`.`voiture` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_voiture_has_location_location1`
    FOREIGN KEY (`location_id`)
    REFERENCES `LocationAgence`.`location` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
