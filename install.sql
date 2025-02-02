CREATE TABLE `users` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`fullName` VARCHAR(32) NULL , 
`password` VARCHAR(32) NOT NULL , 
`email` VARCHAR(64) NOT NULL , 
PRIMARY KEY (`id`), 
UNIQUE (`email`)
) ENGINE = InnoDB; 

CREATE TABLE `containers` ( 
`user_id` INT NOT NULL , 
`container` VARCHAR(32) NULL , 
`volume` VARCHAR(32) NULL , 
UNIQUE (`user_id`)
) ENGINE = InnoDB;

ALTER TABLE `containers` 
ADD FOREIGN KEY (`user_id`) 
REFERENCES `users`(`id`) 
ON DELETE RESTRICT 
ON UPDATE RESTRICT;

--CHARACTER SET gb2312 COLLATE gb2312_chinese_ci