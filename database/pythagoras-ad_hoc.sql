SELECT * FROM composer;
SELECT comp_lname as Composer, era_name as Era FROM (`composer` AS C JOIN `composer_era` AS CE ON C.comp_id = CE.comp_id) JOIN `era` AS E ON CE.era_id = E.era_id;
SELECT comp_lname as Composer, GROUP_CONCAT(era_name SEPARATOR ', ') as Era FROM (`composer` AS C JOIN `composer_era` AS CE ON C.comp_id = CE.comp_id) JOIN `era` AS E ON CE.era_id = E.era_id WHERE comp_lname LIKE "%dvorak%";

SELECT * FROM composer WHERE concat(comp_fname,' ',comp_mname,' ',comp_lname) = "Jan Václav Voříšek";

DROP TABLE era;

SHOW TABLES;

TRUNCATE TABLE composer;

SELECT * FROM composer WHERE comp_lname LIKE "%bach%";