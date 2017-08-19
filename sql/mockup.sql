############################# create users ##########################
-- delete all rows in a table without deleting the table
DELETE FROM User;

-- Insert each classes into the "User" table
INSERT INTO `User` (user_id, first_name, last_name)
VALUES ("admin", "bill", "bob");

INSERT INTO `User` (user_id, first_name, last_name)
VALUES ("admin2", "bill2", "bob2");

INSERT INTO `User` (user_id, first_name, last_name)
VALUES ("engineer1", "ben1", "ben1");
INSERT INTO `User` (user_id, first_name, last_name)
VALUES ("engineer4", "ben4", "ben4");

INSERT INTO `User` (user_id, first_name, last_name)
VALUES ("conductor1", "smith1", "smith1");

INSERT INTO `User` (user_id, first_name, last_name)
VALUES ("customer1", "ken1", "ken1");
INSERT INTO `User` (user_id, first_name, last_name)
VALUES ("customer2", "ken1", "ken1");

##################################################################################
INSERT INTO `User_Logs`(user_id, action_taken, action_taken_time, IP_address)
VALUES ("")

##################################################################################
DELETE FROM Authentication;

INSERT INTO `Authentication` (user_id, password_hash, role)
VALUES ("admin", "$2y$10$l.rtH.R6c7JS1z3ZNvmUf.Qlb9gcYQMalMFKGvHyW6MrYEW0I2nfK", "admin"); 

INSERT INTO `Authentication` (user_id, password_hash, role)
VALUES ("admin2", "admin2", "employee"); 

INSERT INTO `Authentication` (user_id, password_hash, role)
VALUES ("engineer1", "engineer1", "employee"); 
INSERT INTO `Authentication` (user_id, password_hash, role)
VALUES ("engineer4", "engineer4", "employee"); 

INSERT INTO `Authentication` (user_id, password_hash, role)
VALUES ("conductor1", "conductor1", "employee"); 

INSERT INTO `Authentication` (user_id, password_hash, role)
VALUES ("customer1", "customer1", "customer"); 
INSERT INTO `Authentication` (user_id, password_hash, role)
VALUES ("customer2", "customer2", "customer"); 

##################################################################################
DELETE FROM Customer;

INSERT INTO `Customer` (user_id, company_id) 
VALUES ("customer1", "1");
INSERT INTO `Customer` (user_id, company_id) 
VALUES ("customer2", "2");

##################################################################################
DELETE FROM Employee; -- delete all rows in a table without deleting the table

-- Insert each classes into the "Employee" table
INSERT INTO `Employee` (user_id)
VALUES ('admin');

INSERT INTO `Employee` (user_id)
VALUES ('admin2');

INSERT INTO `Employee` (user_id)
VALUES ('engineer1');
INSERT INTO `Employee` (user_id)
VALUES ('engineer4');

INSERT INTO `Employee` (user_id)
VALUES ('conductor1');

##################################################################################
DELETE FROM Administrator; 

INSERT INTO `Administrator` (user_id) VALUES 
	(  (SELECT user_id from User WHERE user_id='admin'));

INSERT INTO `Administrator` (user_id) VALUES 
	(  (SELECT user_id from User WHERE user_id='admin2') );


##################################################################################
DELETE FROM On_Site_Personnel;

INSERT INTO `On_Site_Personnel` (user_id, status) VALUES 
	(  'engineer1', 'Inactive');

INSERT INTO `On_Site_Personnel` (user_id, status) 
VALUES ( 'conductor1', 'Active');

INSERT INTO `On_Site_Personnel` (user_id, status) 
VALUES (  'engineer4', 'Active');

##################################################################################
DELETE FROM Conductor; 

INSERT INTO `Conductor` (user_id) 
VALUES (  'conductor1');


##################################################################################

DELETE FROM Engineer; 
INSERT INTO `Engineer` (user_id, total_hours_traveling, rank)
VALUES ("engineer1", NULL, "junior");
INSERT INTO `Engineer` (user_id, total_hours_traveling, rank)
VALUES ("engineer4", NULL, "junior");

##################################################################################
DELETE FROM join_Con_Eng_Admin;

INSERT INTO `join_Con_Eng_Admin` (user_id, first_name, last_name, password_hash, role, status, rank, total_hours_traveling)
VALUES ("conductor1", 
	(SELECT first_name from `User` WHERE user_id='conductor1'),
	(SELECT last_name from `User` WHERE user_id='conductor1'),
	(SELECT password_hash from `Authentication` WHERE user_id='conductor1'),
	(SELECT role from `Authentication` WHERE user_id='conductor1'),
	(SELECT status from `On_Site_Personnel` WHERE user_id='conductor1'),
	(SELECT rank from `Engineer` WHERE user_id='conductor1'),
	(SELECT total_hours_traveling from `Engineer` WHERE user_id='conductor1')
);

INSERT INTO join_Con_Eng_Admin (user_id, first_name, last_name, password_hash, role, status, rank, total_hours_traveling)
VALUES ("engineer4", 
	(SELECT first_name from User WHERE user_id='engineer4'),
	(SELECT last_name from User WHERE user_id='engineer4'),
	(SELECT password_hash from `Authentication` WHERE user_id='engineer4'),
	(SELECT role from `Authentication` WHERE user_id='engineer4'),
	(SELECT status from `On_Site_Personnel` WHERE user_id='engineer4'),
	(SELECT rank from `Engineer` WHERE user_id='engineer1'),
	(SELECT total_hours_traveling from `Engineer` WHERE user_id='engineer4')
);

INSERT INTO `join_Con_Eng_Admin` (user_id, first_name, last_name, password_hash, role, status, rank, total_hours_traveling)
VALUES ("admin", 
	(SELECT first_name from `User` WHERE user_id='admin'),
	(SELECT last_name from `User` WHERE user_id='admin'),
	(SELECT password_hash from `Authentication` WHERE user_id='admin'),
	(SELECT role from `Authentication` WHERE user_id='admin'),
	(SELECT status from `On_Site_Personnel` WHERE user_id='admin'),
	(SELECT rank from `Engineer` WHERE user_id='admin'),
	(SELECT total_hours_traveling from `Engineer` WHERE user_id='admin')
);

##################################################################################
DELETE FROM Depot; 
INSERT INTO `Car_type` (depot_location)
VALUES ('Missouri');
##### how can you differentiate  


DELETE FROM Car_Type; 
INSERT INTO `Car_Type` (car_type, car_type_price, capacity)
VALUES ('flatbed','100.0', '100');
INSERT INTO `Car_Type` (car_type, car_type_price, capacity)
VALUES ('grain car','200.0', '200');
INSERT INTO `Car_Type` (car_type, car_type_price, capacity)
VALUES ('coal car','300.0', '300');
INSERT INTO `Car_Type` (car_type, car_type_price, capacity)
VALUES ('hopper','400.0', '400');


DELETE FROM Locomotive_Type; 
INSERT INTO `Locomotive_Type` (locomotive_type)
VALUES ('gasoline');
#################################################################################
DELETE FROM Car; 
INSERT INTO `Car` (car_id, car_type, is_reserved)
VALUES ('1','flatbed','0');

DELETE FROM Locomotive; 
INSERT INTO `Locomotive` (locomotive_ID, locomotive_type, depot_location)
VALUES ('1','Gasoline','Missouri');

##################################################################################
DELETE FROM Train; 

INSERT INTO `Train` (train_ID, departure, destination, running_days, hours_traveling)
VALUES ('1', 'Missouri', 'Kansas', 'MWF', '4');



