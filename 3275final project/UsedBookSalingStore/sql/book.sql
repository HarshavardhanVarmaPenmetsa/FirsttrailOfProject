

DROP TABLE IF EXISTS book;
CREATE TABLE book(
    isbn int(5) not null AUTO_INCREMENT PRIMARY KEY,
    sellerId int(3),
    author varchar(20),
    bookName varchar(20),
    price DECIMAL,
    version varchar(20),
    description varchar(100),
    score varchar(10),
    FOREIGN KEY (sellerId) REFERENCES seller(sellerId)
   
   
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--
-- Dumping data for table `book`
--
insert into
    book (
        sellerId,
        author,
        bookName,
        price,
        version,
        description,
        score
        
    )
values
    (
        1,
        'Ashwin Ashok',
        'Sample book',
        19.99,
        '1999-10 edition',
        'For testing',
        '5'
    ),

    (
        2,
        'uuuuuuuu',
        'my book',
        99.99,
        '11th edtion',
        'For project',
        '4'
    );


DROP TABLE IF EXISTS feedback;
CREATE TABLE feedback(
    id int(5) not null AUTO_INCREMENT PRIMARY KEY,
    isbn int,
    buyerName varchar(50),
    comment varchar(500),
    score int(1),
    FOREIGN KEY (isbn) REFERENCES book(isbn)

   
   
) ENGINE = InnoDB DEFAULT CHARSET = latin1;