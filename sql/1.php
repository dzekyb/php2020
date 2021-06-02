<?php
class Database extends SQLite3{
    function __construct(){
        $this->open('test.db');
    }
}

$database = new Database;
if(!$database){
    echo $database->lastErrorMsg();
}else{
    #echo "Database is opened.";
}

/* Kreiranje nove tabele
$sql = <<<EOF
CREATE TABLE COMPANY
(ID INT PRIMARY KEY NOT NULL,
NAME TEXT NOT NULL,
AGE INT NOT NULL,
ADDRESS CHAR(50),
SALARY REAL);
EOF;


$return = $database->exec($sql);
if(!$return){
    echo $database->lastErrorMsg();
}else{
    echo "Table Created";
}
*/

/* Novi unos u tabelu/bazu
$sql = <<<EOF
INSERT INTO COMPANY
(ID, NAME, AGE, ADDRESS, SALARY) VALUES (1, 'Paul', 32, 'California', 20000.00);
EOF;

$return = $database->exec($sql);
if(!$return){
    echo $database->lastErrorMsg();
}else{
    echo "Records created!";
}
*/

/* Update tabele
$sql = <<<EOF
UPDATE COMPANY SET SALARY = 25000.00 WHERE ID = 1;
EOF;

$return = $database->exec($sql);
if(!$return){
    echo $database->lastErrorMsg();
}else{
    echo $database->changes() . "record updated!";
}
*/

/* Brisanje podataka iz tabele
$sql = <<<EOF
DELETE FROM COMPANY WHERE ID=2;
EOF;

$return = $database->exec($sql);
if(!$return){
    echo $database->lastErrorMsg();
}else{
    echo $database->changes() . " record deleted!";
}
*/

$sql = <<<EOF
SELECT * FROM COMPANY;
EOF;

$return = $database->query($sql);
while($row = $return->fetchArray(SQLITE3_ASSOC)){
    echo "ID: " . $row['ID'] . "<br>" .
         "NAME: " . $row['NAME'] . "<br>" .
         "ADDRESS: " . $row['ADDRESS'] . "<br>".
         "SALARY: " . $row['SALARY'] . "<br>";
}