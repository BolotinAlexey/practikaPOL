SET
    SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET
    AUTOCOMMIT = 0;

START TRANSACTION;

SET
    time_zone = "+00:00";

CREATE TABLE Room (
    room_number INT NOT NULL,
    room_type VARCHAR(50) NOT NULL,
    room_price DECIMAL(10, 2) NOT NULL,
    max_occupancy INT NOT NULL,
    available BOOLEAN NOT NULL,
    floor INT NOT NULL,
    img VARCHAR(350) NOT NULL,
    PRIMARY KEY (room_number)
);

INSERT INTO
    Room (
        room_number,
        room_type,
        room_price,
        max_occupancy,
        available,
        floor,
        img
    )
VALUES
    (
        101,
        'Single',
        100.00,
        1,
        FALSE,
        1,
        'https://pixabay.com/get/g4f90912c837d5824524743d7fe0a0e1331c9729d8f996ab98b1fe66ee78731cee96ad80be27d4c3d248f2281dfc24a2aaab5e227af83104289dc1691cefbd7b5_1280.jpg'
    ),
    (
        102,
        'Double',
        150.00,
        2,
        TRUE,
        1,
        'https://pixabay.com/get/g2a5b36d3ffad3d749abcfdfdd04cbb99cd8884fa57c295a17d61627fc70263175d1c1c4c9b282ba8f5691643c47cd55e7bdfb2f1cc81ecb1a0901acb9b1ac07d_1280.jpg'
    ),
    (
        103,
        'Suite',
        250.00,
        4,
        TRUE,
        1,
        'https:/pixabay.com/get/g3bee18734e02f532acf4ef1087afc8de5d759bc5fd7fa8d3de82559fa7133693c5776cf99dfee145f96fd96b5d404f34d95d6f190e5b0739c7497e19b0304be9_1280.jpg'
    ),
    (
        104,
        'Single',
        100.00,
        1,
        TRUE,
        1,
        'https://pixabay.com/get/g73e36cccada5e64926d7e90da5a558a8dab54d9865ad40afbff8887f016bea7d27196379a0d57d0664327c0567dd5d50cf2c07cc020a31ebbc017e988bc342bf_1280.jpg'
    ),
    (
        105,
        'Double',
        150.00,
        2,
        FALSE,
        1,
        'https://pixabay.com/get/g3b0ae829793f3cab7eeac26e40c0cb081c9b9e2162323c686ad493af405465676496cfcf804489120bf8b52a6f4cfde4474827e241321a2e6fcc949d95241aed_1280.jpg'
    ),
    (
        201,
        'Single',
        100.00,
        1,
        TRUE,
        2,
        'https://pixabay.com/get/gcbc97664c16a9ab367bbb346ea377278936936345867d89044a60877bbe838df61fb95d4b4c1283a97256b2499a254a26e3200f82bb0dd9c5c7646bc5c7fbc29_1280.jpg'
    ),
    (
        202,
        'Double',
        150.00,
        2,
        TRUE,
        2,
        'https://pixabay.com/get/gfcce1c3988e7c064e7c76c7644037cf3aa667e22059a61bd476178fab12ae7734e941e723a4a3122b2595b1c09cc24342ad5b7f1f4e7290464cf394185262116_1280.jpg'
    ),
    (
        203,
        'Suite',
        250.00,
        4,
        FALSE,
        2,
        'https://pixabay.com/get/gcff23608d08b77a8d302d032ea192cffcf2b8410b4a4a8f0de7ac1da7b3f2f27b1c0d32ca1f210799a4d879f2d43080fa7fa9d3aaf1a1a3b94567079c4b4f896_1280.jpg'
    ),
    (
        204,
        'Single',
        100.00,
        1,
        TRUE,
        2,
        'https://pixabay.com/get/g89e2b91aade6aa6890e996e92bf9bccd95b29f7fa3a2e29f8ab7bc26f93c66767ea17ad8907a45f0b5761eaaecadb60dfc9acb2e325a1e550dc9ffe98eaaf1a0_1280.jpg'
    ),
    (
        205,
        'Double',
        150.00,
        2,
        TRUE,
        2,
        'https://pixabay.com/get/gcf41ee2524249299037283db9a9844fb1eb6531ec736b203f3b42d976f6d23c6131f9661b8d83b0266857a6908f50df6bbf0c053a359844ea25b00dd19b61afd_1280.jpg'
    ),
    (
        301,
        'Single',
        100.00,
        1,
        TRUE,
        3,
        'https://pixabay.com/get/g7fe8265626c8e8f94282ad28a5344d2fb2049651b57dbbbb82a97f2124b5c54066c1dedbff0c53512ddc17d1133ed2ae0d5801f975f5405c4e6a5e2dd660ac0b_1280.jpg'
    ),
    (
        302,
        'Double',
        150.00,
        2,
        TRUE,
        3,
        'https://pixabay.com/get/g357262fd7c6d73095f01070dcc95e7f3987bcd3e39bcbd8eec2102c0e00feee09b3e5d8a2cca86ff9a2385674b53fc6d14f5409be4080291e075d96527e15c67_1280.jpg'
    ),
    (
        303,
        'Suite',
        250.00,
        4,
        TRUE,
        3,
        'https://pixabay.com/get/gb82459923ee8687019a63296c6c54f5bdcd3adabfe2ef5b72142b1cf4a4004f27401b94b9d140f30f1d4cd56b417e7471e5115c6efa11da0962e66fb8e807c99_1280.jpg'
    ),
    (
        304,
        'Single',
        100.00,
        1,
        TRUE,
        3,
        'https://pixabay.com/get/gc28c83ee771d56423bcff783f82ab970ab3276fdce5ca61c4dbfed04e3cff3b03d3eccc05e6dcade4494e0399fd0d125d9768a49eaa91678b5007f97acb468a2_1280.jpg'
    );

