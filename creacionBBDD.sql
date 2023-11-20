
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DROP SCHEMA IF EXISTS `servidor`;
CREATE SCHEMA `servidor` DEFAULT CHARACTER SET utf8 ;-- MySQL Workbench Forward Engineering
use `servidor`;

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
CREATE SCHEMA IF NOT EXISTS `servidor` DEFAULT CHARACTER SET utf8 ;
USE `servidor` ;

-- -----------------------------------------------------
-- Table `servidor`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `servidor`.`Usuario` (
  `email` VARCHAR(255) NOT NULL,
  `contra` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `servidor`.`Tren`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `servidor`.`Tren` (
  `trenId` INT(10) NOT NULL AUTO_INCREMENT,
  `modelo` VARCHAR(24) NOT NULL,
  `tipoTren` INT(10) NOT NULL,
  `fechaFabricacion` INT(4) NOT NULL,
  PRIMARY KEY (`trenId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `servidor`.`Publicacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `servidor`.`Publicacion` (
  `pubId` INT(10) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `trenId` INT(10) NOT NULL,
  `titulo` VARCHAR(120) NOT NULL,
  PRIMARY KEY (`pubId`),
  INDEX `pub-usu_idx` (`email` ASC) VISIBLE,
  INDEX `pub-tren_idx` (`trenId` ASC) VISIBLE,
  CONSTRAINT `pub-usu`
    FOREIGN KEY (`email`)
    REFERENCES `servidor`.`Usuario` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `pub-tren`
    FOREIGN KEY (`trenId`)
    REFERENCES `servidor`.`Tren` (`trenId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `servidor`.`Imagen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `servidor`.`Imagen` (
  `imgId` INT(10) NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `pubId` INT(10) NOT NULL,
  PRIMARY KEY (`imgId`),
  INDEX `img-pub_idx` (`pubId` ASC) VISIBLE,
  CONSTRAINT `img-pub`
    FOREIGN KEY (`pubId`)
    REFERENCES `servidor`.`Publicacion` (`pubId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `servidor`.`Usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `servidor`;
INSERT INTO `servidor`.`Usuario` (`email`, `contra`) VALUES ('santiago@gmail.com', '1234567');

COMMIT;


-- -----------------------------------------------------
-- Data for table `servidor`.`Tren`
-- -----------------------------------------------------
START TRANSACTION;
USE `servidor`;
INSERT INTO `servidor`.`Tren` (`trenId`, `modelo`, `tipoTren`, `fechaFabricacion`) VALUES (1, 'Civia', 8, 1999);

COMMIT;


-- -----------------------------------------------------
-- Data for table `servidor`.`Publicacion`
-- -----------------------------------------------------
START TRANSACTION;
USE `servidor`;
INSERT INTO `servidor`.`Publicacion` (`pubId`, `email`, `trenId`, `titulo`) VALUES (1, 'santiago@gmail.com', 1, 'Holis');

COMMIT;


-- -----------------------------------------------------
-- Data for table `servidor`.`Imagen`
-- -----------------------------------------------------
START TRANSACTION;
USE `servidor`;
INSERT INTO `servidor`.`Imagen` (`imgId`, `fecha`, `pubId`) VALUES (1, '2023-11-17', 1);
INSERT INTO `servidor`.`Imagen` (`imgId`, `fecha`, `pubId`) VALUES (2, '2023-11-18', 1);

COMMIT;



