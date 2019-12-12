CREATE TABLE  `site_settings` (
 `sname` VARCHAR( 80 ) NOT NULL ,
 `sdescription` VARCHAR( 1000 ) NOT NULL ,
 `skeywords` VARCHAR( 400 ) NOT NULL ,
 `scase` BOOL NOT NULL ,
 `sclosemsg` TEXT NOT NULL ,
 `admin_notes` TEXT NOT NULL ,
 `smail` VARCHAR( 300 ) NOT NULL
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci ;

CREATE TABLE  `users` (
 `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `fname` VARCHAR( 60 ) NOT NULL ,
 `lname` VARCHAR( 60 ) NOT NULL ,
 `email` VARCHAR( 150 ) NOT NULL ,
 `pass` VARCHAR( 150 ) NOT NULL ,
 `permissions` VARCHAR( 20 ) NOT NULL ,
 `ip` VARCHAR( 30 ) NOT NULL
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE  `photos` (
 `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `uid` INT NOT NULL ,
 `title` VARCHAR( 500 ) NOT NULL ,
 `content` TEXT NOT NULL ,
 `source` VARCHAR( 700 ) NOT NULL
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE  `videos` (
 `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `uid` INT NOT NULL ,
 `title` VARCHAR( 500 ) NOT NULL ,
 `content` TEXT NOT NULL ,
 `source` VARCHAR( 700 ) NOT NULL
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE  `pcomments` (
 `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `sid` INT NOT NULL ,
 `uid` INT NOT NULL ,
 `comment` TEXT NOT NULL ,
 `commenter` VARCHAR( 150 ) NOT NULL ,
 `date` VARCHAR( 40 ) NOT NULL
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE  `vcomments` (
 `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `sid` INT NOT NULL ,
 `uid` INT NOT NULL ,
 `comment` TEXT NOT NULL ,
 `date` VARCHAR( 40 ) NOT NULL ,
 `commenter` VARCHAR( 150 ) NOT NULL
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE TABLE  `blocks` (
 `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
 `b_title` VARCHAR( 500 ) NOT NULL ,
 `b_content` TEXT NOT NULL ,
 `b_order` INT NOT NULL
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;