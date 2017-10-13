-- -----------------------------------------------------
-- Schema iGoldb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `iGoldb` ;

-- -----------------------------------------------------
-- Schema iGoldb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `iGoldb` DEFAULT CHARACTER SET utf8 ;
USE `iGoldb` ;

-- -----------------------------------------------------
-- Table `iGoldb`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `iGoldb`.`roles` ;

CREATE TABLE IF NOT EXISTS `iGoldb`.`roles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(200) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `iGoldb`.`venues`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `iGoldb`.`venues` ;

CREATE TABLE IF NOT EXISTS `iGoldb`.`venues` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(200) NOT NULL,
  `address` VARCHAR(200) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `latitude` FLOAT(10,7) NOT NULL,
  `longitude` FLOAT(10,7) NOT NULL,
  `day_price` FLOAT(6,4) NOT NULL,
  `night_price` FLOAT(6,4) NOT NULL,
  `img`  VARCHAR(200) NULL,
  `parking` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '0:NOT 1:YES',
  `play_area` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '0:NOT 1:YES',
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `iGoldb`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `iGoldb`.`users` ;

CREATE TABLE `iGoldb`.`users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `doc_type` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '0:DNI 1:ALIEN CARD',
  `doc_number` VARCHAR(20) NOT NULL,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `venue_id` INT(11) NOT NULL,
  `role_id` INT(11) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `venues_users_idx` (`venue_id` ASC),
  INDEX `roles_users_idx` (`role_id` ASC),
  CONSTRAINT `venues_users_fk`
    FOREIGN KEY (`venue_id`)
    REFERENCES `iGoldb`.`venues` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `roles_users_fk`
    FOREIGN KEY (`role_id`)
    REFERENCES `iGoldb`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) 
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `iGoldb`.`schedules`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `iGoldb`.`schedules` ;

CREATE TABLE `iGoldb`.`schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule_day` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '1:MONDAY 7:SUNDAY',
  `init_hour` TIME NOT NULL,
  `price` FLOAT(6,4) NOT NULL,
  `available` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '0:NOT 1:YES',
  `venue_id` INT(11) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `venues_users_idx` (`venue_id` ASC),
  CONSTRAINT `venues_schedules_fk`
    FOREIGN KEY (`venue_id`)
    REFERENCES `iGoldb`.`venues` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) 
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `iGoldb`.`schedule_availability`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `iGoldb`.`schedule_availability` ;

CREATE TABLE `iGoldb`.`schedule_availability` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_date` DATE NOT NULL,
  `schedule_availability_status` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '0:RESERVED 1:RENTED 2:CANCELED',
  `price` FLOAT(6,4) NOT NULL,
  `schedule_id` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `schedule_sch_av_idx` (`schedule_id` ASC),
  INDEX `user_sch_av_idx` (`user_id` ASC),
  CONSTRAINT `schedule_sch_av_fk`
    FOREIGN KEY (`schedule_id`)
    REFERENCES `iGoldb`.`schedules` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `user_sch_av_fk`
    FOREIGN KEY (`user_id`)
    REFERENCES `iGoldb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) 
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `iGoldb`.`payments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `iGoldb`.`payments` ;

CREATE TABLE `iGoldb`.`payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '1:CREDIT CARD 7:CASH',
  `amount` FLOAT(6,4) NOT NULL,
  `schedule_availability_id` INT(11) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `sch_ava_payments_idx` (`schedule_availability_id` ASC),
  CONSTRAINT `sch_ava_payments_fk`
    FOREIGN KEY (`schedule_availability_id`)
    REFERENCES `iGoldb`.`schedule_availability` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) 
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


COMMIT;