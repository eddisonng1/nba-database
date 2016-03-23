<!DOCTYPE html>
<html>
<h1>Create Tables</h1>
<?php

error_reporting(-1);
ini_set('display_errors',1);

$conn= OCILogon("ora_j7g0b", "a37945136", "ug");

$listOfStartingCommands = [
    "drop table PostalCodeLocn CASCADE CONSTRAINTS",
    "create table PostalCodeLocn(
	  postalCode CHAR(10),
      provinceState CHAR(20),
      city CHAR(50),
      primary key(postalCode)
	)",
    "INSERT INTO PostalCodeLocn VALUES ('V6B 3B5', 'BC', 'Vancouver')",
    "INSERT INTO PostalCodeLocn VALUES ('V5R 3G7', 'BC', 'Vancouver')",
    "INSERT INTO PostalCodeLocn VALUES ('02114', 'MA', 'Boston')",
    "INSERT INTO PostalCodeLocn VALUES ('90015', 'CA', 'Los Angeles')",
    "INSERT INTO PostalCodeLocn VALUES ('33132', 'FL', 'Miami')",
    "INSERT INTO PostalCodeLocn VALUES ('M5J 2X2', 'ON', 'Toronto')",
    "INSERT INTO PostalCodeLocn VALUES ('V5Z 2M9', 'BC', 'Vancouver')",
    "INSERT INTO PostalCodeLocn VALUES ('V5C 2A0', 'BC', 'Vancouver')",
    "INSERT INTO PostalCodeLocn VALUES ('V5L 3X0', 'BC', 'Vancouver')",
    "INSERT INTO PostalCodeLocn VALUES ('V2X 6M2', 'BC', 'Vancouver')",


    "drop table Address CASCADE CONSTRAINTS",
    "create table Address(
        street char(150),
        postalCode char(10),
        primary key (street,postalCode),
        foreign key(postalCode) references PostalCodeLocn(postalCode) ON DELETE CASCADE
	)",

    "INSERT INTO Address VALUES('1234 Main Street', 'V6B 3B5')",
    "INSERT INTO Address VALUES('100 Legends Way', '02114')",
    "INSERT INTO Address VALUES('1111 S Figueroa Street', '90015')",
    "INSERT INTO Address VALUES('601 Biscayne Boulevard', '33132')",
    "INSERT INTO Address VALUES('40 Bay Street', 'M5J 2X2')",
    "INSERT INTO Address VALUES ('3675 East 45th Avenue', 'V5R 3G7')",
    "INSERT INTO Address VALUES ('123 Main Street', 'V5Z 2M9')",
    "INSERT INTO Address VALUES ('123 Ontario Street', 'V5C 2A0')",
    "INSERT INTO Address VALUES ('123 Victoria Drive', 'V5L 3X0')",
    "INSERT INTO Address VALUES ('123 Dumfries Street', 'V2X 6M2')",


    "drop table Player CASCADE CONSTRAINTS",
    "create table Player(
      playerId int,
      height int,
      weight int,
      numberOnBack int,
      fName CHAR(30),
      lName CHAR(30),
      position CHAR(30),
      primary key (playerId)
      )",

    "INSERT INTO Player Values (1, 6.6, 212, 22, 'Kobe', 'Bryant', 'SG')",
    "INSERT INTO Player Values (2, 6.8, 250, 23, 'LeBron', 'James', 'PF')",
    "INSERT INTO Player Values (3, 6.3, 185, 30, 'Stephen', 'Curry', 'PG')",
    "INSERT INTO Player Values (4, 6.9, 240, 35, 'Kevin', 'Durant', 'SF')",
    "INSERT INTO Player Values (5, 6.5, 220, 13, 'James', 'Harden', 'SG')",

    "drop table Coach CASCADE CONSTRAINTS",
    "create table Coach(
	  coachId int,
      lName CHAR(30),
      fName CHAR(30),
      primary key (coachId)
      )",

    "INSERT INTO Coach VALUES (1, 'Kidd', 'Jason')",
    "INSERT INTO Coach VALUES (2, 'Kerr', 'Steve')",
    "INSERT INTO Coach VALUES (3, 'Casey', 'Dwayne')",
    "INSERT INTO Coach VALUES (4, 'Rivers', 'Doc')",
    "INSERT INTO Coach VALUES (5, 'Popovich', 'Gregg')",


    "drop table Spectator CASCADE CONSTRAINTS",
    "create table Spectator(
	  fName CHAR(30),
      lName CHAR(30),
      custId int,
      postalCode CHAR (10) not null,
      street CHAR (150) not null,
      primary key(custId),
      foreign key(postalCode, street) references Address(postalCode, street)
      )",

    "INSERT INTO Spectator VALUES ('Richard', 'Wong', 1, 'V5R 3G7', '3675 East 45th Avenue')",
    "INSERT INTO Spectator VALUES ('Allen', 'Greer', 2, 'V5Z 2M9', '123 Main Street')",
    "INSERT INTO Spectator VALUES ('Eddison', 'Ng', 3, 'V5C 2A0', '123 Ontario Street')",
    "INSERT INTO Spectator VALUES ('Naomi', 'Morcilla', 4, 'V5L 3X0', '123 Victoria Drive')",
    "INSERT INTO Spectator VALUES ('Joanna', 'Lo', 5, 'V2X 6M2', '123 Dumfries Street')",

    "drop table Season CASCADE CONSTRAINTS",
    "create table Season(
      year int,
      startDate Date,
      endDate Date,
      primary key (year)
	)",

    "Insert INTO Season VALUES (2015, to_date('Oct 27, 2015', 'MONTH DD, YYYY'), to_date('June 2, 2016', 'MONTH DD, YYYY'))",
    "Insert INTO Season VALUES (2014, to_date('Oct 28, 2014', 'MONTH DD, YYYY'), to_date('June 4, 2015', 'MONTH DD, YYYY'))",
    "Insert INTO Season VALUES (2013, to_date('Oct 29, 2013', 'MONTH DD, YYYY'), to_date('June 5, 2014', 'MONTH DD, YYYY'))",
    "Insert INTO Season VALUES (2012, to_date('Oct 30, 2012', 'MONTH DD, YYYY'), to_date('June 6, 2013', 'MONTH DD, YYYY'))",
    "Insert INTO Season VALUES (2011, to_date('Dec 25, 2011', 'MONTH DD, YYYY'), to_date('June 21, 2012', 'MONTH DD, YYYY'))",

    "drop table Arena CASCADE CONSTRAINTS",
    "create table Arena(
      arenaName char(100),
      postalCode char (10) NOT NULL,
      street char (150) NOT NULL,
      primary key (arenaName),
      foreign key (postalCode, street) REFERENCES Address (postalCode, street) 
	)",


    "INSERT INTO Arena VALUES ('Rogers Arena', 'V6B 3B5', '1234 Main Street')",
    "INSERT INTO Arena VALUES ('TD Garden', '02114', '100 Legends Way')",
    "INSERT INTO Arena VALUES ('Staples Centre', '90015', '1111 S Figueroa Street')",
    "INSERT INTO Arena VALUES ('American Airlines Arena', '33132', '601 Biscayne Boulevard')",
    "INSERT INTO Arena VALUES ('Air Canada Centre', 'M5J 2X2', '40 Bay Street')",


    "drop table Team CASCADE CONSTRAINTS",
    "create table Team(
      tName char(30),
      inauguralYear Date,
      primary key(tName)
	)",

    "INSERT INTO Team VALUES ('San Antonio Spurs', to_date('1987', 'YYYY'))",
    "INSERT INTO Team VALUES ('Cleveland Cavaliers', to_date('1996', 'YYYY'))",
    "INSERT INTO Team VALUES ('Toronto Raptors', to_date('1975', 'YYYY'))",
    "INSERT INTO Team VALUES ('Golden State Warriors', to_date('1973', 'YYYY'))",
    "INSERT INTO Team VALUES ('Miami Heat', to_date('1984', 'YYYY'))",
    "INSERT INTO Team VALUES('Vancouver Grizzlies', to_date('1987', 'YYYY'))",
    "INSERT INTO Team VALUES ('Boston Celtics', to_date('1966', 'YYYY'))",
    "INSERT INTO Team VALUES ('Chicago Bulls', to_date('1966', 'YYYY'))",
    "INSERT INTO Team VALUES ('Los Angeles Lakers', to_date('1966', 'YYYY'))",

    //  "drop table Duration CASCADE CONSTRAINTS",
