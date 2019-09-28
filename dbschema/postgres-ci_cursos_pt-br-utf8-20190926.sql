-
-- -----------------------------------------------------
-- Schema ci_cursos
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Database ci_cursos
-- -----------------------------------------------------
CREATE DATABASE ci_cursos
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    CONNECTION LIMIT = -1;

-- -----------------------------------------------------
-- Table public.`perfil`
-- -----------------------------------------------------
CREATE TABLE public.perfil
(
    id serial NOT NULL,
    nome character varying(100) NOT NULL,
    PRIMARY KEY (id)
)
WITH (
         OIDS = FALSE
     );

ALTER TABLE public.perfil
    OWNER to postgres;


-- -----------------------------------------------------
-- Table public.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS public.`usuario` (
  id INT NOT NULL AUTO_INCREMENT,
  id_perfil INT NOT NULL,
  email character varying(40) NOT NULL,
  senha character varying(20) NOT NULL,
  nome character varying(100) NOT NULL,
  dth_inscricao timestamp without time zone,
  imagem character varying(100) NULL DEFAULT NULL,
  PRIMARY KEY (id),
  INDEX fk_usuario_perfil (id_perfil ASC), -- VISIBLE
  CONSTRAINT fk_usuario_perfil
    FOREIGN KEY (id_perfil)
    REFERENCES public.`perfil` (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE public.usuario
(
    id serial NOT NULL,
    id_perfil integer NOT NULL,
    email character varying(40) NOT NULL,
    senha character varying(20) NOT NULL,
    nome character varying(100) NOT NULL,
    dth_inscricao timestamp without time zone,
    imagem character varying(100) NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_usuario_perfil FOREIGN KEY (id_perfil)
        REFERENCES public.perfil (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
         OIDS = FALSE
     );

ALTER TABLE public.usuario
    OWNER to postgres;

-- -----------------------------------------------------
-- Table public.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS public.`categoria` (
  id INT NOT NULL AUTO_INCREMENT,
  nome character varying(45) NOT NULL,
  descricao character varying(100) NOT NULL,
  PRIMARY KEY (id))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table public.curso
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS public.curso (
  id INT NOT NULL AUTO_INCREMENT,
  id_categoria INT NOT NULL,
  nome character varying(45) NOT NULL,
  descricao character varying(100) NOT NULL,
  `dth_criacao` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (id),
  INDEX `fk_curso_categoria` (id_categoria ASC), -- VISIBLE
  CONSTRAINT `fk_curso_categoria`
    FOREIGN KEY (id_categoria)
    REFERENCES public.`categoria` (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table public.`topico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS public.`topico` (
  id INT NOT NULL AUTO_INCREMENT,
  `id_curso` INT NOT NULL,
  nome character varying(45) NOT NULL,
  `conteudo` character varying(2000) NOT NULL,
  PRIMARY KEY (id),
  INDEX `fk_topico_curso` (`id_curso` ASC), -- VISIBLE
  CONSTRAINT `fk_topico_curso`
    FOREIGN KEY (`id_curso`)
    REFERENCES public.curso (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table public.`turma`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS public.`turma` (
  id INT NOT NULL AUTO_INCREMENT,
  `id_professor` INT NULL,
  `id_aluno` INT NULL,
  `curso_id` INT NOT NULL,
  PRIMARY KEY (id),
  INDEX `fk_turma_curso1_idx` (`curso_id` ASC), -- VISIBLE
  CONSTRAINT `fk_turma_curso1`
    FOREIGN KEY (`curso_id`)
    REFERENCES public.curso (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table public.`turma_has_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS public.`turma_has_usuario` (
  `turma_id` INT NOT NULL,
  `usuario_id` INT NOT NULL,
  PRIMARY KEY (`turma_id`, `usuario_id`),
  INDEX `fk_turma_has_usuario_usuario1_idx` (`usuario_id` ASC), -- VISIBLE
  INDEX `fk_turma_has_usuario_turma1_idx` (`turma_id` ASC), -- VISIBLE
  CONSTRAINT `fk_turma_has_usuario_turma1`
    FOREIGN KEY (`turma_id`)
    REFERENCES public.`turma` (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_turma_has_usuario_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES public.`usuario` (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
