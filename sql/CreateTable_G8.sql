DROP TABLE IF EXISTS
`Assigned_Locomotive`,`Assigned_Car`, `Assigned_Engineer`, `Assigned_Conductor`,
`Train`, `Locomotive`, `Cars_Location`,`Depot`, `Reservations`, `Car`, `Car_Type`, `join_Con_Eng_Admin`,
`Engineer`, `Conductor`, `On_Site_Personnel`, `Administrator`, `Employee`, `Customer`,
`Authentication`, `User_Logs`, `User`;

CREATE TABLE `User`(
	`user_id` varchar(50) NOT NULL,
	`first_name` varchar(20) NOT NULL,
	`last_name` varchar(20) NOT NULL,
	PRIMARY KEY(`user_id`)
);

CREATE TABLE `User_Logs`(
	`user_id` varchar(50) NOT NULL,
	`action_taken` varchar(255) NOT NULL,
	`action_taken_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`IP_address` varchar(15) NOT NULL,
	PRIMARY KEY(`action_taken_time`),
	FOREIGN KEY (`user_id`) REFERENCES User(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
); 

CREATE TABLE `Authentication`(
	`user_id` varchar(50) NOT NULL,
	`password_hash` varchar(100) NOT NULL,
	`role` varchar(15) NOT NULL,
	PRIMARY KEY(`user_id`),
	CONSTRAINT FOREIGN KEY (`user_id`) REFERENCES User(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
);

##################################################################
CREATE TABLE `Customer`(
	`user_id` varchar(50) NOT NULL,
	`company_id` INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(`company_id`),
	CONSTRAINT FOREIGN KEY(`user_id`) REFERENCES User(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE 
);

CREATE TABLE `Employee`(
	`user_id` varchar(50) NOT NULL,
  	PRIMARY KEY(`user_id`),
  	CONSTRAINT FOREIGN KEY(`user_id`) REFERENCES User(`user_id`)  ON DELETE CASCADE ON UPDATE CASCADE
);

##################################################################
CREATE TABLE `Administrator`(
	`user_id` varchar(50) NOT NULL,
	PRIMARY KEY(`user_id`),
	CONSTRAINT FOREIGN KEY(`user_id`) REFERENCES User(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `On_Site_Personnel`(
	`user_id` varchar(50) NOT NULL,
	`status` varchar(20) NOT NULL,
	PRIMARY KEY(`user_id`),
	CONSTRAINT FOREIGN KEY(`user_id`) REFERENCES User(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
);

##################################################################
CREATE TABLE `Conductor`(
	`user_id` varchar(50) NOT NULL,
	PRIMARY KEY(`user_id`),
	CONSTRAINT FOREIGN KEY(`user_id`) REFERENCES User(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `Engineer`(
	`user_id` varchar(50) NOT NULL,
	`total_hours_traveling` INT NULL,
	`rank` varchar(10) NOT NULL,
	PRIMARY KEY(`user_id`),
	CONSTRAINT FOREIGN KEY(`user_id`) REFERENCES User(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
);

##################################################################
CREATE TABLE `join_Con_Eng_Admin`(
	`user_id` varchar(50) NOT NULL,
	`first_name` varchar(20) NOT NULL,
	`last_name` varchar(20) NOT NULL,
	`password_hash` varchar(100) NOT NULL,
	`role` varchar(10) NOT NULL,
	`status` varchar(20) NULL,
	`rank` varchar(10) NULL,
	`total_hours_traveling` INT NULL,

	PRIMARY KEY(`user_id`),
	CONSTRAINT FOREIGN KEY(`user_id`) REFERENCES User(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
);

##################################################################
CREATE TABLE `Car_Type`(
	`car_type` varchar(40) NOT NULL,
	`car_type_price` DECIMAL(6,2) NOT NULL,
	`capacity` INT NOT NULL,
	PRIMARY KEY(`car_type`)
);

CREATE TABLE `Car`(
	`car_id` varchar(50) NOT NULL,
	`car_type` varchar(30) NOT NULL,
	`is_reserved` boolean NOT NULL,
	PRIMARY KEY(`car_id`),
	CONSTRAINT FOREIGN KEY(`car_type`) REFERENCES Car_Type(`car_type`) ON DELETE CASCADE ON UPDATE CASCADE
);

#################################################################
CREATE TABLE `Reservations`(	
	`car_id` varchar(50) NOT NULL,
	`company_id` INT NOT NULL,
	`reservation_date` DATE,
	`reservation_time` TIME,
	`final_price` DECIMAL(7,2) NOT NULL,
	`departure` varchar(255) NOT NULL,
	`destination` varchar(255) NOT NULL,
	PRIMARY KEY(`car_id`),
	CONSTRAINT FOREIGN KEY(`car_id`) REFERENCES Car(`car_id`) ON DELETE CASCADE ON UPDATE CASCADE
	-- CONSTRAINT FOREIGN KEY(`company_id`) REFERENCES Customer(`company_id`) ON DELETE CASCADE ON UPDATE CASCADE
);

##################################################################
CREATE TABLE `Depot`(
	`depot_location` varchar(50) NOT NULL,
	`x` DOUBLE NOT NULL,
	`y` DOUBLE NOT NULL,
	PRIMARY KEY(`depot_location`)
);

CREATE TABLE `Cars_Location`(
	`car_id` varchar(50) NOT NULL,
	`depot_location` varchar(50) NOT NULL,
	PRIMARY KEY(`car_id`),
	CONSTRAINT FOREIGN KEY(`car_id`) REFERENCES Car(`car_id`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY(`depot_location`) REFERENCES Depot(`depot_location`) ON DELETE CASCADE ON UPDATE CASCADE
);

##################################################################
CREATE TABLE `Locomotive`(
	`locomotive_ID` varchar(50) NOT NULL,
	PRIMARY KEY(`locomotive_ID`)
);

##################################################################
##################################################################
CREATE TABLE `Train`(
	`train_ID` varchar(50) NOT NULL,
	`departure` varchar(255) NOT NULL,
	`destination` varchar(255) NOT NULL,
	`running_days` varchar(10) NOT NULL,
	`hours_traveling` INT NOT NULL,
	`length` int NULL,
	PRIMARY KEY(`train_ID`)
);
##################################################################
##################################################################

##################################################################
CREATE TABLE `Assigned_Conductor`(
	`user_id` varchar(50) NOT NULL,
	`train_ID` varchar(50) NOT NULL,
	PRIMARY KEY(`user_id`, `train_ID`),
	CONSTRAINT FOREIGN KEY(`user_id`) REFERENCES Conductor(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY(`train_ID`) REFERENCES Train(`train_ID`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `Assigned_Engineer`(
	`user_id` varchar(50) NOT NULL,
	`train_ID` varchar(50) NOT NULL,
	PRIMARY KEY(`user_id`, `train_ID`),
	CONSTRAINT FOREIGN KEY(`user_id`) REFERENCES Engineer(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY(`train_ID`) REFERENCES Train(`train_ID`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `Assigned_Car`(
	`car_id` varchar(50) NOT NULL,
	`train_ID` varchar(50) NOT NULL,
	PRIMARY KEY(`car_id`, `train_ID`),
	CONSTRAINT FOREIGN KEY(`car_id`) REFERENCES Car(`car_id`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY(`train_ID`) REFERENCES Train(`train_ID`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `Assigned_Locomotive`(
	`locomotive_ID` varchar(50) NOT NULL,
	`train_ID` varchar(50) NOT NULL,
	PRIMARY KEY(`locomotive_ID`, `train_ID`),
	FOREIGN KEY(`locomotive_ID`) REFERENCES Locomotive(`locomotive_ID`),
	CONSTRAINT FOREIGN KEY(`train_ID`) REFERENCES Train(`train_ID`) ON DELETE CASCADE ON UPDATE CASCADE
);
