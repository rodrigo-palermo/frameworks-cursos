-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema ci_cursos
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ci_cursos
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ci_cursos` DEFAULT CHARACTER SET utf8 ;
USE `ci_cursos` ;

-- -----------------------------------------------------
-- Table `ci_cursos`.`perfil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ci_cursos`.`perfil` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
-- AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ci_cursos`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ci_cursos`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_perfil` INT NOT NULL,
  `email` VARCHAR(40) NOT NULL,
  `senha` VARCHAR(20) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `dth_inscricao` DATETIME NOT NULL,
  `imagem` VARCHAR(100) NULL,
  PRIMARY KEY (`id`),
 -- INDEX `fk_usuario_perfil_idx` (`id_perfil` ASC) VISIBLE,
  CONSTRAINT `fk_usuario_perfil`
    FOREIGN KEY (`id_perfil`)
    REFERENCES ci_cursos.perfil (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
-- AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ci_cursos`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ci_cursos`.`categoria` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `descricao` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `ci_cursos`.`curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ci_cursos`.`curso` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_categoria` INT NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `descricao` VARCHAR(100) NOT NULL,
  `dth_criacao` DATETIME NULL,
  PRIMARY KEY (`id`),
--  INDEX `fk_curso_categoria`1_idx` (`id_categoria` ASC) VISIBLE,
  CONSTRAINT `fk_curso_categoria`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `ci_cursos`.`categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ci_cursos`.`topico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ci_cursos`.`topico` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_curso` INT NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `conteudo` VARCHAR(2000) NOT NULL,
  PRIMARY KEY (`id`),
--  INDEX `fk_topico_curso1_idx` (`id_curso` ASC) VISIBLE,
  CONSTRAINT `fk_topico_curso`
    FOREIGN KEY (`id_curso`)
    REFERENCES `ci_cursos`.`curso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
