<?php
// Kreiranje nove klase radi lakšeg korištenja
class Database extends SQLite3{
    function __construct(){
        // Kreiranje fajla (baze podataka)
        $this->open('biblioteka.db');
    }
}
// Ekstendovanje klase u objekat za korištenje
$database = new Database;
// Provjera da li postoji fajl i konekcija
if(!$database){
    echo $database->lastErrorMsg();
    die();
}

/*
// Kreiranje tabele za autore
$sql = <<<EOF
CREATE TABLE AUTHOR
(ID INTEGER PRIMARY KEY AUTOINCREMENT,
NAME VARCHAR(50) NOT NULL,
LASTNAME VARCHAR(50) NOT NULL,
CREATED VARCHAR(50));
EOF;

$return = $database->exec($sql);
if(!$return){
    echo $database->lastErrorMsg();
}

// Kreiranje tabele za knjige
$sql = <<<EOF
CREATE TABLE BOOK
(ID INTEGER PRIMARY KEY AUTOINCREMENT,
NAME VARCHAR(100) NOT NULL,
ISBN VARCHAR(20) NOT NULL,
AUTHOR_ID INT NOT NULL, 
CREATED VARCHAR(50),
FOREIGN KEY (AUTHOR_ID) REFERENCES AUTHOR (ID));
EOF;

$return = $database->exec($sql);
if(!$return){
    echo $database->lastErrorMsg();
}

// Kreiranje tabele za korisnike
$sql = <<<EOF
CREATE TABLE USER
(ID INTEGER PRIMARY KEY AUTOINCREMENT,
NAME VARCHAR(50) NOT NULL,
LASTNAME VARCHAR(50) NOT NULL,
PASSWORD VARCHAR(30) NOT NULL,
CREATED VARCHAR(50));
EOF;

$return = $database->exec($sql);
if(!$return){
    echo $database->lastErrorMsg();
}

// Tabela za iznajmljivanje
$sql = <<<EOF
CREATE TABLE RENT
(ID INTEGER PRIMARY KEY AUTOINCREMENT,
USER_ID INT NOT NULL,
BOOK_ID INT NOT NULL,
CREATED VARCHAR(50),
FOREIGN KEY (USER_ID) REFERENCES USER (ID),
FOREIGN KEY (BOOK_ID) REFERENCES BOOK (ID));
EOF;

$return = $database->exec($sql);
if(!$return){
    echo $database->lastErrorMsg();
}
*/

/*
// Insertovanje podataka 
$sql = <<<EOF
INSERT INTO AUTHOR (NAME, LASTNAME, CREATED) VALUES ('Ivo', 'Andrić', '14:04:2021 19:28:31');
EOF;
$return = $database->exec($sql);
if(!$return){
    echo $database->lastErrorMsg();
}

$sql = <<<EOF
INSERT INTO AUTHOR (NAME, LASTNAME, CREATED) VALUES ('Meša', 'Selimović', '14:04:2021 19:29:56');
EOF;
$return = $database->exec($sql);
if(!$return){
    echo $database->lastErrorMsg();
}

$sql = <<<EOF
INSERT INTO USER (NAME, LASTNAME, PASSWORD, CREATED) VALUES ('Bruce', 'Wayne', '1234', '14:04:2021 19:30:41');
EOF;
$return = $database->exec($sql);
if(!$return){
    echo $database->lastErrorMsg();
}

$sql = <<<EOF
INSERT INTO USER (NAME, LASTNAME, PASSWORD, CREATED) VALUES ('Klark', 'Kent', '4321', '14:04:2021 19:30:47');
EOF;
$return = $database->exec($sql);
if(!$return){
    echo $database->lastErrorMsg();
}

$sql = <<<EOF
INSERT INTO USER (NAME, LASTNAME, PASSWORD, CREATED) VALUES ('Peter', 'Parker', '6789', '14:04:2021 19:31:27');
EOF;
$return = $database->exec($sql);
if(!$return){
    echo $database->lastErrorMsg();
}

$sql = <<<EOF
INSERT INTO BOOK (NAME, ISBN, AUTHOR_ID, CREATED) VALUES ('Na Drini ćuprija', '12345678', '1', '14:04:2021 19:33:27');
EOF;
$return = $database->exec($sql);
if(!$return){
    echo $database->lastErrorMsg();
}

$sql = <<<EOF
INSERT INTO BOOK (NAME, ISBN, AUTHOR_ID, CREATED) VALUES ('Tvrđava', '23456789', '2', '14:04:2021 19:34:27');
EOF;
$return = $database->exec($sql);
if(!$return){
    echo $database->lastErrorMsg();
}

$sql = <<<EOF
INSERT INTO RENT (USER_ID, BOOK_ID, CREATED) VALUES ('1', '1', '10:04:2021 19:38:27');
EOF;
$return = $database->exec($sql);
if(!$return){
    echo $database->lastErrorMsg();
}

$sql = <<<EOF
INSERT INTO RENT (USER_ID, BOOK_ID, CREATED) VALUES ('1', '2', '14:04:2021 18:38:27');
EOF;
$return = $database->exec($sql);
if(!$return){
    echo $database->lastErrorMsg();
}

$sql = <<<EOF
INSERT INTO RENT (USER_ID, BOOK_ID, CREATED) VALUES ('2', '1', '24:04:2021 12:38:27');
EOF;
$return = $database->exec($sql);
if(!$return){
    echo $database->lastErrorMsg();
}

$sql = <<<EOF
INSERT INTO RENT (USER_ID, BOOK_ID, CREATED) VALUES ('2', '2', '25:04:2021 11:38:27');
EOF;
$return = $database->exec($sql);
if(!$return){
    echo $database->lastErrorMsg();
}

$sql = <<<EOF
INSERT INTO RENT (USER_ID, BOOK_ID, CREATED) VALUES ('3', '1', '26:04:2021 10:39:27');
EOF;
$return = $database->exec($sql);
if(!$return){
    echo $database->lastErrorMsg();
}
*/

$sql = <<<EOF
SELECT RENT.ID AS ID, AUTHOR.NAME AS AUTHOR_NAME, AUTHOR.LASTNAME AS AUTHOR_LASTNAME, BOOK.NAME AS BOOK_NAME, USER.NAME AS USER_NAME, USER.LASTNAME AS USER_LASTNAME, RENT.CREATED FROM RENT 
INNER JOIN USER ON RENT.USER_ID = USER.ID 
INNER JOIN BOOK ON RENT.BOOK_ID = BOOK.ID
INNER JOIN AUTHOR ON BOOK.AUTHOR_ID = AUTHOR.ID;
EOF;

$result = $database->query($sql);
while($row = $result->fetchArray(SQLITE3_ASSOC)){
    echo "ID: " . $row['ID'] . "<br>";
    echo "AUTHOR: " . $row['AUTHOR_NAME'] . " " . $row['AUTHOR_LASTNAME'] . "<br>";
    echo "BOOK: " . $row['BOOK_NAME'] . "<br>";
    echo "USER: " . $row['USER_NAME'] . " " . $row['USER_LASTNAME'] . "<br>";
    echo "CREATED: " . $row['CREATED'] . "<br><hr>";
}