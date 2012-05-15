
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- show
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `show`;

CREATE TABLE `show`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- performance
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `performance`;

CREATE TABLE `performance`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`showId` INTEGER,
	`venueId` INTEGER,
	`name` DATETIME NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `performance_FI_1` (`showId`),
	INDEX `performance_FI_2` (`venueId`),
	CONSTRAINT `performance_FK_1`
		FOREIGN KEY (`showId`)
		REFERENCES `show` (`id`),
	CONSTRAINT `performance_FK_2`
		FOREIGN KEY (`venueId`)
		REFERENCES `venue` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- venue
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `venue`;

CREATE TABLE `venue`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	`address` VARCHAR(255),
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- ticketType
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ticketType`;

CREATE TABLE `ticketType`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`performanceId` INTEGER,
	`name` VARCHAR(255),
	`price` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `ticketType_FI_1` (`performanceId`),
	CONSTRAINT `ticketType_FK_1`
		FOREIGN KEY (`performanceId`)
		REFERENCES `performance` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- row
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `row`;

CREATE TABLE `row`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`venueId` INTEGER,
	`name` VARCHAR(255),
	PRIMARY KEY (`id`),
	INDEX `row_FI_1` (`venueId`),
	CONSTRAINT `row_FK_1`
		FOREIGN KEY (`venueId`)
		REFERENCES `venue` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- seat
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `seat`;

CREATE TABLE `seat`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`rowId` INTEGER,
	`name` VARCHAR(255),
	`number` VARCHAR(255),
	`noSeat` TINYINT(1),
	PRIMARY KEY (`id`),
	INDEX `seat_FI_1` (`rowId`),
	CONSTRAINT `seat_FK_1`
		FOREIGN KEY (`rowId`)
		REFERENCES `row` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- seatAvailability
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `seatAvailability`;

CREATE TABLE `seatAvailability`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`seatId` INTEGER,
	`performanceId` INTEGER,
	`forSale` TINYINT(1),
	PRIMARY KEY (`id`),
	INDEX `seatAvailability_FI_1` (`seatId`),
	INDEX `seatAvailability_FI_2` (`performanceId`),
	CONSTRAINT `seatAvailability_FK_1`
		FOREIGN KEY (`seatId`)
		REFERENCES `seat` (`id`),
	CONSTRAINT `seatAvailability_FK_2`
		FOREIGN KEY (`performanceId`)
		REFERENCES `performance` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- order
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`when` DATETIME,
	`fullName` VARCHAR(255),
	`email` VARCHAR(255),
	`phone` VARCHAR(255),
	`fulfilled` TINYINT(1),
	`performanceId` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `order_FI_1` (`performanceId`),
	CONSTRAINT `order_FK_1`
		FOREIGN KEY (`performanceId`)
		REFERENCES `performance` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- orderSeat
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `orderSeat`;

CREATE TABLE `orderSeat`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`seatId` INTEGER,
	`orderId` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `orderSeat_FI_1` (`seatId`),
	INDEX `orderSeat_FI_2` (`orderId`),
	CONSTRAINT `orderSeat_FK_1`
		FOREIGN KEY (`seatId`)
		REFERENCES `seat` (`id`),
	CONSTRAINT `orderSeat_FK_2`
		FOREIGN KEY (`orderId`)
		REFERENCES `order` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- orderTicketType
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `orderTicketType`;

CREATE TABLE `orderTicketType`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`typeId` INTEGER,
	`orderId` INTEGER,
	`quantity` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `orderTicketType_FI_1` (`typeId`),
	INDEX `orderTicketType_FI_2` (`orderId`),
	CONSTRAINT `orderTicketType_FK_1`
		FOREIGN KEY (`typeId`)
		REFERENCES `ticketType` (`id`),
	CONSTRAINT `orderTicketType_FK_2`
		FOREIGN KEY (`orderId`)
		REFERENCES `order` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(255),
	`pass` VARCHAR(255),
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
