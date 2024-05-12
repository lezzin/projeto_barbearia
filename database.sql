CREATE DATABASE IF NOT EXISTS `barbershop`;
USE `barbershop`.

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `email` text NOT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `password` text NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
);

INSERT INTO `user` (`id`, `name`, `email`, `tel`, `password`, `type`) VALUES
(null, 'adm', 'teste@gmail.com', '1313', '$2y$10$/BUNPbo/Pp9JSV.cdwznt.LS3Tvs.tyRldXnN2KWj6iH9a895Ds0y', 2);

CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `service` (`id`, `name`, `price`) VALUES
(1, 'Acabamento', 10.00),
(2, 'Cabelo', 30.00),
(3, 'Barba', 50.00),
(4, 'Cabelo e barba', 80.00);

CREATE TABLE IF NOT EXISTS `contact_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `tel` varchar(45) NOT NULL,
  `whatsapp` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(45) NOT NULL,
  `tel` varchar(45) NOT NULL,
  `email` text NOT NULL,
  `service_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `message` text DEFAULT NULL,
  `fk_user` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_schedule_service_id` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_schedule_user_id` FOREIGN KEY (`fk_user`) REFERENCES `user` (`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `unavailable_datetime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
);
