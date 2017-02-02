SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`statut`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`statut` (
  `idStatut` INT NOT NULL,
  `nomStatut` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idStatut`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`user` (
  `iduser` INT NOT NULL,
  `pseudo` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `idStatut` INT NOT NULL,
  PRIMARY KEY (`iduser`),
  INDEX `fk_user_1_idx` (`idStatut` ASC),
  CONSTRAINT `fk_user_1`
    FOREIGN KEY (`idStatut`)
    REFERENCES `mydb`.`statut` (`idStatut`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`formation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`formation` (
  `idFormation` INT NOT NULL,
  `nomFormation` VARCHAR(45) NOT NULL,
  `theorie` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idFormation`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`user_formation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`user_formation` (
  `idUser` INT NOT NULL,
  `idFormation` INT NOT NULL,
  PRIMARY KEY (`idUser`, `idFormation`),
  INDEX `fk_user_formation_2_idx` (`idFormation` ASC),
  CONSTRAINT `fk_user_formation_1`
    FOREIGN KEY (`idUser`)
    REFERENCES `mydb`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_formation_2`
    FOREIGN KEY (`idFormation`)
    REFERENCES `mydb`.`formation` (`idFormation`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`exercice`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`exercice` (
  `idExercice` INT NOT NULL,
  `idFormation` INT NOT NULL,
  `enoncer` VARCHAR(45) NULL,
  PRIMARY KEY (`idExercice`),
  INDEX `fk_exercice_1_idx` (`idFormation` ASC),
  CONSTRAINT `fk_exercice_1`
    FOREIGN KEY (`idFormation`)
    REFERENCES `mydb`.`formation` (`idFormation`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`question`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`question` (
  `idQuestion` INT NOT NULL,
  `question` VARCHAR(45) NOT NULL,
  `idExercice` INT NOT NULL,
  PRIMARY KEY (`idQuestion`),
  INDEX `fk_question_1_idx` (`idExercice` ASC),
  CONSTRAINT `fk_question_1`
    FOREIGN KEY (`idExercice`)
    REFERENCES `mydb`.`exercice` (`idExercice`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`reponse`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`reponse` (
  `idReponse` INT NOT NULL,
  `reponse` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idReponse`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`rep_question`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`rep_question` (
  `idQuestion` INT NOT NULL,
  `idReponse` INT NOT NULL,
  PRIMARY KEY (`idQuestion`, `idReponse`),
  INDEX `fk_rep_question_2_idx` (`idReponse` ASC),
  CONSTRAINT `fk_rep_question_1`
    FOREIGN KEY (`idQuestion`)
    REFERENCES `mydb`.`question` (`idQuestion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rep_question_2`
    FOREIGN KEY (`idReponse`)
    REFERENCES `mydb`.`reponse` (`idReponse`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`score`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`score` (
  `idScore` INT NOT NULL,
  `idExercice` INT NOT NULL,
  `idUser` INT NOT NULL,
  `score` INT NOT NULL,
  PRIMARY KEY (`idScore`),
  INDEX `fk_score_1_idx` (`idExercice` ASC),
  INDEX `fk_score_2_idx` (`idUser` ASC),
  CONSTRAINT `fk_score_1`
    FOREIGN KEY (`idExercice`)
    REFERENCES `mydb`.`exercice` (`idExercice`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_score_2`
    FOREIGN KEY (`idUser`)
    REFERENCES `mydb`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
