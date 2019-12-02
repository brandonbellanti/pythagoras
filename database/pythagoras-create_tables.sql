CREATE TABLE `composer` (
    comp_id int(10) NOT NULL AUTO_INCREMENT,
    comp_fname varchar(100),
    comp_mname varchar(100),
    comp_lname varchar(100),
    comp_birthyear smallint(4),
    comp_deathyear smallint(4),
    comp_nationality varchar(100),
    PRIMARY KEY (comp_id)
);


CREATE TABLE `work` (
    work_id int(10) NOT NULL AUTO_INCREMENT,
    work_title varchar(255),
    work_identifier varchar(100)
    work_yearbegun smallint(4),
    work_yearcompleted smallint(4),
    work_yearpublished smallint(4),
    work_yearpremiered smallint(4),
    work_partof int(10),
    work_measures int(6),
    work_form varchar(50),
    work_genre varchar(50),
    comp_id int(10),
    era_id int(4),
    PRIMARY KEY (work_id),
    FOREIGN KEY (comp_id) REFERENCES `composer`(comp_id),
    FOREIGN KEY (era_id) REFERENCES `era`(era_id)
);


CREATE TABLE `era` (
    era_id int(4) NOT NULL AUTO_INCREMENT,
    era_name varchar(100),
    era_start smallint(4),
    era_end smallint(4),
    era_period varchar(100),
    PRIMARY KEY (era_id)
);


CREATE TABLE `key` (
    key_id int(4) NOT NULL AUTO_INCREMENT,
    key_name varchar(20),
    key_relative varchar(20),
    key_numaccidentals tinyint(1),
    key_accidentaltype enum('flats','sharps'),
    key_enharmonic varchar(20),
    PRIMARY KEY (key_id)
);


CREATE TABLE `time` (
    time_id int(4) NOT NULL AUTO_INCREMENT,
    time_name varchar(20),
    time_numbeats int(2),
    time_beatval enum ('whole','half','quarter','eighth','sixteenth'),
    PRIMARY KEY (time_id)
);


CREATE TABLE `instrument` (
    instr_id int(4) NOT NULL AUTO_INCREMENT,
    instr_name varchar(100),
    instr_altname varchar(100),
    instr_tuning varchar(20),
    instr_family enum('Woodwind','Brass','String','Percussion','Keyboard'),
    PRIMARY KEY (instr_id)
);


CREATE TABLE `tempo` (
    tempo_id int(4) NOT NULL AUTO_INCREMENT,
    tempo_marking varchar(255),
    tempo_rangestart int(3),
    tempo_rangeend int(3),
    PRIMARY KEY (tempo_id)
);