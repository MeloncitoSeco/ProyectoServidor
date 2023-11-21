-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema servidor
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema servidor
-- -----------------------------------------------------
DROP  SCHEMA IF EXISTS `servidor`;
CREATE SCHEMA IF NOT EXISTS `servidor` DEFAULT CHARACTER SET utf8mb3 ;
USE `servidor` ;

-- -----------------------------------------------------
-- Table `servidor`.`tipoTren`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `servidor`.`tipoTren` (
  `tipoTren` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`tipoTren`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = armscii8;


-- -----------------------------------------------------
-- Table `servidor`.`Tren`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `servidor`.`Tren` (
  `trenId` INT NOT NULL,
  `modelo` VARCHAR(24) NOT NULL,
  `tipoTren` INT NOT NULL,
  `fechaFabricacion` INT NOT NULL,
  PRIMARY KEY (`trenId`),
  INDEX `tren-tipo_idx` (`tipoTren` ASC),
  CONSTRAINT `tren-tipo`
    FOREIGN KEY (`tipoTren`)
    REFERENCES `servidor`.`tipoTren` (`tipoTren`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `servidor`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `servidor`.`Usuario` (
  `email` VARCHAR(255) NOT NULL,
  `contra` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `servidor`.`Publicacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `servidor`.`Publicacion` (
  `pubId` INT NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `trenId` INT NOT NULL,
  `titulo` VARCHAR(120) NOT NULL,
  `posicion` VARCHAR(45) NOT NULL,
  `comAuto` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`pubId`),
  INDEX `pub-usu_idx` (`email` ASC),
  INDEX `pub-tren_idx` (`trenId` ASC) ,
  CONSTRAINT `pub-tren`
    FOREIGN KEY (`trenId`)
    REFERENCES `servidor`.`Tren` (`trenId`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `pub-usu`
    FOREIGN KEY (`email`)
    REFERENCES `servidor`.`Usuario` (`email`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `servidor`.`Imagen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `servidor`.`Imagen` (
  `imgId` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `pubId` INT NOT NULL,
  `sesion` VARCHAR(255) NULL DEFAULT NULL,
  `num` INT NULL DEFAULT NULL,
  PRIMARY KEY (`imgId`),
  INDEX `img-pub_idx` (`pubId` ASC),
  CONSTRAINT `img-pub`
    FOREIGN KEY (`pubId`)
    REFERENCES `servidor`.`Publicacion` (`pubId`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
