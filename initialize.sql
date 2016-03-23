drop database if exists NBA;

create database NBA;

use NBA;

drop table if exists PostalCodeLocn;
create table PostalCodeLocn(
	postalCode CHAR(10),
  provinceState CHAR(20),
  city CHAR(50),
  primary key(Postal Code),
	);

INSERT INTO PostalCodeLocn VALUES ('V6B 3B5', 'BC', 'Vancouver');
INSERT INTO PostalCodeLocn VALUES ('V5R 3G7', 'BC', 'Vancouver');
INSERT INTO PostalCodeLocn VALUES ('02114', 'MA', 'Boston');
INSERT INTO PostalCodeLocn VALUES ('90015', 'CA', 'Los Angeles');
INSERT INTO PostalCodeLocn VALUES ('33132', 'FL', 'Miami');
INSERT INTO PostalCodeLocn VALUES ('M5J 2X2', 'ON', 'Toronto');


drop table if exists Address;
create table Address
	/*(cid int auto_increment not null,*/
	(street char(150),
   postalCode char(10),
	primary key (street,postalCode),
	foreign key(postalCode) references PostalCodeLocn(postalCode)
	);

INSERT INTO Address VALUES('1234 Main Street', 'V6B 3B5');
INSERT INTO Address VALUES('100 Legends Way', '02114');
INSERT INTO Address VALUES('1111 S Figueroa Street', '90015');
INSERT INTO Address VALUES('601 Biscayne Boulevard', '33132');
INSERT INTO Address VALUES('40 Bay Street', 'M5J 2X2');
INSERT INTO Address VALUES ('3674 East 45th Avenue', 'V5R 3G7');

drop table if exists Coach;
create table Coach(
	coachId int,
  lName CHAR(30),
  fName CHAR(30),
  primary key (coachID)
	);

INSERT INTO Coach VALUES (1, 'Kidd', 'Jason');
INSERT INTO Coach VALUES (2, 'Kerr', 'Steve');
INSERT INTO Coach VALUES (3, 'Casey', 'Dwayne');
INSERT INTO Coach VALUES (4, 'Rivers', 'Doc');
INSERT INTO Coach VALUES (5, 'Popovich', 'Gregg');

drop table if exists Player;
create table Player(
	playerId INT,
  height FLOAT,
  weight FLOAT,
  number INT,
  fName CHAR(30),
  lName CHAR(30),
  position CHAR(5),
  primary key (playerId)
	);

INSERT INTO Player Values (1, 6.6, 212, 22, 'Kobe', 'Bryant', 'SG');
INSERT INTO Player Values (2, 6.8, 250, 23, 'LeBron', 'James', 'PF');
INSERT INTO Player Values (3, 6.3, 185, 30, 'Stephen', 'Curry', 'PG');
INSERT INTO Player Values (4, 6.9, 240, 35, 'Kevin', 'Durant', 'SF');
INSERT INTO Player Values (5, 6.5, 220, 13, 'James', 'Harden', 'SG');

drop table if exists Spectator;
create table Spectator(
	fName: char(30),
  lName: char(30),
  custId: int,
  postalCode: char (10) not null,
  street: char (150) not null,
  primary key(custId),
  foreign key(postalCode, street) references Address(postalCode, Street) on update cascade on delete no action
	);

INSERT INTO Spectator VALUES ('Richard', 'Wong', 1, 'V5R 3G7', '3675 East 45th Avenue');


drop table if exists Season;
create table Season(
  year: int,
  startDate: Date,
  endDate: Date,
  primary key (year)
	);

Insert INTO Season VALUES (2015, 'Oct 27, 2015', 'June 2, 2016')
Insert INTO Season VALUES (2014, 'Oct 28, 2014', 'June 4, 2015');
Insert INTO Season VALUES (2013, 'Oct 29, 2013', 'June 5, 2014');
Insert INTO Season VALUES (2012, 'Oct 30, 2012', 'June 6, 2013');
Insert INTO Season VALUES (2011, 'Dec 25, 2011', 'June 21, 2012');

