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
-- Database ci_session - Sessao CodeIgniter/Heroku
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "ci_sessions" (
                               "id" varchar(128) NOT NULL,
                               "ip_address" varchar(45) NOT NULL,
                               "timestamp" bigint DEFAULT 0 NOT NULL,
                               "data" text DEFAULT '' NOT NULL
);

CREATE INDEX "ci_sessions_timestamp" ON "ci_sessions" ("timestamp");
-- When sess_match_ip = TRUE
-- ALTER TABLE ci_sessions ADD PRIMARY KEY (id, ip_address);

-- When sess_match_ip = FALSE
ALTER TABLE ci_sessions ADD PRIMARY KEY (id);

-- To drop a previously created primary key (use when changing the setting)
-- ALTER TABLE ci_sessions DROP PRIMARY KEY;

-- -----------------------------------------------------
-- Table public.perfil
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS public.perfil
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
-- Table public.usuario
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS public.usuario
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
-- Table public.categoria
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS public.categoria
(
    id serial NOT NULL,
    nome character varying(45) NOT NULL,
    descricao character varying(100) NOT NULL,
    PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
);

ALTER TABLE public.categoria
    OWNER to postgres;

-- -----------------------------------------------------
-- Table public.curso
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS public.curso
(
    id serial NOT NULL,
    id_categoria integer NOT NULL,
    nome character varying(45) NOT NULL,
    descricao character varying(100) NOT NULL,
    dth_criacao timestamp without time zone,
    imagem character varying(100) NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_curso_categoria FOREIGN KEY (id_categoria)
        REFERENCES public.categoria (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
);

ALTER TABLE public.curso
    OWNER to postgres;

-- -----------------------------------------------------
-- Table public.conteudo
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS public.conteudo
(
    id serial NOT NULL,
    id_curso integer NOT NULL,
    nome character varying(45) NOT NULL,
    descricao character varying(2000) NOT NULL,
    dth_criacao timestamp without time zone,
    imagem character varying(100) NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_conteudo_curso FOREIGN KEY (id_curso)
        REFERENCES public.curso (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
);

ALTER TABLE public.conteudo
    OWNER to postgres;
-- -----------------------------------------------------
-- Table public.turma
-- -----------------------------------------------------
CREATE TABLE public.turma
(
    id serial NOT NULL,
    id_curso integer NOT NULL,
    nome character varying(45) NOT NULL,
    descricao character varying(2000) NOT NULL,
    dth_criacao timestamp without time zone,
    imagem character varying(100) NULL DEFAULT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_turma_curso FOREIGN KEY (id_curso)
        REFERENCES public.curso (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
);

ALTER TABLE public.turma
    OWNER to postgres;

-- -----------------------------------------------------
-- Table public.turma_tem_usuario
-- -----------------------------------------------------
CREATE TABLE public.turma_tem_usuario
(
    -- id serial NOT NULL,
    id_turma integer NOT NULL,
    id_usuario integer NOT NULL,
    PRIMARY KEY (id_turma, id_usuario),
    CONSTRAINT fk_turma_has_usuario_turma FOREIGN KEY (id_turma)
        REFERENCES public.turma (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT fk_turma_has_usuario_usuario FOREIGN KEY (id_usuario)
        REFERENCES public.usuario (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
);

ALTER TABLE public.turma_tem_usuario
    OWNER to postgres;
