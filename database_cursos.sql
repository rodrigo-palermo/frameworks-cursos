--
-- Database: `ci_cursos`
--
CREATE DATABASE IF NOT EXISTS `ci_cursos` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ci_cursos`;

-- -------------------------------------------------------
--
-- Estrutura da tabela `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
                                        `id` int(3) NOT NULL AUTO_INCREMENT,
                                        `nome` varchar(100) COLLATE utf8_general_ci NOT NULL,
                                        PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ;

-- --------------------------------------------------------
--
-- Estrutura da tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
                                         `id` int(3) NOT NULL AUTO_INCREMENT,
                                         `id_perfil` int(3) NOT NULL,
                                         `login` varchar(20) COLLATE utf8_general_ci NOT NULL,
                                         `senha` varchar(20) COLLATE utf8_general_ci NOT NULL,
                                         `nome` varchar(100) COLLATE utf8_general_ci NOT NULL,
                                         `data_inscricao` date NOT NULL,
                                         `imagem` varchar(100) COLLATE utf8_general_ci DEFAULT NULL,
                                         PRIMARY KEY (`id`),
                                         KEY `id_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ;