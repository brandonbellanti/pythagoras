SELECT * FROM composer;
SELECT comp_lname as Composer, era_name as Era FROM (`composer` AS C JOIN `composer_era` AS CE ON C.comp_id = CE.comp_id) JOIN `era` AS E ON CE.era_id = E.era_id;
SELECT comp_lname as Composer, GROUP_CONCAT(era_name SEPARATOR ', ') as Era FROM (`composer` AS C JOIN `composer_era` AS CE ON C.comp_id = CE.comp_id) JOIN `era` AS E ON CE.era_id = E.era_id WHERE comp_lname LIKE "%dvorak%";

SELECT * FROM composer WHERE concat(comp_fname,' ',comp_mname,' ',comp_lname) = "Jan Václav Voříšek";

RENAME TABLE composer_era TO composer_era_a;

SHOW TABLES;

TRUNCATE TABLE composer;

SELECT * FROM composer WHERE comp_lname LIKE "%bach%";

SELECT
	work_title,
	work_mvtitle,
	key_name
FROM
	(`work` AS w JOIN `work_key` AS wk ON w.work_id =  wk.work_id)
JOIN
	`key` as k on wk.key_id = k.key_id
WHERE
	key_name = 'F major';
    
    SELECT * from `work_view` WHERE `Composer` LIKE '%bach%';

SELECT
	concat(comp_fname,' ',comp_mname,' ',comp_lname) AS 'name',
	concat(comp_birthyear,'-',comp_deathyear) AS 'years',
	comp_nationality AS 'nationality',
	group_concat(era_name separator ', ') AS 'era'
FROM
	(composer AS C JOIN composer_era AS CE ON C.comp_id = CE.comp_id)
JOIN era AS E ON CE.era_id = E.era_id
WHERE concat(comp_fname,' ',comp_mname,' ',comp_lname) LIKE '%bach%'
GROUP BY C.comp_id
ORDER BY comp_birthyear;



SELECT
  cv_id,
  wv_composer,
  -- cv_born,
  -- cv_died,
  -- cv_nationality,
  -- cv_era
  wv_title
FROM work_view AS wv
WHERE cv_id = 38;

SHOW columns from composer;

SELECT * FROM `work` WHERE work_id IN (89,90,91);


UPDATE `work` SET work_opus = NULL WHERE work_id IN (89,90,91);
UPDATE `work` SET work_identifier = 'BWV 1047' WHERE work_id IN (89,90,91);

UPDATE `composer`
SET
	comp_wiki = "https://en.wikipedia.org/wiki/Anton%C3%ADn_Dvo%C5%99%C3%A1k",
	comp_imslp = "https://imslp.org/wiki/Category:Dvo%C5%99%C3%A1k,_Anton%C3%ADn"
WHERE comp_id = 177;

UPDATE `composer`
SET
	comp_wiki = "https://en.wikipedia.org/wiki/Johann_Sebastian_Bach",
	comp_imslp = "https://imslp.org/wiki/Category:Bach,_Johann_Sebastian"
WHERE comp_id = 38;

UPDATE `composer`
SET
	comp_wiki = "https://en.wikipedia.org/wiki/Johannes_Brahms",
	comp_imslp = "https://imslp.org/wiki/Category:Brahms,_Johannes"
WHERE comp_id = 170;