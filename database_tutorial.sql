--
-- Database: `tutorial`
--
CREATE DATABASE IF NOT EXISTS `ci_tutorial` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ci_tutorial`;

-- --------------------------------------------------------

--
-- table `news`
--

CREATE TABLE news (
        id int(11) NOT NULL AUTO_INCREMENT,
        title varchar(128) NOT NULL,
        slug varchar(128) NOT NULL,
        text text NOT NULL,
        PRIMARY KEY (id),
        KEY slug (slug)
);