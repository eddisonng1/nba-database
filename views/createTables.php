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
    "drop table Address CASCADE CONSTRAINTS",
    "create table Address(
        street char(150),
        postalCode char(10),
        primary key (street,postalCode),
        foreign key(postalCode) references PostalCodeLocn(postalCode)
	)",
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
    "drop table Coach CASCADE CONSTRAINTS",
    "create table Coach(
	  coachId int,
      lName CHAR(30),
      fName CHAR(30),
      primary key (coachId)
      )",
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
    "drop table Season CASCADE CONSTRAINTS",
    "create table Season(
      year int,
      startDate Date,
      endDate Date,
      primary key (year)
	)",
    "drop table Arena CASCADE CONSTRAINTS",
    "create table Arena(
      arenaName char(100),
      postalCode char (10) NOT NULL,
      street char (150) NOT NULL,
      primary key (arenaName),
      foreign key (postalCode, street) REFERENCES Address (postalCode, street)
	)",
    "drop table Team CASCADE CONSTRAINTS",
    "create table Team(
      tName char(30),
      inauguralYear Date,
      primary key(tName)
	)",
    "drop table Duration CASCADE CONSTRAINTS",
    "create table Duration(
      fromDate Date,
      toDate Date,
      PRIMARY KEY (fromDate,toDate)
	)",
    "drop table PlaysFor CASCADE CONSTRAINTS",
    "create table PlaysFor(
      playerId int,
      teamName char(30),
      fromDate Date,
      toDate Date,
      salary int,
      PRIMARY KEY(playerId, teamName, toDate, fromDate),
      foreign key(PlayerId) REFERENCES Player(playerId),
      foreign key(teamName) REFERENCES Team(tName),
      foreign key(toDate,fromDate) REFERENCES Duration(toDate,fromDate)
	)",
    "drop table Coaches CASCADE CONSTRAINTS",
    "create table Coaches(
      coachId int,
      teamName char(30),
      fromDate Date,
      toDate Date,
      salary int,
      PRIMARY KEY(coachId, teamName, toDate, fromDate),
      foreign key (coachId) REFERENCES Coach(coachId),
      foreign key(teamName) REFERENCES Team(tName),
      foreign key(toDate,fromDate) REFERENCES Duration(toDate,fromDate)
	)",
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
    "drop table Watches CASCADE CONSTRAINTS",
    "create table Watches(
      custId int,
      gameId int,
      primary key (custId,gameId),
      foreign key(custId) references Spectator(custId),
      FOREIGN KEY(gameId) REFERENCES GAME(gameId)
	)"
];

foreach ($listOfStartingCommands as &$command){
    echo "<p>$command</p>";
    oci_execute(oci_parse($conn,$command));
}
?>

</html>
