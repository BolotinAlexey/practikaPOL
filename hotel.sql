SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE Room (
    room_number VARCHAR(10) NOT NULL,
    room_type VARCHAR(50) NOT NULL,
    room_price DECIMAL(10,2) NOT NULL,
    max_occupancy INT NOT NULL,
    available BOOLEAN NOT NULL,
    floor INT NOT NULL,
    PRIMARY KEY (room_number)
);

INSERT INTO Room (room_number, room_type, room_price, max_occupancy, available, floor)
VALUES 
    ('101', 'Single', 100.00, 1, TRUE, 1),
    ('102', 'Double', 150.00, 2, TRUE, 1),
    ('103', 'Suite', 250.00, 4, TRUE, 1),
    ('104', 'Single', 100.00, 1, TRUE, 1),
    ('105', 'Double', 150.00, 2, TRUE, 1),
    ('201', 'Single', 100.00, 1, TRUE, 2),
    ('202', 'Double', 150.00, 2, TRUE, 2),
    ('203', 'Suite', 250.00, 4, TRUE, 2),
    ('204', 'Single', 100.00, 1, TRUE, 2),
    ('205', 'Double', 150.00, 2, TRUE, 2),
    ('301', 'Single', 100.00, 1, TRUE, 3),
    ('302', 'Double', 150.00, 2, TRUE, 3),
    ('303', 'Suite', 250.00, 4, TRUE, 3),
    ('304', 'Single', 100.00, 1, TRUE, 3),
    ('305', 'Double', 150.00, 2, TRUE, 3),
    ('401', 'Single', 100.00, 1, TRUE, 4),
    ('402', 'Double', 150.00, 2, TRUE, 4),
    ('403', 'Suite', 250.00, 4, TRUE, 4),
    ('404', 'Single', 100.00, 1, TRUE, 4),
    ('405', 'Double', 150.00, 2, TRUE, 4);


CREATE TABLE Employee (
    employee_id INT NOT NULL AUTO_INCREMENT,
    employee_name VARCHAR(50) NOT NULL,
    job_title VARCHAR(50) NOT NULL,
    department VARCHAR(50) NOT NULL,
    salary DECIMAL(10,2) NOT NULL,
    hire_date DATE NOT NULL,
    PRIMARY KEY (employee_id)
);

INSERT INTO Employee (employee_name, job_title, department, salary, hire_date)
VALUES 
    ('John Doe', 'Manager', 'Front Desk', 50000.00, '2020-01-01'),
    ('Jane Smith', 'Housekeeper', 'Housekeeping', 25000.00, '2020-02-01'),
    ('David Lee', 'Chef', 'Kitchen', 45000.00, '2020-03-01'),
    ('Sarah Johnson', 'Waiter', 'Restaurant', 15000.00, '2020-04-01'),
    ('Michael Chen', 'Maintenance', 'Facilities', 30000.00, '2020-05-01');


    CREATE TABLE Guest (
    guest_id INT NOT NULL AUTO_INCREMENT,
    guest_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    address VARCHAR(100) NOT NULL,
    PRIMARY KEY (guest_id)
);

INSERT INTO Guest (guest_name, email, phone_number, address)
VALUES 
    ('John Smith', 'john.smith@example.com', '555-1234', '123 Main St, Anytown USA'),
    ('Jane Doe', 'jane.doe@example.com', '555-5678', '456 Maple Ave, Anytown USA'),
    ('David Lee', 'david.lee@example.com', '555-9012', '789 Oak St, Anytown USA'),
    ('Sarah Johnson', 'sarah.johnson@example.com', '555-3456', '101 Elm St, Anytown USA'),
    ('Michael Chen', 'michael.chen@example.com', '555-7890', '222 Cedar Ave, Anytown USA'),
    ('Emily Wilson', 'emily.wilson@example.com', '555-2345', '333 Pine St, Anytown USA'),
    ('Daniel Kim', 'daniel.kim@example.com', '555-6789', '444 Birch Rd, Anytown USA');


CREATE TABLE Reservation (
    reservation_id INT NOT NULL AUTO_INCREMENT,
    guest_id INT NOT NULL,
    room_number INT NOT NULL,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    PRIMARY KEY (reservation_id),
    FOREIGN KEY (guest_id) REFERENCES Guest(guest_id),
    FOREIGN KEY (room_number) REFERENCES Room(room_number)
);

INSERT INTO Reservation (guest_id, room_number, check_in_date, check_out_date)
VALUES 
    (1, 101, '2023-03-20', '2023-03-23'),
    (2, 105, '2023-04-05', '2023-04-08'),
    (3, 110, '2023-05-01', '2023-05-03');