drop table if exists Arena;
create table Arena(
  arenaName: char(100),
  postalCode: char (10) NOT NULL,
  street: char (150) NOT NULL,
  primary key (arenaName),
  foreign key (postalCode, street) REFERENCES Address (postalCode, street) on update cascade on delete no action
	);

INSERT INTO Arena VALUES ('Rogers Arena', 'V6B 3B5', '1234 Main Street');
INSERT INTO Arena VALUES ('TD Garden', '02114', '100 Legends Way');
INSERT INTO Arena VALUES ('Staples Centre', '90015', '1111 S Figueroa Street');
INSERT INTO Arena VALUES ('American Airlines Arena', '33132', '601 Biscayne Boulevard');
INSERT INTO Arena VALUES ('Air Canada Centre', 'M5J 2X2', '40 Bay Street');


drop table if exists Game;
create table Game(
  gameId: int,
  winnerTname: char(30),
  loserTname: char(30),
  arenaName : char(100) NOT NULL,
  winnerScore: int,
  loserScore :int,
  date: date,
  year: int NOT NULL,
  primary key (gameId),
  foreign key (winnerTname) references Team(tName) on delete no action on update no action,
  foreign key (loserTname) references Team(tName) on delete no action on update no action,
  foreign key (arenaName) references Arena(arenaName) on update cascade on delete no action,
  foreign key (year) references Season(year) on delete no action on update no action
	);

INSERT INTO Game values (1, 'Toronto Raptors', 'Cleveland Cavaliers', 'Air Canada Centre', 110, 92, 'February 21, 2016', 2015);
INSERT INTO Game values (2, 'Golden State Warriors', 'Miami Heat', 'American Airlines Arena', 100, 90, 'September 15, 2014', 2014);
INSERT INTO Game values (3, 'Los Angeles Lakers', 'Chicago Bulls', 'Staples Centre', 87, 70, 'November 5, 2013', 2013);
INSERT INTO Game values (4, 'San Antonio Spurs', 'Boston Celtics', 'TD Garden', 90, 88, 'February 27, 2012', 2011);
INSERT INTO Game values (5, 'Cleveland Cavaliers', 'Vancouver Grizzlies', 'Rogers Arena', 100, 78, 'March 20, 2011', 2010);

drop table if exists Watches;
create table Watches(
  custId: int,
  gameId: int,
  primary key (custId,gameId),
  foreign key(custId) references Spectator(custId),
  on delete cascade,
  on update cascade,
  FOREIGN KEY(gameId) REFERENCES GAME(gameId) on delete cascade on update cascade
	);

INSERT into Watches VALUES (1, 1);
INSERT into Watches VALUES (2, 2);
INSERT into Watches VALUES (3, 3);
INSERT into Watches VALUES (4, 4);
INSERT into Watches VALUES (5, 5);

drop table if exists Team;
create table Team(
  tName: char(30),
  inauguralYear: Date
  primary key(tName)
	);

INSERT INTO Team VALUES ('San Antonio Spurs', 1/1/1987);
INSERT INTO Team VALUES ('Cleveland Cavaliers', 1/1/1966);
INSERT INTO Team VALUES ('Toronto Raptors', 1/1/1975);
INSERT INTO Team VALUES ('Golden State Warriors', 1/1/1973);
INSERT INTO Team VALUES ('Miami Heat', 1/1/1984);
INSERT INTO Team VALUES('Vancouver Grizzlies', 1/1/1987);
INSERT INTO Team VALUES ('Boston Celtics', 1/1/1966);

drop table if exists PlaysFor;

create table PlaysFor(
  playerId: int,
  teamName: char(30),
  from: Date,
  to: Date,
  salary: int,
  PRIMARY KEY(playerId, teamName, to, from),
  foreign key(PlayerId) REFERENCES Player(playerId) ON UPDATE CASCADE ON DELETE NO ACTION,
  foreign key(teamName) REFERENCES Team(tName) ON UPDATE CASCADE ON DELETE NO ACTION,
  foreign key(to,from) REFERENCES Duration(to,from) ON UPDATE CASCADE ON DELETE NO ACTION
	);

