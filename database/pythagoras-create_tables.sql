CREATE TABLE `composer` (
    comp_id int(11) NOT NULL AUTO_INCREMENT,
    comp_fname varchar(100),
    comp_mname varchar(100),
    comp_lname varchar(100) NOT NULL,
    comp_birthyear smallint(4),
    comp_deathyear smallint(4),
    comp_nationality varchar(100),
    comp_wiki varchar(255),
    comp_imslp varchar(255),
    comp_viaf varchar(255),
    PRIMARY KEY (comp_id)
);

CREATE TABLE `era` (
    era_id int(11) NOT NULL AUTO_INCREMENT,
    era_name varchar(100) NOT NULL,
    era_start smallint(4),
    era_end smallint(4),
    era_period varchar(100),
    PRIMARY KEY (era_id)
);

CREATE TABLE `composer_era` (
    comp_id int(11) NOT NULL,
    era_id int(11) NOT NULL,
    FOREIGN KEY (comp_id) REFERENCES composer(comp_id),
    FOREIGN KEY (era_id) REFERENCES era(era_id)
);

CREATE TABLE `work` (
    work_id int(11) NOT NULL AUTO_INCREMENT,
    work_title varchar(255) NOT NULL,
    work_alttitle varchar(255),
    work_opus varchar(20),
    work_identifier varchar(20),
    work_mvtitle varchar(255),
    work_mvnumber int(2),
    work_yearbegun smallint(4),
    work_yearcompleted smallint(4),
    work_yearpublished smallint(4),
    work_yearpremiered smallint(4),
    work_relatedto int(11),
    work_measures int(6),
    work_genre varchar(50),
    work_form varchar(50),
    work_note text,
    work_wiki varchar(255),
    work_imslp varchar(255),
    work_viaf varchar(255),
    comp_id int(11),
    era_id int(11),
    PRIMARY KEY (work_id),
    FOREIGN KEY (work_relatedto) REFERENCES `work`(work_id),
    FOREIGN KEY (comp_id) REFERENCES `composer`(comp_id),
    FOREIGN KEY (era_id) REFERENCES `era`(era_id)
);

CREATE TABLE `key` (
    key_id int(11) NOT NULL AUTO_INCREMENT,
    key_name varchar(20) NOT NULL,
    key_relative int(11) NOT NULL,
    key_accnum int(1) NOT NULL,
    key_acctype enum('flat','sharp'),
    key_enharmonic int(11),
    PRIMARY KEY (key_id),
    FOREIGN KEY (key_relative) REFERENCES `key`(key_id),
    FOREIGN KEY (key_enharmonic) REFERENCES `key`(key_id)
);

CREATE TABLE `work_key` (
    work_id int(11) NOT NULL,
    key_id int(11) NOT NULL,
    key_startmeasure int(6),
    FOREIGN KEY (work_id) REFERENCES `work`(work_id),
    FOREIGN KEY (key_id) REFERENCES `key`(key_id)
);

CREATE TABLE `time` (
    time_id int(11) NOT NULL AUTO_INCREMENT,
    time_name varchar(20) NOT NULL,
    time_numbeats varchar(20),
    time_beatval enum ('whole','half','quarter','eighth','sixteenth'),
    time_type enum ('simple','complex','compound'),
    PRIMARY KEY (time_id)
);

CREATE TABLE `work_time` (
    work_id int(11) NOT NULL,
    time_id int(11) NOT NULL,
    time_startmeasure int(6),
    FOREIGN KEY (work_id) REFERENCES `work`(work_id),
    FOREIGN KEY (time_id) REFERENCES `time`(time_id)
);

CREATE TABLE `tempo` (
    tempo_id int(11) NOT NULL AUTO_INCREMENT,
    tempo_marking varchar(255) NOT NULL,
    tempo_rangestart int(3),
    tempo_rangeend int(3),
    PRIMARY KEY (tempo_id)
);

CREATE TABLE `work_tempo` (
    work_id int(11) NOT NULL,
    tempo_id int(11) NOT NULL,
    tempo_startmeasure int(6),
    FOREIGN KEY (work_id) REFERENCES `work`(work_id),
    FOREIGN KEY (tempo_id) REFERENCES `tempo`(tempo_id)
);

CREATE TABLE `instrument` (
    instr_id int(11) NOT NULL AUTO_INCREMENT,
    instr_name varchar(100) NOT NULL,
    instr_altname varchar(100),
    instr_tuning varchar(10),
    instr_family enum('Woodwind','Brass','String','Percussion','Keyboard'),
    PRIMARY KEY (instr_id)
);

CREATE TABLE `work_instrument`(
    work_id int(11) NOT NULL,
    instr_id int(11) NOT NULL,
    part_num int(2),
    FOREIGN KEY (work_id) REFERENCES `work`(work_id),
    FOREIGN KEY (instr_id) REFERENCES `instrument`(instr_id)
);

CREATE TABLE `pattern` (
    pat_id int(11) NOT NULL AUTO_INCREMENT,
    pat_data json,
    pat_type varchar(50),
    pat_relatedto int(11),
    PRIMARY KEY (pat_id),
    FOREIGN KEY (pat_relatedto) REFERENCES `pattern`(pat_id)
);

CREATE TABLE `work_pattern` (
    work_id int(11) NOT NULL,
    pat_id int(11) NOT NULL,
    pat_startmeasure int(6),
    FOREIGN KEY (work_id) REFERENCES `work`(work_id),
    FOREIGN KEY (pat_id) REFERENCES `pattern`(pat_id)
);