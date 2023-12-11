-- MySQL dump 10.11
--
-- to install this database, from a terminal, type:
-- mysql -u USERNAME -p -h SERVERNAME dolphin_crm < schema.sql
--
-- Host: localhost    Database: dolphin_crm


DROP DATABASE IF EXISTS dolphin_crm;
CREATE DATABASE dolphin_crm;
USE dolphin_crm;



DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id` int(11) NOT NULL auto_increment,
    `firstname` char(35) NOT NULL default '',
    `lastname` char(35) NOT NULL default '',
    `password` char(35) NOT NULL default '',
    `email` char(35) NOT NULL default '',
    `role` char(35) NOT NULL default '',
    `created_at` datetime NOT NULL default SYSDATE(),
    PRIMARY KEY  (`id`)
)  ENGINE=MyISAM AUTO_INCREMENT=4080 DEFAULT CHARSET=utf8mb4;

LOCK TABLES `users` WRITE;

INSERT INTO `users` (`id`,`firstname`, `lastname`, `password`,`email`, `role`) VALUES (1,'Prime', 'Admin', 'StandardAdminPassword', 'Admin@email.com','Admin');

UNLOCK TABLES;



DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
    `id` int(11) NOT NULL auto_increment,
    `title` char(35) NOT NULL default '',
    `firstname` char(35) NOT NULL default '',
    `lastname` char(35) NOT NULL default '',
    `email` char(35) NOT NULL default '',
    `telephone` char(35) NOT NULL default '',
    `company` char(35) NOT NULL default '',
    `type` char(35) NOT NULL default '',
    `assigned_to` char(35) NOT NULL default '',
    `created_by` int(11) NOT NULL default '0',
    `created_at` datetime NOT NULL default SYSDATE(),
    `updated_at`datetime NOT NULL default SYSDATE(),
    PRIMARY KEY(`id`)
)  ENGINE=MyISAM AUTO_INCREMENT=4080 DEFAULT CHARSET=utf8mb4;



DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
    `id` int(11) NOT NULL auto_increment,
    `contact_id` int NOT NULL default '0',
    `comment` text NOT NULL default '',
    `created_by` int NOT NULL default '0',
    `created_at` datetime NOT NULL default SYSDATE(),
    Primary KEY (`id`)
)  ENGINE=MyISAM AUTO_INCREMENT=4080 DEFAULT CHARSET=utf8mb4;

GRANT ALL PRIVILEGES ON dolphin_crm.* TO 'FinalProject_user'@'localhost' 
IDENTIFIED BY 'password123';