CREATE VIEW `composer_view` AS
SELECT
	CONCAT(comp_fname,' ',comp_mname,' ',comp_lname) as `Name`,
    comp_lname as `Surname`,
    comp_birthyear AS `Born`,
	comp_deathyear AS `Died`,
    comp_nationality AS `Nationality`,
    GROUP_CONCAT(DISTINCT era_name SEPARATOR ', ') AS `Era`
FROM (`composer` AS C JOIN `composer_era` AS CE ON C.comp_id = CE.comp_id)
JOIN `era` AS E ON CE.era_id = E.era_id
GROUP BY `Name`
;

DROP VIEW composer_view;

SELECT `Name`,`Born`,`Died`,`Nationality`, GROUP_CONCAT(DISTINCT `Era` SEPARATOR ', ') AS `Era` FROM composer_view WHERE `Era` LIKE "%class%" GROUP BY `Name`;

SELECT `Name`,`Era` FROM composer_view ORDER BY `Surname`;

SELECT * from era;