//    "create table Duration(
//      fromDate Date,
//      toDate Date,
//      PRIMARY KEY (fromDate,toDate)
//	)",


    "drop table PlaysFor CASCADE CONSTRAINTS",
    "create table PlaysFor(
      playerId int,
      teamName char(30),
      fromDate Date,
      toDate Date,
      salary int,
      PRIMARY KEY(playerId, teamName, toDate, fromDate),
      foreign key(PlayerId) REFERENCES Player(playerId), 
      foreign key(teamName) REFERENCES Team(tName)
	)",

    "INSERT INTO PlaysFor VALUES (1, 'Vancouver Grizzlies', to_date('January 3, 1981', 'MONTH DD, YYYY'), to_date('April 27, 1996', 'MONTH DD, YYYY'), 500000)",
    "INSERT INTO PlaysFor VALUES (2, 'Cleveland Cavaliers',  to_date('September 3, 1984', 'MONTH DD, YYYY'), to_date('February 26, 1996', 'MONTH DD, YYYY'), 5600000)",
    "INSERT INTO PlaysFor VALUES (3, 'Toronto Raptors', to_date('October 3, 1983','MONTH DD, YYYY'), to_date('May 16, 1997','MONTH DD, YYYY'), 1400000)",
    "INSERT INTO PlaysFor VALUES (4, 'Golden State Warriors', to_date('January 3, 2005','MONTH DD, YYYY'), to_date('April 27, 2006','MONTH DD, YYYY'), 2600000)",
    "INSERT INTO PlaysFor VALUES (5, 'Miami Heat', to_date('November 3, 1991','MONTH DD, YYYY'), to_date('June 26, 1993','MONTH DD, YYYY'), 700000)",


    "drop table Coaches CASCADE CONSTRAINTS",
    "create table Coaches(
      coachId int,
      teamName char(30),
      fromDate Date,
      toDate Date,
      salary int,
      PRIMARY KEY(coachId, teamName, toDate, fromDate),
      foreign key (coachId) REFERENCES Coach(coachId),
      foreign key(teamName) REFERENCES Team(tName)
	)",

    "INSERT INTO Coaches VALUES (1, 'Miami Heat', to_date('January 2, 1999', 'MONTH DD, YYYY'),to_date( 'November 5, 2001', 'MONTH DD, YYYY'), 750000)",
    "INSERT INTO Coaches VALUES (2, 'Chicago Bulls', to_date('January 2, 1992', 'MONTH DD, YYYY'), to_date('November 9, 1999','MONTH DD, YYYY'),  2000000)",
    "INSERT INTO Coaches VALUES (3, 'Los Angeles Lakers', to_date('October 20, 2005', 'MONTH DD, YYYY'), to_date('February 25, 2007','MONTH DD, YYYY'),  1250000)",
    "INSERT INTO Coaches VALUES (4, 'San Antonio Spurs', to_date('January 27, 1982', 'MONTH DD, YYYY'), to_date('December 22, 1992','MONTH DD, YYYY'),  3000000)",
    "INSERT INTO Coaches VALUES (5, 'Cleveland Cavaliers', to_date('September 8, 2008', 'MONTH DD, YYYY'), to_date('November 9, 2009','MONTH DD, YYYY'),  1750000)",

    "drop table Game CASCADE CONSTRAINTS",
    "create table Game(
      gameId int,
      winnerTname char(30),
      loserTname char(30),
      arenaName  char(100) NOT NULL,
      winnerScore int,
      loserScore int,
      gameDate date,
      year int NOT NULL,
      primary key (gameId),
      foreign key (winnerTname) references Team(tName),
      foreign key (loserTname) references Team(tName),
      foreign key (arenaName) references Arena(arenaName),
      foreign key (year) references Season(year)
	)",


    "INSERT INTO Game values (1, 'Toronto Raptors', 'Cleveland Cavaliers', 'Air Canada Centre', 110, 92, to_date('February 21, 2016', 'MONTH DD, YYYY'), 2015)",
    "INSERT INTO Game values (2, 'Golden State Warriors', 'Miami Heat', 'American Airlines Arena', 100, 90, to_date('September 15, 2014','MONTH DD, YYYY'),2014)",
    "INSERT INTO Game values (3, 'Los Angeles Lakers', 'Chicago Bulls', 'Staples Centre', 87, 70, to_date('November 5, 2013','MONTH DD, YYYY'), 2013)",
    "INSERT INTO Game values (4, 'San Antonio Spurs', 'Boston Celtics', 'TD Garden', 90, 88, to_date('February 27, 2012','MONTH DD, YYYY'),2011)",
    "INSERT INTO Game values (5, 'Cleveland Cavaliers', 'Vancouver Grizzlies', 'Rogers Arena', 100, 78, to_date('March 20, 2012','MONTH DD, YYYY'),2011)",

    "drop table Performed CASCADE CONSTRAINTS",
    "create table Performed(
      gameId int,
      playerId int,
      points int,
      rebounds int,
      steals int,
      fgPercent int,
      turnover int,
      minutesPlayed int,
      PRIMARY KEY(gameId, playerId),
      FOREIGN KEY(gameId) REFERENCES Game(gameId),
      FOREIGN KEY (playerId) REFERENCES Player(playerId)
	)",

    "INSERT INTO Performed VALUES (1, 1, 20, 5, 1, 30, 1, 10)",
    "INSERT INTO Performed VALUES (1, 2, 24, 5, 2, 20, 2, 20)",
    "INSERT INTO Performed VALUES (2, 3, 25, 2, 0, 50, 1, 30)",
    "INSERT INTO Performed VALUES (3, 4, 50, 3, 1, 77, 3, 23)",
    "INSERT INTO Performed VALUES (3, 5, 46, 4, 2, 34, 2, 12)",

    "drop table Watches CASCADE CONSTRAINTS",
    "create table Watches(
      custId int,
      gameId int,
      primary key (custId,gameId),
      foreign key(custId) references Spectator(custId),
      FOREIGN KEY(gameId) REFERENCES GAME(gameId)
	)",

    "INSERT into Watches VALUES (1, 1)",
    "INSERT into Watches VALUES (2, 2)",
    "INSERT into Watches VALUES (3, 3)",
    "INSERT into Watches VALUES (4, 4)",
    "INSERT into Watches VALUES (5, 5)"
];

foreach ($listOfStartingCommands as &$command){
    echo "<p>$command</p>";
    oci_execute(oci_parse($conn,$command));
}
?>

</html>
