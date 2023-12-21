DROP DATABASE IF EXISTS `barbearia`;
CREATE DATABASE `barbearia`;
USE `barbearia`;

CREATE TABLE `user` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(45) NOT NULL,
    `password` TEXT NOT NULL,
    PRIMARY KEY(`id`)
);

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

ALTER TABLE `schedule` ADD CONSTRAINT `fk_schedule_service_id` FOREIGN KEY ( `service_id` ) REFERENCES `service` ( `id` ) ;
