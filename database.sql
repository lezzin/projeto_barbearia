DROP DATABASE IF EXISTS `barbearia`;
CREATE DATABASE `barbearia`;
USE `barbearia`;

CREATE TABLE `user` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(45) NOT NULL,
    `tel` VARCHAR(45),
    `password` TEXT NOT NULL,
    `type` INT NOT NULL DEFAULT 1,
    PRIMARY KEY(`id`)
);

INSERT INTO `user` (`name`, `password`, `type`) VALUES ("adm", "$2y$10$34zXSGF5yVuDp/Q09rCZnu2FtBNZF.4bZectqBLvM4BGGqFhScXXq", 2);

CREATE TABLE `service` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(45) NOT NULL,
    `price` DECIMAL(8, 2) NOT NULL,
    PRIMARY KEY(`id`)
);

CREATE TABLE `unavailable_datetime` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `datetime` DATETIME NOT NULL,
    PRIMARY KEY(`id`)
);

CREATE TABLE `schedule` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `user` VARCHAR(45) NOT NULL,
    `tel` VARCHAR(45) NOT NULL,
    `service_id` INT NOT NULL,
    `datetime` DATETIME NOT NULL,
    `message` TEXT NULL,
    PRIMARY KEY(`id`)
);

CREATE TABLE `contact_info` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(45) NOT NULL,
    `address` VARCHAR(45) NOT NULL,
    `tel` VARCHAR(45) NOT NULL,
    `whatsapp` VARCHAR(45) NOT NULL,
    PRIMARY KEY(`id`)
)

ALTER TABLE `schedule` ADD CONSTRAINT `fk_schedule_service_id` FOREIGN KEY ( `service_id` ) REFERENCES `service` ( `id` ) ON DELETE CASCADE;
