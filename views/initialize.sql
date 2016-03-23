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

drop table if exists Address;
create table Address
	/*(cid int auto_increment not null,*/
	(street char(150),
   postalCode char(10),
	primary key (street,postalCode),
	foreign key(postalCode) references PostalCodeLocn(postalCode)
	);


drop table if exists Coach;
create table Coach(
	coachId int,
  lName CHAR(30),
  fName CHAR(30),
  primary key (coachID)
	);

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

drop table if exists Season;
create table Season(
  year: int,
  startDate: Date,
  endDate: Date,
  primary key (year)
	);

drop table if exists Arena;
create table Arena(
  arenaName: char(100),
  postalCode: char (10) NOT NULL,
  street: char (150) NOT NULL,
  primary key (arenaName),
  foreign key (postalCode, street) REFERENCES Address (postalCode, street) on update cascade on delete no action
	);

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

drop table if exists Team;
create table Team(
  tName: char(30),
  inauguralYear: Date
  primary key(tName)
	);

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
  foreign key(to,from) REFERENCES Duration(to,from) ON UPDATE CASCADE ON DELETE NO ACTION,
	);

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

drop table if exists Duration;
create table Duration(
  from: Date,
  to: Date,
  PRIMARY KEY (from, to)
	);

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
