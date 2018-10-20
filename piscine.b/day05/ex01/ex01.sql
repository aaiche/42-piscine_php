CREATE TABLE IF NOT EXISTS db_aaiche.ft_table (
	id INT(11) NOT NULL AUTO_INCREMENT,
	login VARCHAR(20) NOT NULL DEFAULT 'toto',
	`group` ENUM('staff', 'student', 'other') NOT NULL,
	creation_date DATE NOT NULL,
	PRIMARY KEY (id)
);	