INSERT INTO PlaysFor VALUES (1, 'Vancouver Grizzlies', 'January 3, 1981', 'April 27, 1996', 500000);
INSERT INTO PlaysFor VALUES (2, 'Cleveland Cavaliers', 'September 3, 1984', 'February 26, 1996', 5600000);
INSERT INTO PlaysFor VALUES (3, 'Toronto Raptors', 'October 3, 1983', 'May 16, 1997', 1400000);
INSERT INTO PlaysFor VALUES (4, 'Golden State Warriors', 'January 3, 2005', 'April 27, 2006', 2600000);
INSERT INTO PlaysFor VALUES (5, 'Miami Heat', 'November 3, 1991', 'June 26, 1993', 700000);


drop table if exists Coaches;
create table Coaches(
  coachId: int,
  teamName: char(30),
  from: Date,
  to: Date,
  salary: int,
  PRIMARY KEY(coachId, teamName, to, from),
  foreign key (coachId) REFERENCES Coach(coachId) ON UPDATE CASCADE ON DELETE NO ACTION,
  foreign key(teamName) REFERENCES Team(tName) ON UPDATE CASCADE ON DELETE NO ACTION,
  foreign key(to,from) REFERENCES Duration(to,from) ON UPDATE CASCADE ON DELETE NO ACTION
	);

INSERT INTO Coaches VALUES (1, 'Miami Heat', 'January 2, 1999', 'November 5, 2001', 750000);
INSERT INTO Coaches VALUES (2, 'Chicago Bulls', 'January 2, 1992', 'November 9, 1999', 2000000);
INSERT INTO Coaches VALUES (3, 'Los Angeles Lakers', 'October 20, 2005', 'February 30, 2007', 1250000);
INSERT INTO Coaches VALUES (4, 'San Antonio Spurs', 'January 27, 1982', 'December 22, 1992', 3000000);
INSERT INTO Coaches VALUES (5, 'Cleveland Cavaliers', 'September 8, 2008', 'November 9, 2009', 1750000);

drop table if exists Duration;
create table Duration(
  from: Date,
  to: Date,
  PRIMARY KEY (from, to)
	);

INSERT INTO Duration VALUES ('January 2, 1999', 'November 5, 2001');
INSERT INTO Duration VALUES ('January 2, 1992', 'November 9, 1999');
INSERT INTO Duration VALUES ('October 20, 2005', 'February 30, 2007');
INSERT INTO Duration VALUES ('January 27, 1982', 'December 22, 1992');
INSERT INTO Duration VALUES ('September 8, 2008', 'November 9, 2009');

INSERT INTO Duration VALUES ('January 3, 1981', 'April 27, 1996');
INSERT INTO Duration VALUES ('September 3, 1984', 'February 26, 1996');
INSERT INTO Duration VALUES ('October 3, 1983', 'May 16, 1997');
INSERT INTO Duration VALUES ('January 3, 2005', 'April 27, 2006');
INSERT INTO Duration VALUES ('November 3, 1991', 'June 26, 1993');


drop table if exists Performed;
create table Performed(
  gameId: int,
  playerId: int,
  points: int,
  rebounds: int,
  steals: int,
  fgPercent: int,
  turnover: int,
  minutesPlayed: int,
  PRIMARY KEY(gameId, playerId),
  FOREIGN KEY(gameId) REFERENCES Game(gameId) ON UPDATE CASCADE ON DELETE NO ACTION,
  FOREIGN KEY (playerId) REFERENCES Player(playerId) ON UPDATE CASCADE ON DELETE NO ACTION
	);

INSERT INTO Performed VALUES (1, 1, 20, 5, 1, 30, 1, 10);
INSERT INTO Performed VALUES (1, 2, 24, 5, 2, 20, 2, 20);
INSERT INTO Performed VALUES (2, 3, 25, 2, 0, 50, 1, 30);
INSERT INTO Performed VALUES (3, 4, 50, 3, 1, 77, 3, 23);
INSERT INTO Performed VALUES (3, 5, 46, 4, 2, 34, 2, 12);
