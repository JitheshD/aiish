<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

mysql_query("CREATE DATABASE IF NOT EXISTS `{$db_name}`");
$db_select = @mysql_select_db($db_name);

// 1th Table
$tb = "CREATE TABLE `{$db_name}`.`user_info_tb` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_full_name` varchar(200) NOT NULL,
  `user_designation` varchar(200) NOT NULL,
  `user_counter` int(11) NOT NULL,
  `user_level` int(11) NOT NULL DEFAULT '2' COMMENT '1=Admin, 2=Counter User',
  `user_status` int(11) NOT NULL DEFAULT '1' COMMENT '1=Active, 2=Inactive, 0=Trashed',
  `user_created_on` datetime NOT NULL,
  `user_updated_on` datetime NOT NULL,
  `user_last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_activity` time NOT NULL,
  `user_logout` datetime NOT NULL,
  `user_ip` varchar(15) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";
mysql_query($tb);

$qry_1 = "INSERT INTO `{$db_name}`.`user_info_tb`(`user_name`,`user_password`,`user_full_name`,`user_designation`,`user_level`,`user_created_on`) VALUES('admin','xw_ag5kBnZOk07vnYrXWpVTm-DMxP1gUOQR9fd_ADB8','Administrator','Admin','1',NOW())";
mysql_query($qry_1);

$qry_1 = "CREATE PROCEDURE `toDoUserAction`(IN `usr_id` INT, IN `username` VARCHAR(100), IN `user_password` VARCHAR(150), IN `user_full_name` VARCHAR(250), IN `user_level` INT, IN `process_by` INT) BEGIN IF (usr_id = '') THEN INSERT INTO `user_info_tb` (`user_name`, `user_password`, `user_full_name`, `user_level`, `user_created_on`, `user_updated_on`) VALUES (username, user_password, user_full_name, user_level, NOW(), NOW()); ELSE UPDATE `user_info_tb` SET `user_name` = username, `user_password` = user_password, `user_full_name` = user_full_name, `user_level` = user_level, `user_updated_on` = NOW() WHERE `user_id` = usr_id; END IF; END";
mysql_query($qry_1);

$qry_1 = "CREATE PROCEDURE `updateUserStatus`(IN `usr_id` INT, IN `usr_status` INT) BEGIN UPDATE `user_info_tb` SET `user_status` = usr_status, `user_updated_on` = NOW() WHERE `user_id` = usr_id; END";
mysql_query($qry_1);


// Taluk Table
//$tb = "CREATE TABLE `{$db_name}`.`taluk_tb` (
//  `taluk_id` int(11) NOT NULL AUTO_INCREMENT,
//  `taluk_name` varchar(100) NOT NULL,
//  `taluk_status` int(11) NOT NULL DEFAULT '1' COMMENT '1=Active, 2=Inactive, 0=Trashed',
//  PRIMARY KEY (`taluk_id`)
//) ENGINE=InnoDB DEFAULT CHARSET=utf8";
//mysql_query($tb);

//$qry_1 = "CREATE PROCEDURE `toDoTalukAction`(IN `tlq_id` INT, IN `tlq_name` VARCHAR(100)) BEGIN IF (tlq_id = '') THEN INSERT INTO `taluk_tb` (`taluk_name`) VALUES (tlq_name); ELSE UPDATE `taluk_tb` SET `taluk_name` = tlq_name WHERE `taluk_id` = tlq_id; END IF; END";
//mysql_query($qry_1);

$qry_1 = "CREATE PROCEDURE `ToDoCategoryForm`(
    IN `catid` INT, 
    IN `catname` VARCHAR(100), 
    IN `process_by` INT) 
    BEGIN IF (catid = '') THEN 
            INSERT INTO `category_tb` (`catname`, `category_created_on`, `category_updated_on`) VALUES (catname, NOW(), NOW()); 
        ELSE 
            UPDATE `category_tb` SET `category_name` = catname, `category_updated_on` = NOW() WHERE `category_id` = catid; 
        END IF; 
    END";
mysql_query($qry_1);

$qry_1 = "CREATE PROCEDURE `updateCategoryStatus`(IN `catid` INT, IN `catstatus` INT) 
            BEGIN 
                UPDATE `category_tb` SET `category_status` = catstatus, `category_updated_on` = NOW() WHERE `category_id` = catid; 
            END";
mysql_query($qry_1);