CREATE TABLE Guests (
    guest_id INT NOT NULL AUTO_INCREMENT,
    guest_name VARCHAR(50) NOT NULL,
    guest_email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    address VARCHAR(100) NOT NULL,
    PRIMARY KEY (guest_id)
);

INSERT INTO
    Guests (guest_name, guest_email, phone_number, address)
VALUES
    (
        'John Smith',
        'john.smith@example.com',
        '555-1234',
        '123 Main St, Anytown USA'
    ),
    (
        'Jane Doe',
        'jane.doe@example.com',
        '555-5678',
        '456 Maple Ave, Anytown USA'
    ),
    (
        'David Lee',
        'david.lee@example.com',
        '555-9012',
        '789 Oak St, Anytown USA'
    ),
    (
        'Sarah Johnson',
        'sarah.johnson@example.com',
        '555-3456',
        '101 Elm St, Anytown USA'
    ),
    (
        'Michael Chen',
        'michael.chen@example.com',
        '555-7890',
        '222 Cedar Ave, Anytown USA'
    ),
    (
        'Emily Wilson',
        'emily.wilson@example.com',
        '555-2345',
        '333 Pine St, Anytown USA'
    ),
    (
        'Daniel Kim',
        'daniel.kim@example.com',
        '555-6789',
        '444 Birch Rd, Anytown USA'
    );

CREATE TABLE Reservation (
    reservation_id INT NOT NULL AUTO_INCREMENT,
    guest_id INT NOT NULL,
    room_number INT NOT NULL,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    PRIMARY KEY (reservation_id),
    FOREIGN KEY (guest_id) REFERENCES Guests(guest_id),
    FOREIGN KEY (room_number) REFERENCES Room(room_number)
);

INSERT INTO
    Reservation (
        guest_id,
        room_number,
        check_in_date,
        check_out_date
    )
VALUES
    (5, 101, '2023-03-20', '2023-03-23'),
    (6, 105, '2023-04-05', '2023-04-08'),
    (7, 203, '2023-05-01', '2023-05-03');

CREATE TABLE Employee (
    employee_id INT NOT NULL AUTO_INCREMENT,
    employee_name VARCHAR(50) NOT NULL,
    job_title VARCHAR(50) NOT NULL,
    department VARCHAR(50) NOT NULL,
    salary DECIMAL(10, 2) NOT NULL,
    hire_date DATE NOT NULL,
    PRIMARY KEY (employee_id)
);

INSERT INTO
    Employee (
        employee_name,
        job_title,
        department,
        salary,
        hire_date
    )
VALUES
    (
        'John Doe',
        'Manager',
        'Front Desk',
        50000.00,
        '2020-01-01'
    ),
    (
        'Jane Smith',
        'Housekeeper',
        'Housekeeping',
        25000.00,
        '2020-02-01'
    ),
    (
        'David Lee',
        'Chef',
        'Kitchen',
        45000.00,
        '2020-03-01'
    ),
    (
        'Sarah Johnson',
        'Waiter',
        'Restaurant',
        15000.00,
        '2020-04-01'
    ),
    (
        'Michael Chen',
        'Maintenance',
        'Facilities',
        30000.00,
        '2020-05-01'
    );

CREATE TABLE aa (
    reservation_id INT NOT NULL AUTO_INCREMENT,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    PRIMARY KEY (reservation_id)
);

INSERT INTO
    aa (check_in_date, check_out_date)
VALUES
    ('2023-03-20', '2023-03-23'),
    ('2023-04-05', '2023-04-08'),
    ('2023-05-01', '2023-05-03');

-- ---------------------------------------------------