<?php

DB::query("CREATE TABLE IF NOT EXISTS `users` (
  `userid` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC))");

DB::query("CREATE TABLE IF NOT EXISTS `courses` (
  `courseid` INT NOT NULL AUTO_INCREMENT,
  `coursename` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`courseid`))");

DB::query("CREATE TABLE IF NOT EXISTS `users_has_courses` (
  `users_userid` INT NOT NULL,
  `courses_courseid` INT NOT NULL,
  PRIMARY KEY (`users_userid`, `courses_courseid`),
  INDEX `fk_users_has_courses_courses1_idx` (`courses_courseid` ASC),
  INDEX `fk_users_has_courses_users_idx` (`users_userid` ASC),
  CONSTRAINT `fk_users_has_courses_users`
    FOREIGN KEY (`users_userid`)
    REFERENCES `users` (`userid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_courses_courses1`
    FOREIGN KEY (`courses_courseid`)
    REFERENCES `courses` (`courseid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)");

DB::query("CREATE TABLE IF NOT EXISTS `units` (
  `unitid` INT NOT NULL AUTO_INCREMENT,
  `unitname` VARCHAR(45) NOT NULL,
  `courses_courseid` INT NOT NULL,
  PRIMARY KEY (`unitid`, `courses_courseid`),
  INDEX `fk_units_courses1_idx` (`courses_courseid` ASC),
  CONSTRAINT `fk_units_courses1`
    FOREIGN KEY (`courses_courseid`)
    REFERENCES `courses` (`courseid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)");

DB::query("CREATE TABLE IF NOT EXISTS `topics` (
  `topicid` INT NOT NULL AUTO_INCREMENT,
  `units_unitid` INT NOT NULL,
  `content` TEXT NULL,
  `topicname` VARCHAR(45) NULL,
  PRIMARY KEY (`topicid`, `units_unitid`),
  INDEX `fk_topics_units1_idx` (`units_unitid` ASC),
  CONSTRAINT `fk_topics_units1`
    FOREIGN KEY (`units_unitid`)
    REFERENCES `units` (`unitid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)");

DB::query("CREATE TABLE IF NOT EXISTS `quizzes` (
  `quizid` INT NOT NULL AUTO_INCREMENT,
  `units_unitid` INT NOT NULL,
  `content` TEXT NULL,
  PRIMARY KEY (`quizid`, `units_unitid`),
  INDEX `fk_quizzes_units1_idx` (`units_unitid` ASC),
  CONSTRAINT `fk_quizzes_units1`
    FOREIGN KEY (`units_unitid`)
    REFERENCES `units` (`unitid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)");
