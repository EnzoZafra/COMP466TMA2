<?php

DB::query("CREATE TABLE IF NOT EXISTS `users` (
  `userid` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`userid`))");

DB::query("CREATE TABLE IF NOT EXISTS `bookmarks` (
  `bookmarkid` INT NOT NULL AUTO_INCREMENT,
  `users_userid` INT NOT NULL,
  `url` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`bookmarkid`, `users_userid`),
  INDEX `fk_bookmarks_users_idx` (`users_userid` ASC),
  CONSTRAINT `fk_bookmarks_users`
    FOREIGN KEY (`users_userid`)
    REFERENCES `users` (`userid`)
    ON DELETE NO ACTION
	ON UPDATE NO ACTION)");
?>
