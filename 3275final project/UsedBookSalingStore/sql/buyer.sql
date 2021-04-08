

DROP TABLE IF EXISTS buyer;
CREATE TABLE buyer (
    buyerId int NOT NULL AUTO_INCREMENT,
    firstName varchar(100) NOT NULL,
    lastName varchar(100) NOT NULL,
    address varchar(200) NOT NULL,
    contactNo varchar(15) NOT NULL,
    gender varchar(10) NOT NULL,
    email varchar(100) NOT NULL,
    password varchar(100),  
    PRIMARY KEY(buyerId)

) ENGINE = InnoDB DEFAULT CHARSET = latin1;

ALTER TABLE buyer AUTO_INCREMENT=1000;



ALTER TABLE
    buyer
ADD UNIQUE (contactNo);

    ALTER TABLE
    patient
ADD UNIQUE (email);
--
-- Dumping data for table `buyer`
--
insert into
    buyer (
        firstName,
        lastName,
        address,
        contactNo,
        gender,
        email
    
    )
values
    (
        'Ashwin',
        'Ashok',
        'Royal Ave',
        '779-544-4457',
        'Male',
        'ashwin@gmail.com'
    ),

    (
        'Jill',
        'Adanez',
        'New Westminster',
        '789-996-3864',
        'Female',
        'jadanez1@aboutads.info'
    );


-- --------------------------------------------------------


