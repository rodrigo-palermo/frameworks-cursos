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
  `imagem` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_usuario_perfil` (`id_perfil` ASC), -- VISIBLE
  CONSTRAINT `fk_usuario_perfil`
    FOREIGN KEY (`id_perfil`)
    REFERENCES `ci_cursos`.`perfil` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ci_cursos`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ci_cursos`.`categoria` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `descricao` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ci_cursos`.`curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ci_cursos`.`curso` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_categoria` INT NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `descricao` VARCHAR(100) NOT NULL,
  `dth_criacao` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_curso_categoria` (`id_categoria` ASC), -- VISIBLE
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
  INDEX `fk_topico_curso` (`id_curso` ASC), -- VISIBLE
  CONSTRAINT `fk_topico_curso`
    FOREIGN KEY (`id_curso`)
    REFERENCES `ci_cursos`.`curso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ci_cursos`.`turma`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ci_cursos`.`turma` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_professor` INT NULL,
  `id_aluno` INT NULL,
  `curso_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_turma_curso1_idx` (`curso_id` ASC), -- VISIBLE
  CONSTRAINT `fk_turma_curso1`
    FOREIGN KEY (`curso_id`)
    REFERENCES `ci_cursos`.`curso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ci_cursos`.`turma_has_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ci_cursos`.`turma_has_usuario` (
  `turma_id` INT NOT NULL,
  `usuario_id` INT NOT NULL,
  PRIMARY KEY (`turma_id`, `usuario_id`),
  INDEX `fk_turma_has_usuario_usuario1_idx` (`usuario_id` ASC), -- VISIBLE
  INDEX `fk_turma_has_usuario_turma1_idx` (`turma_id` ASC), -- VISIBLE
  CONSTRAINT `fk_turma_has_usuario_turma1`
    FOREIGN KEY (`turma_id`)
    REFERENCES `ci_cursos`.`turma` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_turma_has_usuario_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `ci_cursos`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
