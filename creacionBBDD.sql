
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
CREATE SCHEMA IF NOT EXISTS `servidor` DEFAULT CHARACTER SET utf8mb3 ;
USE `servidor` ;

-- -----------------------------------------------------
-- Table `servidor`.`tipoTren`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `servidor`.`tipoTren` (
  `tipoTren` INT(10) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`tipoTren`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = armscii8;


-- -----------------------------------------------------
-- Table `servidor`.`Tren`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `servidor`.`Tren` (
  `trenId` INT(10) NOT NULL,
  `modelo` VARCHAR(24) NOT NULL,
  `tipoTren` INT(10) NOT NULL,
  `fechaFabricacion` INT(4) NOT NULL,
  PRIMARY KEY (`trenId`),
  INDEX `tren-tipo_idx` (`tipoTren` ASC) VISIBLE,
  CONSTRAINT `tren-tipo`
    FOREIGN KEY (`tipoTren`)
    REFERENCES `servidor`.`tipoTren` (`tipoTren`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
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
  `pubId` INT(10) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `trenId` INT(10) NOT NULL,
  `titulo` VARCHAR(120) NOT NULL,
  `posicion` VARCHAR(45) NOT NULL,
  `comAuto` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`pubId`),
  INDEX `pub-usu_idx` (`email` ASC) VISIBLE,
  INDEX `pub-tren_idx` (`trenId` ASC) VISIBLE,
  CONSTRAINT `pub-tren`
    FOREIGN KEY (`trenId`)
    REFERENCES `servidor`.`Tren` (`trenId`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `pub-usu`
    FOREIGN KEY (`email`)
    REFERENCES `servidor`.`Usuario` (`email`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `servidor`.`Imagen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `servidor`.`Imagen` (
  `imgId` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `pubId` INT NOT NULL,
  `sesion` VARCHAR(255) NULL,
  `num` INT(10) NULL,
  PRIMARY KEY (`imgId`),
  INDEX `img-pub_idx` (`pubId` ASC) VISIBLE,
  CONSTRAINT `img-pub`
    FOREIGN KEY (`pubId`)
    REFERENCES `servidor`.`Publicacion` (`pubId`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `servidor`.`tipoTren`
-- -----------------------------------------------------
START TRANSACTION;
USE `servidor`;
INSERT INTO `servidor`.`tipoTren` (`tipoTren`, `nombre`) VALUES (1, 'Ave');
INSERT INTO `servidor`.`tipoTren` (`tipoTren`, `nombre`) VALUES (2, 'Alvia');
INSERT INTO `servidor`.`tipoTren` (`tipoTren`, `nombre`) VALUES (3, 'Avant');
INSERT INTO `servidor`.`tipoTren` (`tipoTren`, `nombre`) VALUES (4, 'IRYO');
INSERT INTO `servidor`.`tipoTren` (`tipoTren`, `nombre`) VALUES (5, 'OUIGO');
INSERT INTO `servidor`.`tipoTren` (`tipoTren`, `nombre`) VALUES (6, 'LD');
INSERT INTO `servidor`.`tipoTren` (`tipoTren`, `nombre`) VALUES (7, 'MD');
INSERT INTO `servidor`.`tipoTren` (`tipoTren`, `nombre`) VALUES (8, 'Cercanias/Rodalies');
INSERT INTO `servidor`.`tipoTren` (`tipoTren`, `nombre`) VALUES (9, 'AM');

COMMIT;


-- -----------------------------------------------------
-- Data for table `servidor`.`Tren`
-- -----------------------------------------------------
START TRANSACTION;
USE `servidor`;
INSERT INTO `servidor`.`Tren` (`trenId`, `modelo`, `tipoTren`, `fechaFabricacion`) VALUES (1, 'Civia', 6, 2003);

COMMIT;


-- -----------------------------------------------------
-- Data for table `servidor`.`Usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `servidor`;
INSERT INTO `servidor`.`Usuario` (`email`, `contra`) VALUES ('santiago@gmail.com', '12345');

COMMIT;


-- -----------------------------------------------------
-- Data for table `servidor`.`Publicacion`
-- -----------------------------------------------------
START TRANSACTION;
USE `servidor`;
INSERT INTO `servidor`.`Publicacion` (`pubId`, `email`, `trenId`, `titulo`, `posicion`, `comAuto`) VALUES (1, 'santiago@gmail.com', 1, 'Primer Civia', 'Quieto', 'Andalucía');
INSERT INTO `servidor`.`Publicacion` (`pubId`, `email`, `trenId`, `titulo`, `posicion`, `comAuto`) VALUES (2, 'santiago@gmail.com', 1, 'Segundo Civia', 'Quieto', 'Asturias');

COMMIT;


-- -----------------------------------------------------
-- Data for table `servidor`.`Imagen`
-- -----------------------------------------------------
START TRANSACTION;
USE `servidor`;
INSERT INTO `servidor`.`Imagen` ( `fecha`, `pubId`) VALUES ('2003-12-11', 1);
INSERT INTO `servidor`.`Imagen` ( `fecha`, `pubId`) VALUES ('2003-12-11', 1);
INSERT INTO `servidor`.`Imagen` ( `fecha`, `pubId`) VALUES ('2003-12-11', 2);
INSERT INTO `servidor`.`Imagen` ( `fecha`, `pubId`) VALUES ('2003-12-11', 2);

COMMIT;
START TRANSACTION;
USE `servidor`;
INSERT INTO `servidor`.`Imagen` ( `fecha`, `pubId`, `sesion`, `num`) VALUES ('2023-11-11', 1, 'santi', 0);
INSERT INTO `servidor`.`Imagen` ( `fecha`, `pubId`, `sesion`, `num`) VALUES ('2023-11-11', 1, 'santi', 2);
INSERT INTO `servidor`.`Imagen` ( `fecha`, `pubId`, `sesion`, `num`) VALUES ('2023-10-10', 2, 'jose', 14);

COMMIT;

